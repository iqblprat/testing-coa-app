<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartOfAccountSeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp = now();

        DB::table('tb_chart_of_account')->insert([
            ['kode' => '401', 'nama' => 'Gaji Karyawan', 'kategori_id' => 1, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '402', 'nama' => 'Gaji Ketua MPR', 'kategori_id' => 1, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '403', 'nama' => 'Profit Trading', 'kategori_id' => 2, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '601', 'nama' => 'Biaya Sekolah', 'kategori_id' => 3, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '602', 'nama' => 'Bensin', 'kategori_id' => 4, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '603', 'nama' => 'Parkir', 'kategori_id' => 4, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '604', 'nama' => 'Makan Siang', 'kategori_id' => 5, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['kode' => '605', 'nama' => 'Makanan Pokok Bulanan', 'kategori_id' => 5, 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ]);
    }
}
