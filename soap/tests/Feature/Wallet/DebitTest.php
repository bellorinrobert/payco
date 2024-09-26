<?php

namespace Tests\Feature\Wallet;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DebitTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_debit_low_balance(): void
    {
        $cliente = Client::create([
            'documento' => '15804415'
            , 'nombres' => 'Robert Bellorin'
            , 'email' => 'bellorinrobert@gmail.com'
            , 'celular' => '+584144210035'
        ]);
        
        $cliente->wallet()->create();
        
        $response = $this->postJson('/wallet/debit', [
            'documento' => '15804415'
            , 'celular' => '+584144210035'
            , 'monto' => 10
        ]);

        $response->assertStatus(400);
        $this->assertDatabaseCount('wallets', 1);
        $this->assertDatabaseCount('transactions', 0);
    }
    public function test_debit_up_balance(): void
    {
        $cliente = Client::first();
        
        $cliente->wallet()->update([
            'balance' => 100
        ]);

        
        $response = $this->postJson('/wallet/debit', [
            'documento' => '15804415'
            , 'celular' => '+584144210035'
            , 'monto' => 10
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount('wallets', 1);
        $this->assertDatabaseCount('transactions', 0);
    }
    
    public function test_consult_balance(): void
    {
        $response = $this->postJson('/wallet/consult', [
            'documento' => '15804415'
            , 'celular' => '+584144210035'
            
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount('wallets', 1);
        $this->assertDatabaseCount('transactions', 0);
    }
}
