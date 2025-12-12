<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Ahli',
            'email' => 'ahli@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'ahli',
        ]);

        \App\Models\User::create([
            'name' => 'Petani',
            'email' => 'petani@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'petani',
        ]);


    }
}
