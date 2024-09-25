<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'documento' => fake()->numberBetween(1000000,16000000)
            , 'nombres' => fake()->name() . " " . fake()->lastName()
            , 'email' => fake()->email()
            , 'celular' => fake()->phoneNumber()
        ];
    }
}
