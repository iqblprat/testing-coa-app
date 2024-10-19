<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriCOASeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp = now();

        DB::table('tb_kategori_coa')->insert([
            ['nama' => 'Salary', 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['nama' => 'Other Income', 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['nama' => 'Family Expense', 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['nama' => 'Transport Expense', 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['nama' => 'Meal Expense', 'status' => 1, 'deleted_at' => null, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ]);
    }
}
