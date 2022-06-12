<?php

namespace App\Http\Controllers;

class WaybillController extends Controller
{
    public function index()
    {
        return view('pages.waybill.index', [
            'title' => 'Waybill',
            'active' => 'waybill'
        ]);
    }
}
