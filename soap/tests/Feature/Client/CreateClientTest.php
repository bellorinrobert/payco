<?php

namespace Tests\Feature\Client;

use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    
    use RefreshDatabase;

    
    /**
     * A basic feature test example.
     */
    public function test_create_validar(): void
    {
        $response = $this->postJson('/client',[
            'documento' => '15804415'
        ]
    );

        $response->assertStatus(422);
    }
    public function test_create_success(): void
    {
        $this->seed();

        $response = $this->postJson('/client',[
            'documento' => '15804415'
            , 'nombres' => 'Robert Luis Bellorin Bueno'
            , 'email' => 'bellorinrobert@gmail.com'
            , 'celular' => '584144210035'
            ]
        );
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('clients',[
            'documento' => '15804415'
        ]);
    }
}
