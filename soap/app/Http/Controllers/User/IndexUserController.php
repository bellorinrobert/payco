<?php

namespace App\Http\Controllers\User;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;

use Illuminate\Http\Request;


class IndexUserController extends Controller
{
    private $entityManager;
    public function __construct(){

        

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $users = $this->entityManager->getRepository(User::class)->findAll();
        
        return response()->json([
            'success' => true,
            'cod_error' => '00',
            'message_error' => null,
            'data' => UserResource::collection($users)
        ]);
        

    }
}
