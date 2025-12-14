<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run(): void {
         DB::table('kriteria')->insert([
            [
                'kode' => 'C1',
                'nama' => 'Harga',
                'bobot' => 0.445,

            ],
            [
                'kode' => 'C2',
                'nama' => 'Kapasitas CC',
                'bobot' => 0.264,

            ],
            [
                'kode' => 'C3',
                'nama' => 'Fitur',
                'bobot' => 0.185,

            ],
            [
                'kode' => 'C4',
                'nama' => 'Angsuan',
                'bobot' => 0.106,
            ],

        ]);
      }
}
