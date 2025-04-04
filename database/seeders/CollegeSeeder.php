<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colleges = [
            ['category_id' => 1, 'university_id' => 1, 'college_name' => 'Babu P. Shiv Bhushan Sharma College of Pharmacy', 'college_code' => 'BPSB001', 'description' => 'Pharma College'],
            ['category_id' => 1, 'university_id' => 1, 'college_name' => 'Babu P. Rameshwar Prasad Dwivedi College of Pharmacy', 'college_code' => 'BPRP002', 'description' => 'Pharma College'],
            ['category_id' => 1, 'university_id' => 1, 'college_name' => 'Babu Bhisham Singh Institutions of Pharmacy', 'college_code' => 'BBSI003', 'description' => 'Pharma College'],
            ['category_id' => 1, 'university_id' => 1, 'college_name' => 'Babu Rampal Singh College of Pharmacy', 'college_code' => 'BBSI004', 'description' => 'Pharma College'],
            ['category_id' => 1, 'university_id' => 1, 'college_name' => 'Babu Jaysankar Gayaprasad College of Pharmacy', 'college_code' => 'BBSI005', 'description' => 'Pharma College'],
            ['category_id' => 2, 'university_id' => 1, 'college_name' => 'Babu Jai Shankar Gaya Law College', 'college_code' => 'UN49', 'description' => 'Law College'],
            ['category_id' => 3, 'university_id' => 1, 'college_name' => 'Babu Jai Shankar Gaya Prasad P.g. College', 'college_code' => 'UN10', 'description' => 'P.G College'],
            ['category_id' => 3, 'university_id' => 1, 'college_name' => 'Babu Abdul Sattar Khan P.G College', 'college_code' => 'RB4035', 'description' => 'P.G College'],
            ['category_id' => 3, 'university_id' => 1, 'college_name' => 'Babu Bheesham Singh Institutions of Higher Education', 'college_code' => 'RB4033', 'description' => 'P.G College'],
            ['category_id' => 3, 'university_id' => 1, 'college_name' => 'Babu Rampal Singh P.G College', 'college_code' => 'UN52', 'description' => 'P.G College'],
            ['category_id' => 3, 'university_id' => 1, 'college_name' => 'Babu Pt. Rameshwar Prasad Dwivedi Mahavidyalaya', 'college_code' => 'RB4040', 'description' => 'P.G College'],
            ['category_id' => 3, 'university_id' => 1, 'college_name' => 'Babu Pt. Shiv Bhushan Sharma Mahavidyalaya', 'college_code' => 'RB077', 'description' => 'P.G College'],
        ];

        foreach ($colleges as $college) {
            $college['slug_url'] = Str::slug($college['college_name']);
            $college['college_email'] = strtolower(Str::slug($college['college_name'])) . '@example.com';
            $college['college_contact'] = '900000' . rand(1000, 9999);
            DB::table('colleges')->updateOrInsert(
                ['college_code' => $college['college_code']],
                array_merge($college, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
