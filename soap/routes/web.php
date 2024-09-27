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

Route::post('/soap',[
    SoapMathController::class
    , 'handle'
])->withoutMiddleware([
    VerifyCsrfToken::class
]);

Route::post('/soap/cliente',[
    \App\Http\Controllers\Client\CreateClientController::class
    , 'handle'
])->withoutMiddleware([
    VerifyCsrfToken::class
]);

Route::post('/cliente',[
    \App\Http\Controllers\Client\CreateClientNoSoapController::class
    , '__invoke']
);

Route::post('/wallet/credit',[
    \App\Http\Controllers\Billetera\LoadBilleteraController::class
    , '__invoke']
);

Route::post('/wallet/debit',[
    \App\Http\Controllers\Billetera\SolicitarPagoBilleteraController::class
    , '__invoke']
);

Route::post('/wallet/confirm',[
    \App\Http\Controllers\Billetera\PagarBilleteraController::class
    , '__invoke']
);

Route::post('/wallet/consult',[
    \App\Http\Controllers\Billetera\ConsultarBilleteraController::class
    , '__invoke']
);



