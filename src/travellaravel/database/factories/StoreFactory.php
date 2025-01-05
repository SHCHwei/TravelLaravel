<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->userName(),
            'address' => fake()->city()." ".fake()->country(),
            'personInCharge' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'description' => fake()->text(30),
            'password' => Hash::make('4654a9gr6ag'),
        ];
    }
}
