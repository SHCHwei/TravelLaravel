<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertData();
    }


    protected function insertData(): void
    {
        $data = [
            [
                'uuid' => Str::uuid()->toString() ,
                'firstName' => "shih" ,
                'lastName' => "min min" ,
                'gender' => "woman" ,
                'email' => "wife@mail.com" ,
                'address' => "specialPlace" ,
                'city' => "Taichung" ,
            ],
            [
                'uuid' => Str::uuid()->toString() ,
                'firstName' => "shih" ,
                'lastName' => "sky sky" ,
                'gender' => "woman" ,
                'email' => "toy@mail.com" ,
                'address' => "specialPlace" ,
                'city' => "Taichung" ,
            ],
        ];


        DB::table('users')->insert($data);
    }
}
