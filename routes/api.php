<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api/v1/patients',[APIController::class,'getPatients'])->name('api.patients.index');
Route::get('/api/v1/exchanges',[APIController::class,'getExchanges'])->name('api.exchanges.index');
Route::get('/api/v1/devices',[APIController::class,'getDevices'])->name('api.devices.index');
Route::get('/api/v1/pharmacies',[APIController::class,'getPharmacies'])->name('api.pharmacies.index');
