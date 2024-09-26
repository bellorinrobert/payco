<?php

namespace App\Http\Controllers\Billetera;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billetera\DebitRequest;
use App\Models\PaymentToken;
use App\Repositories\ClientRepository;
use App\Repositories\TransactionRespository;


class PagarBilleteraController extends Controller
{
    private $clienteRepository;
    private $transactionRespository;
    public function __construct(ClientRepository $clientRepository
    , TransactionRespository $transactionRespository){

        $this->clienteRepository = $clientRepository;

        $this->transactionRespository = $transactionRespository;

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(DebitRequest $request)
    {
        //
        $paymentToken = PaymentToken::where('session_id', $request->session_id)
        ->where('token', $request->token)
        ->first();

        if(!$paymentToken) {

            
            return response()->json([
                'success' => false
                ,'message' => 'Token inválido'
            ], 400);

        }

        if($paymentToken->confirmado){

            return response()->json([
                'success' => false
                , 'message' => 'Token ya confirmado'
            ], 400);
            
        }

        $paymentToken->update([
            'confirmado' => true
        ]);

        $cliente = $this->clienteRepository->getById(
            $paymentToken->client_id
        );

        $balance = floatval($cliente->wallet->balance);
        $balance -= floatval($paymentToken->amount);
        $cliente->wallet()->update([
            'balance' => $balance
        ]);

        $trasaction = $this->transactionRespository->create([
            'wallet_id' => $cliente->wallet->id
                , 'credit' => 0
                , 'amount' => $paymentToken->amount
                , 'debit' => $paymentToken->amount
        ]);

        return response()->json([
            'success' => true
            , 'message' => 'Pago confirmado exitosamente. Trasaccion ' . $trasaction->id
        ], 200);

    }
}
