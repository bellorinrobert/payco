<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Middleware\VerifyCsrfToken;

use Illuminate\Http\Request;

class SoapMathController extends BaseController
{
    public function __construct(){
        
        $this->middleware(VerifyCsrfToken::class)->except('handle');

    }
    // Método para procesar la solicitud SOAP
    public function handle(Request $request)
    {
        
        try {
            // Opciones del servidor SOAP, como el URI base para el servicio
            $options = [
                'uri' => url('/soap'),
            ];
            // Crear la instancia del servidor SOAP sin WSDL
            $server = new \SoapServer(null, $options);

            // Establecer la clase que contiene los métodos que expondrás
            $server->setClass(SoapMathController::class);

            // Manejar la solicitud SOAP
            $server->handle();
        } catch (\SoapFault $e) {
            // Enviar respuesta de error si hay un fallo SOAP
            return response()->json([
                'error' => 'SOAP Fault: ' . $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'SOAP Server erro: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Método para sumar dos números
    public function add($a, $b)
    {
        return $a + $b;
    }

    // Método para restar dos números
    public function subtract($a, $b)
    {
        return $a - $b;
    }

    // Método para multiplicar dos números
    public function multiply($a, $b)
    {
        return $a * $b;
    }

    // Método para dividir dos números
    public function divide($a, $b)
    {
        if ($b == 0) {
            throw new \Exception('Division by zero.');
        }
        return $a / $b;
    }
}
