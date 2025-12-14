<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('sub_kriteria')->insert([
            ['kriteria_id' => 1, 'kode' => 'S1', 'nama' => '20 Juta', 'bobot' => '0.554'],
            ['kriteria_id' => 1, 'kode' => 'S2', 'nama' => '21-30 uta', 'bobot' => '0.222'],
            ['kriteria_id' => 1, 'kode' => 'S3', 'nama' => '31-40 Juta', 'bobot' => '0.147'],
            ['kriteria_id' => 1, 'kode' => 'S4', 'nama' => '>40 Juta', 'bobot' => '0.077'],


            ['kriteria_id' => 2, 'kode' => 'S1', 'nama' => '110 CC', 'bobot' => '0.489'],
            ['kriteria_id' => 2, 'kode' => 'S2', 'nama' => '125 CC', 'bobot' => '0.285'],
            ['kriteria_id' => 2, 'kode' => 'S3', 'nama' => '150-160 CC', 'bobot' => '0.147'],
            ['kriteria_id' => 2, 'kode' => 'S4', 'nama' => '250 CC', 'bobot' => '0.079'],


            ['kriteria_id' => 3, 'kode' => 'S1', 'nama' => 'Biasa', 'bobot' => '0.412'],
            ['kriteria_id' => 3, 'kode' => 'S2', 'nama' => 'Cukup', 'bobot' => '0.293'],
            ['kriteria_id' => 3, 'kode' => 'S3', 'nama' => 'Lengkap', 'bobot' => '0.187'],
            ['kriteria_id' => 3, 'kode' => 'S4', 'nama' => 'Sangat Lengkap', 'bobot' => '0.108'],


           ['kriteria_id' => 4, 'kode' => 'S1', 'nama' => 'Irit', 'bobot' => '0.435'],
           ['kriteria_id' => 4, 'kode' => 'S2', 'nama' => 'Sangat Irit', 'bobot' => '0.309'],
           ['kriteria_id' => 4, 'kode' => 'S4', 'nama' => 'Tidak Irit', 'bobot' => '0.150'],
           ['kriteria_id' => 4, 'kode' => 'S5', 'nama' => 'Sangat Tidak Irit', 'bobot' => '0.106'],

        ]);
    }
}
