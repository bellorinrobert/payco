<?php

namespace Tests\Feature\Wallet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DebitTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_debit(): void
    {
        $response = $this->get('/wallet/debit');

        $response->assertStatus(200);
    }
}
