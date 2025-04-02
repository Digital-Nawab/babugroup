<?php
// database/seeders/RolePermissionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Associate roles with permissions
        $rolePermissions = [
            // Admin permissions
            [
                'role_id' => 1, // Admin role id
                'permissions' => [1, 2, 3], // Permissions for Admin
            ],
            // Faculty permissions
            [
                'role_id' => 2, // Faculty role id
                'permissions' => [1, 2], // Permissions for Faculty
            ],
            // Student permissions
            [
                'role_id' => 3, // Student role id
                'permissions' => [1], // Permissions for Student
            ],
        ];

        foreach ($rolePermissions as $rolePermission) {
            foreach ($rolePermission['permissions'] as $permissionId) {
                DB::table('role_permission')->insert([
                    'role_id' => $rolePermission['role_id'],
                    'permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
