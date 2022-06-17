<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CostController extends Controller
{
    public function index()
    {
        return view('pages.cost.index', [
            'title' => 'Cost',
            'active' => 'cost',
            'cities' => $this->getCities()
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
        $client = new Client;
        $results = $client->request('POST', 'https://pro.rajaongkir.com/api/cost', [
            'headers' => [
                'Accept' => 'application/json',
                'key' => env('RAJAONGKIR_API_KEY', $RAJAONGKIR_PRO_API_KEY),
            ],
            'form_params' => [
                'origin' => $validateData['origin'],
                'originType' => 'city',
                'destination' => $validateData['destination'],
                'destinationType' => 'city',
                'weight' => '1000',
                'courier' => 'jne:sicepat:jnt:pos:ninja:anteraja:tiki'
            ]
        ]);

        $array = json_decode($results->getBody()->getContents(), true);
        $collections = collect($array);
        $collections = $collections['rajaongkir']['results'];

        foreach ($collections as $items) {
            foreach ($items['costs'] as $costs) {
                Cost::updateOrCreate([
                    'cost_id' => Uuid::uuid4()->toString() . "\n",
                    'courier' => $items['name'],
                    'service' => $costs['service'],
                    'description' => $costs['description'],
                    'price' => $costs['cost'][0]['value'],
                    'etd_day' => $costs['cost'][0]['etd'],
                ]);
            }

        }

        $this->dataResults($collections);

        return redirect('/cost')->with('data', $collections);
    }

    public function dataResults(array $collection)
    {

        dd($collection);
//        return DataTables::of($collection)
//            ->addIndexColumn()
//            ->toJson();
    }

}
