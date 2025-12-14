<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerbandinganAlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // A01
            ['alternatif_id' => 1, 'sub_kriteria_id' => 1, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 2, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 3, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 4, 'nilai' => 4],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 5, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 6, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 7, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 8, 'nilai' => 4],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 9, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 10, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 11, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 12, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 13, 'nilai' => 3],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 14, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 15, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 16, 'nilai' => 4],

            // A02
            ['alternatif_id' => 2, 'sub_kriteria_id' => 1, 'nilai' => 5],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 2, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 3, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 4, 'nilai' => 1],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 5, 'nilai' => 5],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 6, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 7, 'nilai' => 5],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 8, 'nilai' => 2],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 9, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 10, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 11, 'nilai' => 2],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 12, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 13, 'nilai' => 1],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 14, 'nilai' => 2],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 15, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 16, 'nilai' => 4],

            // A03
            ['alternatif_id' => 3, 'sub_kriteria_id' => 1, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 2, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 3, 'nilai' => 3],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 4, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 5, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 6, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 7, 'nilai' => 4],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 8, 'nilai' => 1],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 9, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 10, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 11, 'nilai' => 4],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 12, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 13, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 14, 'nilai' => 3],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 15, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 16, 'nilai' => 3],

            // A04
            ['alternatif_id' => 4, 'sub_kriteria_id' => 1, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 2, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 3, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 4, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 5, 'nilai' => 3],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 6, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 7, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 8, 'nilai' => 5],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 9, 'nilai' => 3],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 10, 'nilai' => 1],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 11, 'nilai' => 4],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 12, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 13, 'nilai' => 3],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 14, 'nilai' => 5],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 15, 'nilai' => 4],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 16, 'nilai' => 1],

            // A05
            ['alternatif_id' => 5, 'sub_kriteria_id' => 1, 'nilai' => 4],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 2, 'nilai' => 1],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 3, 'nilai' => 4],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 4, 'nilai' => 3],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 5, 'nilai' => 5],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 6, 'nilai' => 5],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 7, 'nilai' => 2],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 8, 'nilai' => 2],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 9, 'nilai' => 2],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 10, 'nilai' => 3],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 11, 'nilai' => 2],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 12, 'nilai' => 2],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 13, 'nilai' => 4],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 14, 'nilai' => 2],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 15, 'nilai' => 4],
            ['alternatif_id' => 5, 'sub_kriteria_id' => 16, 'nilai' => 2],
        ];
        \DB::table('perbandingan_alternatif')->insert($data);
    }
}
