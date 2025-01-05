<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Consumer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Consumer>
 */
class ConsumerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['0', '1']),
            'birthday' => fake()->unixTime(),
            'password' => Hash::make('4654a9gr6ag'),
        ];
    }
}
