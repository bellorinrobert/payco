<?php

namespace App\Http\Controllers\Client;

use App\Entities\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use Doctrine\ORM\EntityManagerInterface;


class CreateClientController extends Controller
{
    private $entityManager;
    /**
     * Summary of __construct
     * @param \Doctrine\ORM\EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface){
        $this->entityManager = $entityManagerInterface;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClientRequest $request)
    {
        //
        try {
            //Crear Client ya campos validados
            $client = new Client();
            $client->setDocumento($request->documento);
            $client->setNombres($request->nombres);
            $client->setEmail($request->email);
            $client->setCelular($request->celular);
            //Eviar al respositorio
            $this->entityManager->persist($client);
            $this->entityManager->flush();
            
    
            return response()->json([
                'success' => true,
                'cod_error' => '00',
                'message' => 'Procesado',
            ]);

            
        } catch(\Exception $e) {
            
            return response()->json([
                'success' => false,
                'cod_error' => 1,
                'message' => "No procesado",
            ]);

        }
    }
}
