<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles data
        $roles = [
            [
                'college_id'        => '0',
                'name'              => 'Super Admin',
                'email'             => 'admin@login.com',  // Fixed space in 'email '
                'email_verified_at' => now(),
                'password'          => Hash::make('123456'),
                'salt_password'     => base64_encode('123456'),  // Note: This might be redundant with Hash::make
                'remember_token'    => Str::random(10),
                'role_id'           => 1,
                'status'            => 1,  // 1 for active
                'added_by'          => 'self',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ];

        // Insert the roles into the database
        foreach ($roles as $role) {
            // Check if the user already exists based on 'email'
            $exists = DB::table('logins')->where('email', $role['email'])->exists();

            // If the user doesn't exist, insert it into the table
            if (!$exists) {
                DB::table('logins')->insert($role);
            }
        }
    }
}
