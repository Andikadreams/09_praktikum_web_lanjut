<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'mahasiswa_id' => '2141720007',
                'matakuliah_id' => 1,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => '2141720007',
                'matakuliah_id' => 2,
                'nilai' => 'B+',
            ],
            [
                'mahasiswa_id' => '2141720007',
                'matakuliah_id' => 3,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => '2141720007',
                'matakuliah_id' => 4,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => '2141720022',
                'matakuliah_id' => 2,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => '2141720079',
                'matakuliah_id' => 4,
                'nilai' => 'B',
            ],
        ];
        DB::table('mahasiswa_matakuliah')->insert($data);
    }
}