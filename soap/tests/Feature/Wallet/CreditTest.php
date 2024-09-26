<?php

namespace Tests\Feature\Wallet;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreditTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_credit(): void
    {
        Client::create([
            'documento' => '15804415'
            , 'nombres' => 'Robert Bellorin'
            , 'email' => 'bellorinrobert@gmail.com'
            , 'celular' => '+584144210035'
        ]);

        $response = $this->postJson('/wallet/credit', [
            'documento' => '15804415'
            , 'celular' => '+584144210035'
            , 'valor' => 100
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('wallets', 1);
        $this->assertDatabaseCount('transactions', 1);
    }
}
