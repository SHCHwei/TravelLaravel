<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['普通房', '豪華房', '海景房', '無敵海景房', '奢華房']),
            'description' => fake()->text(30),
            'price' => fake()->numberBetween(999, 99999),
            'count' => fake()->numberBetween(1, 10),

        ];
    }
}
