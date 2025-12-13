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

            ],
            [
                'kode' => 'C2',
                'nama' => 'Kapasitas CC',

            ],
            [
                'kode' => 'C3',
                'nama' => 'Fitur',
            ],
            [
                'kode' => 'C4',
                'nama' => 'Angsuan',
            ],

        ]);
      }
}
