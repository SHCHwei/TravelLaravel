<?php

namespace Database\Seeders;

use App\Models\Consumer;
use Illuminate\Database\Seeder;

class ConsumerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Consumer::factory()->count(10)->create();
    }
}
