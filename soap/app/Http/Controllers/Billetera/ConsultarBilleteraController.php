<?php

namespace App\Http\Controllers\Billetera;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billetera\ConsultRequest;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ConsultarBilleteraController extends Controller
{
    private $clientRepository;
    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(ConsultRequest $request)
    {
        //
        $cliente = $this->clientRepository->getBy([
            'operator' => 'documento'
            , 'value' => $request->documento
        ]);

        if(!$cliente){
            return response()->json([
                'success' => false
                , 'message' => "Cliente no existe"
            ]);
        }
        
        if($cliente->celular != $request->celular){
            return response()->json([
                'success' => false
                , 'message' => "Celular no pertene a este cliente"
            ]);
        }

        return response()->json([
            'success' => true
            ,'message' => "Su saldo es: {$cliente->wallet->balance}"

        ]);

    }
}
