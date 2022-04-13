<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMatkulSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai=[
            ['mahasiswa_id' => 1, 'matakuliah_id' => 1, 'nilai' => 'A'],
            ['mahasiswa_id' => 1, 'matakuliah_id' => 2, 'nilai' => 'B'],
            ['mahasiswa_id' => 1, 'matakuliah_id' => 3, 'nilai' => 'A'],
            ['mahasiswa_id' => 1, 'matakuliah_id' => 4, 'nilai' => 'B'],
            ['mahasiswa_id' => 4, 'matakuliah_id' => 1, 'nilai' => 'B'],
            ['mahasiswa_id' => 4, 'matakuliah_id' => 2, 'nilai' => 'A'],
            ['mahasiswa_id' => 4, 'matakuliah_id' => 3, 'nilai' => 'B'],
            ['mahasiswa_id' => 4, 'matakuliah_id' => 4, 'nilai' => 'A'],
        ];
        DB::table('mahasiswa_matakuliah')->insert($nilai);
    }
}
