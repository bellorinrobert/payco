<?php

namespace App\Http\Controllers\Client;

use App\Entities\Client;
use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Requests\Client\CreateClientRequest;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Routing\Controller as BaseController;
use LaravelDoctrine\ORM\Facades\EntityManager;

class CreateClientNoSoapController extends BaseController
{
    private $entityMI;
    public function __construct(EntityManagerInterface $entityManagerInterface){
        
        $this->entityMI = $entityManagerInterface;
        
        
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClientRequest $request)
    {
        //
        $documento = $request->input('documento');

        // $cliente = $this->entityMI->findOnBy([
        //     'documento' => 1223
        // ]);

        // if ($cliente){
        //     return response()->json([
        //         'success' => false,
        //         'cod_error' => 1,
        //         'message' => "Documento ya en bdd",
        //     ]);
        // }

        try {

            
            $cliente = new Client();
            
            $cliente->setDocumento($request->documento);
            $cliente->setNombres($request->nombres);
            $cliente->setCelular($request->celular);
            $cliente->setEmail($request->email);
    
            $this->entityMI->persist($cliente);
            $this->entityMI->flush();
    
            return response()->json([
                'success' => true,
                'cod_error' => '00',
                'message' => 'Procesado',
            ]);
            

        } catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'cod_error' => 1,
                'message' => "No procesado",
            ]);
        }


    }
}
