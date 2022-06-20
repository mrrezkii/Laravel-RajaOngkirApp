<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class WaybillController extends Controller
{
    public function index()
    {
        return view('pages.waybill.index', [
            'title' => 'Waybill',
            'active' => 'waybill',
            'courier_code' => request()->query('courier'),
            'courier_name' => $this->getCourierName(),
        ]);
    }

    public function getCourierName(): array|string|null
    {
        $courier_code = request()->query('courier');
        $courier_name = "";
        switch ($courier_code) {
            case "jne":
                $courier_name = "JNE";
                break;
            case "sicepat":
                $courier_name = "SiCepat";
                break;
            case "jnt":
                $courier_name = "J&T Express";
                break;
            case "pos":
                $courier_name = "POS Indonesia";
                break;
            case "anteraja":
                $courier_name = "AnterAja";
                break;
            case "ninja":
                $courier_name = "Ninja Xpress";
                break;
            default:
                $courier_name = "Courier";
        }

        return $courier_name;
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'awb' => 'required|:max:255',
            'courier' => 'required|:min:3',
        ]);

        $RAJAONGKIR_PRO_API_KEY = "82aab7e0170e3e31f9a2da7b61ef4bab";
        $client = new Client;
        try {
            $results = $client->request('POST', 'https://pro.rajaongkir.com/api/waybill', [
                'headers' => [
                    'Accept' => 'application/json',
                    'key' => env('RAJAONGKIR_API_KEY', $RAJAONGKIR_PRO_API_KEY),
                ],
                'form_params' => [
                    'waybill' => $validateData['awb'],
                    'courier' => $validateData['courier'],
                ]
            ]);
        } catch (GuzzleException $e) {
            return redirect()->back()->with('invalid', 'Invalid AWB Number. Please try again');
        }
        $array = json_decode($results->getBody()->getContents(), true);
        $collection = collect($array);

        return redirect('/waybill?courier=' . $collection['rajaongkir']['query']['courier'] . '&waybill=' . $collection['rajaongkir']['query']['waybill'])->with('data', $collection);
    }
}
