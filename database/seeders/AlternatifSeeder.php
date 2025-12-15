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
            'harga' => 15000000,
            'deskripsi' => 'Motor dengan desain street yang stylish dan nyaman untuk berkendara di perkotaan.',
            ],
            [
            'kode' => 'A02',
            'nama' => 'Beat Sporty ISS Deluxe Smartkey',
            'harga' => 16000000,
            'deskripsi' => 'Motor sporty dengan fitur ISS dan sistem smartkey untuk kemudahan dan keamanan.',
            ],
            [
            'kode' => 'A03',
            'nama' => 'Scoopy Prestige/Stylish Smartkey',
            'harga' => 17000000,
            'deskripsi' => 'Motor bergaya retro dengan fitur smartkey dan desain yang elegan.',
            ],
            [
            'kode' => 'A04',
            'nama' => 'PCX 160 ABS',
            'harga' => 30000000,
            'deskripsi' => 'Motor skutik premium dengan teknologi ABS dan performa mesin yang bertenaga.',
            ],
            [
            'kode' => 'A05',
            'nama' => 'Vario 125 CBS ISS Smartkey',
            'harga' => 20000000,
            'deskripsi' => 'Motor skutik dengan fitur ISS dan smartkey, cocok untuk penggunaan sehari-hari.',
            ],
        ]);
    }
}
