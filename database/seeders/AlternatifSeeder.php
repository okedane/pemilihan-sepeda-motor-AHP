<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternatif')->insert([
            [
            'kode' => 'A01',
            'nama' => 'Beat Street CBS',
            ],
            [
            'kode' => 'A02',
            'nama' => 'Beat Sporty ISS Deluxe Smartkey',
            ],
            [
            'kode' => 'A03',
            'nama' => 'Scoopy Prestige/Stylish Smartkey',
            ],
            [
            'kode' => 'A04',
            'nama' => 'PCX 160 ABS',
            ],
            [
            'kode' => 'A05',
            'nama' => 'Vario 125 CBS ISS Smartkey',
            ],
        ]);
    }
}
