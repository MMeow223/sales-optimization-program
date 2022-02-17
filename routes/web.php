<?php


use App\Http\Controllers\DevicesController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PharmaciesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangesController;
use App\Http\Controllers\PagesController;

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
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [PagesController::class, 'index']);
Route::resource('exchanges', ExchangesController::class);
Route::resource('devices', DevicesController::class);
Route::resource('patients', PatientsController::class);
Route::resource('pharmacies', PharmaciesController::class);

Route::get('/devices/{device}/deactivate', [DevicesController::class, 'deactivate'])->name('devices.deactivate');
Route::get('/devices/{device}/activate', [DevicesController::class, 'activate'])->name('devices.activate');

Route::get('/pharmacies/{pharmacy}/deactivate', [PharmaciesController::class, 'deactivate'])->name('pharmacies.deactivate');
Route::get('/pharmacies/{pharmacy}/activate', [PharmaciesController::class, 'activate'])->name('pharmacies.activate');

Auth::routes();


