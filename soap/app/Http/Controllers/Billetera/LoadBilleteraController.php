<?php

namespace App\Http\Controllers\Billetera;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billetera\CreditRequest;

use App\Repositories\ClientRepository;
use App\Repositories\TransactionRespository;
use App\Repositories\WalletRespository;

class LoadBilleteraController extends Controller
{
    private $clienteRepository;
    private $transactionRespository;
    private $walletRespository;
    
    public function __construct(
        ClientRepository $clientRepository
        , TransactionRespository $transactionRespository
        , WalletRespository $walletRespository
    ){
        
        $this->clienteRepository = $clientRepository;

        $this->transactionRespository = $transactionRespository;

        $this->walletRespository = $walletRespository;
        
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreditRequest $request)
    {
        //
        $cliente = $this->clienteRepository->getBy([
            'operator' => 'documento'
            , 'value' => $request->input('documento')
        ]);

        if(!$cliente->wallet){
            $cliente->wallet()->create([]);            
            $cliente->refresh();

        }
        
        if($cliente->wallet){
            $balance = 0;
            $balance += floatval($cliente->wallet->balance);
            $balance += floatval($request->input('valor'));

            $this->transactionRespository->create([
                'wallet_id' => $cliente->wallet->id
                , 'credit' => $request->input('valor')
                , 'amount' => $request->input('valor')
                , 'debit' => 0
            ]);

            $this->walletRespository->update(
                $cliente->wallet->id,
                ['balance'=>  + $balance] 
            );

        }

        return response()->json([
            'success' => true
            , 'message' => "Carga realizada con exito"
        ]);

        

    }
}
