<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(LoginSeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(YearSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CollegeSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);





        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@login.com',
            'contact' => '0000000000',
            'college_id' => '0',
            'role_id' => '0',
            'added_id' => '0',
            'added_by' => 'super admin',
            'password' => Hash::make('123456'),
            'status' => '1',
        ]);
    }
}
