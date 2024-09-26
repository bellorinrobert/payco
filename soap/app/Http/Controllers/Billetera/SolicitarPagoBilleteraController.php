<?php

namespace App\Http\Controllers\Billetera;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billetera\TokenRequest;
use App\Mail\Correo;
use App\Models\PaymentToken;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Mail;
use Str;

class SolicitarPagoBilleteraController extends Controller
{
    private $clientRepository;
    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(TokenRequest $request)
    {
        //
        $cliente = $this->clientRepository->getBy([
            'operator' => 'documento'
            , 'value' => $request->input('documento')
        ]);

        if($cliente->wallet->balance < $request->input('monto')){
            return response()->json([
                'success' => false
                , 'error' => 1
                , 'message' => 'Saldo infuciente'
            ], 400);
        }
        
        $token = rand(100000, 999999);
        $sessionId = Str::uuid()->toString();
        
        PaymentToken::create([
            'client_id' => $cliente->id
            , 'token' => $token
            , 'session_id' => $sessionId
            , 'amount' => $request->input('monto')
        ]);

        $details = [
            'title' => 'Confirmación de Pago'
            , 'token' => $token
        ];

        Mail::to($cliente->email)->send(
            new Correo($details)
        );

        return response()->json([
            'success' => true
            , 'message' => "Revisa tu correo token enviado"
            , 'session' => $sessionId
        ]);

    }
}
