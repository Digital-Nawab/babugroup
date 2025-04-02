<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            ['name' => 'Chhatrapati Shahu Ji Maharaj University', 'location' => 'Kanpur, Uttar Pradesh', 'status' => 1],
            ['name' => 'University of Lucknow', 'location' => 'Lucknow, Uttar Pradesh', 'status' => 1],
        ];

        foreach ($universities as $university) {
            DB::table('universities')->updateOrInsert(
                ['name' => $university['name']],
                ['location' => $university['location'], 'status' => $university['status'], 'created_at' => now(), 'updated_at' => now()]
            );
        }

    }
}
