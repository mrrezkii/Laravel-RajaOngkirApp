<?php

namespace App\Http\Controllers;

class CostController extends Controller
{
    public function index()
    {
        return view('pages.cost.index', [
            'title' => 'Cost',
            'active' => 'cost'
        ]);
    }
}
