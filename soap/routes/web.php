<?php

use App\Http\Controllers\SoapMathController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users',[
    \App\Http\Controllers\User\IndexUserController::class
    , '__invoke']
);

Route::post('/client',[
    \App\Http\Controllers\Client\CreateClientController::class
    , '__invoke']
)->name('client.create');

Route::post('/billetera/cargar',[
    \App\Http\Controllers\Billetera\LoadBilleteraController::class
    , '__invoke']
)->name('billetera.cargar');

Route::post('/billetera/pagar',[
    \App\Http\Controllers\Billetera\PagarBilleteraController::class
    , '__invoke']
)->name('billetera.pagar');
Route::post('/billetera/consultar',[
    \App\Http\Controllers\Billetera\ConsultarBilleteraController::class
    , '__invoke']
)->name('billetera.consultar');

Route::post('/soap',[
    SoapMathController::class
    , 'handle'
])->withoutMiddleware([
    VerifyCsrfToken::class
]);



