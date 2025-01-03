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
                'email' => "test@mail.com" ,
                'address' => "specialPlace" ,
                'city' => "Taichung" ,
            ],
            [
                'uuid' => Str::uuid()->toString() ,
                'firstName' => "shih" ,
                'lastName' => "A wei" ,
                'gender' => "man" ,
                'email' => "test2@mail.com" ,
                'address' => "specialPlace" ,
                'city' => "Taichung" ,
            ],
        ];


        DB::table('users')->insert($data);
    }
}
