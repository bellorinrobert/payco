<?php
/**
 * Summary of namespace App\Http\Controllers
 * Controllador que realiza las cuatro (4) operaciones
 * básicas de la matematica
 * 
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-25 17:20:56
 * 
 */
namespace App\Http\Controllers\Client;

use App\Entities\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use Doctrine\ORM\EntityManagerInterface;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;

class CreateClientController extends Controller
{
    private $entityMI;
    public function __construct(EntityManagerInterface $entityManager){
        
        $this->entityMI = $entityManager;

        $this->middleware(VerifyCsrfToken::class)
                ->except('handle');

    }
    // Método para procesar la solicitud SOAP
    public function handle(Request $request)
    {
        
        try {
            // Opciones del servidor SOAP, como el URI base para el servicio
            $options = [
                'uri' => url('/soap/cliente'),
            ];
            // Crear la instancia del servidor SOAP sin WSDL
            $server = new \SoapServer(null, $options);

            // Establecer la clase que contiene los métodos que expondrás
            $server->setClass(CreateClientController::class);

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
    /**
     * Summary of create
     * @param mixed $documento
     * @param mixed $nombres
     * @param mixed $email
     * @param mixed $telefonos
     * @return array
     */
    public function create(
        $documento, $nombres, $email, $celular)
    {
        
        $cliente = new Client();
        $cliente->setDocumento($documento);
        $cliente->setNombres($nombres);
        $cliente->setEmail($email);
        $cliente->setCelular($celular);

        $this->entityMI->persist($cliente);
        $this->entityMI->flush();

        return [
            $documento, $nombres, $email, $celular
        ];
    }
}


