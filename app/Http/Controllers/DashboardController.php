<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'detail_province_city' => $this->getDetailProvinceCity(),
            'detail_courier_services' => $this->getDetailCourierServices(),
            'total_courier' => $this->getCourierCount(),
            'total_services' => $this->getServicesCount(),
        ]);
    }

    public function getDetailProvinceCity()
    {

    }

    public function getDetailCourierServices()
    {
        $data = [
            [
                "code" => "jne",
                "name" => "Jalur Nugraha Ekakurir (JNE)",
                "cost" => [
                    [
                        "service" => "OKE",
                        "description" => "Ongkos Kirim Ekonomis",
                    ],
                    [
                        "service" => "REG",
                        "description" => "Regular Services",
                    ],
                    [
                        "service" => "YES",
                        "description" => "Yakin Esok Sampai",
                    ],
                ],
            ],
            [
                "code" => "sicepat",
                "name" => "SiCepat Express",
                "cost" => [
                    [
                        "service" => "BEST",
                        "description" => "Besok Sampai Tujuan",
                    ],
                    [
                        "service" => "REG",
                        "description" => "Layanan Reguler",
                    ],
                    [
                        "service" => "SIUNT",
                        "description" => "SiUntung",
                    ],
                    [
                        "service" => "GOKIL",
                        "description" => "Cargo (Minimal 10kg)",
                    ]
                ],
            ],
            [
                "code" => "jnt",
                "name" => "J&T Express",
                "cost" => [
                    [
                        "service" => "EZ",
                        "description" => "Regular Service",
                    ],
                ],
            ],
            [
                "code" => "pos",
                "name" => "POS Indonesia (POS)",
                "cost" => [
                    [
                        "service" => "Paket Kilat Khusus",
                        "description" => "Paket Kilat Khusus",
                    ],
                    [
                        "service" => "Express Next Day Barang",
                        "description" => "Express Next Day Barang",
                    ],
                ],
            ],
            [
                "code" => "ninja",
                "name" => "Ninja Xpress",
                "cost" => [
                    [
                        "service" => "STANDARD",
                        "description" => "Standard Service",
                    ],
                ],
            ],
            [
                "code" => "anteraja",
                "name" => "AnterAja",
                "cost" => [
                    [
                        "service" => "ND",
                        "description" => "Anteraja Next Day",
                    ],
                    [
                        "service" => "REG",
                        "description" => "Anteraja Regular",
                    ],
                    [
                        "service" => "SD",
                        "description" => "Anteraja Same Day",
                    ],
                ],
            ],
            [
                "code" => "tiki",
                "name" => "Citra Van Titipan Kilat (TIKI)",
                "cost" => [
                    [
                        "service" => "ECO",
                        "description" => "Economy Service",
                    ],
                    [
                        "service" => "REG",
                        "description" => "Anteraja Regular",
                    ],
                    [
                        "service" => "SD",
                        "description" => "Anteraja Same Day",
                    ],
                ],
            ],
        ];

        return $data;
    }

    public function getCourierCount()
    {
        $data = $this->getDetailCourierServices();
        return count($data);
    }

    public function getServicesCount()
    {
        $data = $this->getDetailCourierServices();
        $total = 0;
        for ($i = 0; $i < count($data); $i++) {
            $count = count($data[$i]['cost']);
            $total += $count;
        }
        return $total;
    }
}
