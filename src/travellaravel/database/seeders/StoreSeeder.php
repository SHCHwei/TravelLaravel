<?php

namespace Database\Seeders;

use App\Models\RoomType;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory()
            ->count(10)
            ->has(RoomType::factory()->count(10), 'roomTypes')
            ->create();
    }
}
