<?php

namespace App\Http\Controllers;

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
}
