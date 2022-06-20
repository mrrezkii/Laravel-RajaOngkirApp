<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\CostLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class CostController extends Controller
{

    public function index()
    {
        return view('pages.cost.index', [
            'title' => 'Cost',
            'active' => 'cost',
            'cities' => $this->getCities(),
            'cheapest' => $this->getCheapest(),
            'fastest' => $this->getFastest()
        ]);
    }

    public function getCities()
    {
        $dashboard = new DashboardController();
        return $dashboard->getDetailProvinceCity();
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'origin' => 'required',
            'destination' => 'required',
        ]);

        $RAJAONGKIR_PRO_API_KEY = "82aab7e0170e3e31f9a2da7b61ef4bab";
        $ORIGIN_TYPE = "city";
        $DESTINATION_TYPE = "city";
        $WEIGHT = "1000";
        $COURIER = "jne:sicepat:jnt:pos:ninja:anteraja:tiki";

        $client = new Client;
        $results = $client->request('POST', 'https://pro.rajaongkir.com/api/cost', [
            'headers' => [
                'Accept' => 'application/json',
                'key' => env('RAJAONGKIR_API_KEY', $RAJAONGKIR_PRO_API_KEY),
            ],
            'form_params' => [
                'origin' => $validateData['origin'],
                'originType' => $ORIGIN_TYPE,
                'destination' => $validateData['destination'],
                'destinationType' => $DESTINATION_TYPE,
                'weight' => $WEIGHT,
                'courier' => $COURIER
            ]
        ]);

        $array = json_decode($results->getBody()->getContents(), true);
        $collections = collect($array);
        $collections = $collections['rajaongkir']['results'];

        $COST_ID = Uuid::uuid4()->toString();

        Cost::updateOrCreate(
            [
                'cost_id' => $COST_ID,
                'origin' => $validateData['origin'],
                'originType' => $ORIGIN_TYPE,
                'destination' => $validateData['destination'],
                'destinationType' => $DESTINATION_TYPE,
                'weight' => $WEIGHT,
                'courier' => $COURIER
            ]
        );

        foreach ($collections as $items) {
            foreach ($items['costs'] as $costs) {
                CostLog::updateOrCreate([
                    'cost_log_id' => Uuid::uuid4()->toString(),
                    'cost_id' => $COST_ID,
                    'courier' => $items['name'],
                    'service' => $costs['service'],
                    'description' => $costs['description'],
                    'price' => $costs['cost'][0]['value'],
                    'etd_day' => $costs['cost'][0]['etd'],
                ]);
            }

        }

        $request->session()->put("cost_id", $COST_ID);

        return redirect('/cost?origin=' . $validateData['origin'] . '&destination=' . $validateData['destination'])->with('data', true);
    }

    public function dataResults()
    {
        $model = CostLog::where('cost_id', '=', session('cost_id'))->get();

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('price', function ($model) {
                return "IDR " . number_format($model->price, 2, ',', '.');
            })
            ->addColumn('etd_day', function ($model) {
                if ($model->etd_day == null || $model->etd_day == "") {
                    return "-";
                } else {
                    $newString = str_replace("HARI", "", $model->etd_day);
                    return $newString . " day";
                }
            })
            ->toJson();
    }

    public function getCheapest()
    {
        return CostLog::where('cost_id', '=', session('cost_id'))
            ->orderByRaw('CONVERT(price, SIGNED) asc')
            ->LIMIT(3)
            ->get();
    }

    public function getFastest()
    {
        return CostLog::where('cost_id', '=', session('cost_id'))
            ->where('etd_day', "!=", "")
            ->orderByRaw('CONVERT(etd_day, SIGNED) asc')
            ->LIMIT(3)
            ->get();
    }

}
