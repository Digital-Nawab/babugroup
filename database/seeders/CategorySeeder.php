<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['name' => 'Medical College', 'description' => 'D. Pharma', 'status' => 1],
            ['name' => 'Law College', 'description' => 'LLB', 'status' => 1],
            ['name' => 'Mahavidyalaya', 'description' => 'BA', 'status' => 1],
        ];

        foreach ($category as $cat) {
            DB::table('categories')->updateOrInsert(
                ['name' => $cat['name']],
                ['description' => $cat['description'], 'status' => $cat['status'], 'created_at' => now(), 'updated_at' => now()]
            );
        }

    }
}
