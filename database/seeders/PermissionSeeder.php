<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the permissions data
        $permissions = [
            [
                'name' => 'View Dashboard',
                'description' => 'Permission to view the admin dashboard.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manage Courses',
                'description' => 'Permission to manage course data.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manage Users',
                'description' => 'Permission to manage users (admins, faculty, students).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'View Grades',
                'description' => 'Permission to view student grades.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Profile',
                'description' => 'Permission to edit personal profile information.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'View Faculty Info',
                'description' => 'Permission to view faculty member information.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manage Departments',
                'description' => 'Permission to manage departments within the university.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert permissions into the permissions table
        foreach ($permissions as $permission) {
            // Check if the permission already exists
            $exists = DB::table('permissions')->where('name', $permission['name'])->exists();

            // If the permission doesn't exist, insert it
            if (!$exists) {
                DB::table('permissions')->insert($permission);
            }
        }
    }
}
