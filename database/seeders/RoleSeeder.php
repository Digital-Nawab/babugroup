<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles data
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'Administrator role with full access',
                'status' => 1,  // 1 for active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Editor',
                'description' => 'Editor role with permissions to manage content',
                'status' => 1,  // 1 for active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Faculty',
                'description' => 'Faculty members who teach and manage courses.',
                'status' => 1, // 1 for active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student',
                'description' => 'Students enrolled in the university.',
                'status' => 1, // 1 for active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff',
                'description' => 'University staff members who provide administrative support.',
                'status' => 1, // 1 for active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alumni',
                'description' => 'Graduates of the university who maintain a connection with the institution.',
                'status' => 1, // 1 for active
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];
        // Insert the roles into the database
        foreach ($roles as $role) {
            // Check if the role already exists based on the 'slug'
            $exists = DB::table('roles')->where('name', $role['name'])->exists();

            // If the role doesn't exist, insert it into the table
            if (!$exists) {
                DB::table('roles')->insert($role);
            }
        }
    }
}
