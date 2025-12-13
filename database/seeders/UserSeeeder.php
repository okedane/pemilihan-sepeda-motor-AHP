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
            'password' => bcrypt('123123123'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'user',
        ]);

    }
}
