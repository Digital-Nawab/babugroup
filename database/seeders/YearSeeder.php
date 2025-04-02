<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            ['name' => '2023', 'is_current' => 0, 'status' => 1],
            ['name' => '2024', 'is_current' => 1, 'status' => 1],
            ['name' => '2025', 'is_current' => 0, 'status' => 1],
        ];

        foreach ($years as $year) {
            DB::table('years')->updateOrInsert(
                ['name' => $year['name']],
                ['is_current' => $year['is_current'], 'status' => $year['status'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
