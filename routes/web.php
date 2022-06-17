<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaybillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/_data/city', [DashboardController::class, 'dataCity'])->name('dashboard.data.city');
Route::get('/dashboard/_data/courier', [DashboardController::class, 'dataCourier'])->name('dashboard.data.courier');
Route::get('/cost', [CostController::class, 'index']);
Route::post('/cost', [CostController::class, 'store']);
Route::get('cost/_data/results', [CostController::class, 'dataResults'])->name('cost.data.results');
Route::get('/waybill', [WaybillController::class, 'index']);
Route::post('/waybill', [WaybillController::class, 'store']);
