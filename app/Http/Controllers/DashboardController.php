<?php

namespace App\Http\Controllers;

use App\Models\City;
use GuzzleHttp\Client;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'detail_province_city' => $this->getDetailProvinceCity(),
            'detail_total_city' => $this->getCityCount(),
            'detail_courier_services' => $this->getDetailCourierServices(),
            'total_courier' => $this->getCourierCount(),
            'total_services' => $this->getServicesCount(),
        ]);
    }

    public function getDetailProvinceCity()
    {
        if (City::where('city_id', "1")->exists() && City::where('city_id', "501")->exists()) {
            return City::all();
        } else {
            $RAJAONGKIR_PRO_API_KEY = "82aab7e0170e3e31f9a2da7b61ef4bab";
            $client = new Client;
            $results = $client->request('GET', 'https://pro.rajaongkir.com/api/city', [
                'headers' => [
                    'Accept' => 'application/json',
                    'key' => env('RAJAONGKIR_API_KEY', $RAJAONGKIR_PRO_API_KEY),
                ]
            ]);

            $array = json_decode($results->getBody()->getContents(), true);
            $collections = collect($array);
            $collections = $collections['rajaongkir']['results'];

            foreach ($collections as $item) {
                City::updateOrCreate([
                    'city_id' => $item['city_id'],
                    'province_id' => $item['province_id'],
                    'province' => $item['province'],
                    'type' => $item['type'],
                    'city_name' => $item['city_name'],
                    'postal_code' => $item['postal_code'],
                ]);
            }
            return $collections;
        }
    }

    public function getCityCount()
    {
        return count($this->getDetailProvinceCity());
    }


    public function getDetailCourierServices()
    {
        return [
            [
                "name" => "Jalur Nugraha Ekakurir (JNE)",
                "service" => "OKE",
                "description" => "Ongkos Kirim Ekonomis",
            ],
            [
                "name" => "Jalur Nugraha Ekakurir (JNE)",
                "service" => "REG",
                "description" => "Regular Services",
            ],
            [
                "name" => "Jalur Nugraha Ekakurir (JNE)",
                "service" => "YES",
                "description" => "Yakin Esok Sampai",
            ],
            [
                "name" => "SiCepat Express",
                "service" => "BEST",
                "description" => "Besok Sampai Tujuan",
            ],
            [
                "name" => "SiCepat Express",
                "service" => "REG",
                "description" => "Layanan Reguler",
            ],
            [
                "name" => "SiCepat Express",
                "service" => "SIUNT",
                "description" => "SiUntung",
            ],
            [
                "name" => "SiCepat Express",
                "service" => "GOKIL",
                "description" => "Cargo (Minimal 10kg)",
            ],
            [
                "name" => "J&T Express",
                "service" => "EZ",
                "description" => "Regular Service",
            ],
            [
                "name" => "POS Indonesia",
                "service" => "Paket Kilat Khusus",
                "description" => "Paket Kilat Khusus",
            ],
            [
                "name" => "POS Indonesia",
                "service" => "Express Next Day Barang",
                "description" => "Express Next Day Barang",
            ],
            [
                "name" => "Ninja Xpress",
                "service" => "STANDARD",
                "description" => "Standard Service",
            ],
            [
                "name" => "AnterAja",
                "service" => "ND",
                "description" => "Anteraja Next Day",
            ],
            [
                "name" => "AnterAja",
                "service" => "REG",
                "description" => "Anteraja Regular",
            ],
            [
                "name" => "AnterAja",
                "service" => "SD",
                "description" => "Anteraja Same Day",
            ],
            [
                "name" => "Citra Van Titipan Kilat (TIKI)",
                "service" => "ECO",
                "description" => "Economy Service",
            ],
            [
                "name" => "Citra Van Titipan Kilat (TIKI)",
                "service" => "REG",
                "description" => "Anteraja Regular",
            ],
            [
                "name" => "Citra Van Titipan Kilat (TIKI)",
                "service" => "SD",
                "description" => "Anteraja Same Day",
            ],
        ];
    }

    public function getCourierCount()
    {
        return 7;
    }

    public function getServicesCount()
    {
        return count($this->getDetailCourierServices());
    }

    public function dataCity()
    {
        $collection = collect($this->getDetailProvinceCity());

        return DataTables::of($collection)
            ->addIndexColumn()
            ->toJson();
    }

    public function dataCourier()
    {
        $collection = collect($this->getDetailCourierServices());

        return DataTables::of($collection)
            ->addIndexColumn()
            ->toJson();
    }
}
