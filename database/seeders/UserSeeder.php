<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'first_name' => 'test',
            'last_name' => 'exmple',
            'email' => 'test@example.com',
            'image' => 'default.png',
            'password' => bcrypt('123456789'),
            'roles_name' => json_encode(['admin']),
            'status' => 'active',
        ]);

        $role = Role::create(['name' => 'admin']);
        $permissions = [
            'read_user',
            'create_role',
            'read_category',
            'read_product',
            'read_client',
            'read_order',
            'notifications',
        ];
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
