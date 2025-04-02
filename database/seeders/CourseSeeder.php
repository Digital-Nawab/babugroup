<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the courses data
        $courses = [
            [
                'name' => 'BA',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Arts.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'B.SC',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Scince.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'B.SC- AG',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Scince (Agriculture).',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
           [
                'name' => 'B.COM',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Commerce.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name' => 'BBA',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Business Administration.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name' => 'BCA',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Computer Applications.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BLIB',
                'semesters' => '2',
                'category_id' => '3',
                'description' => 'Bachelor of Library and Information Science.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'M.A',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Master of Arts.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'M.SC',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Master of Science.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'M.COM',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Master of Commerce.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'M.COM',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Master of Commerce.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'B.Ed.',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Bachelor of Education.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'B.P.Ed.',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Bachelor of Physical Education.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'D.El.Ed.',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Diploma in Elementary Education.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'D.PHARM',
                'semesters' => '4',
                'category_id' => '3',
                'description' => 'Diploma in Pharmacy.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LLB',
                'semesters' => '6',
                'category_id' => '3',
                'description' => 'Bachelor of Legislative Law.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BA-LLB',
                'semesters' => '10',
                'category_id' => '3',
                'description' => 'Bachelor of Arts and Bachelor of Legislative Law',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        // Iterate through each course data
        foreach ($courses as $course) {
            // Check if a course with the same name and category_id already exists
            $exists = DB::table('courses')
                ->where('name', $course['name'])
                ->where('category_id', $course['category_id'])
                ->exists();

            // If it doesn't exist, insert the course
            if (!$exists) {
                DB::table('courses')->insert($course);
            }
        }
    }
}

