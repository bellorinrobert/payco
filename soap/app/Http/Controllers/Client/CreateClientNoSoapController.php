<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use App\Repositories\ClientRepository;



class CreateClientNoSoapController extends Controller
{
    protected $clienteRepository;
    public function __construct( ClientRepository $clienteRepository){

        $this->clienteRepository = $clienteRepository;
        
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClientRequest $request)
    {
        //
        // try {
            $data = $request->toArray();

            $client = $this->clienteRepository->create($data);

            return response()->json(data: [
                'meta' => [
                    'success' => true
                    , 'errors' => []
                ], 'data' =>  $client
                
            ], status: 201);
        // }
        
    }
}
