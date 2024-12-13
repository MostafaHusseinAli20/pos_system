<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionAndUserSeeder extends Seeder
{
    private $permissions = [
        'create_user',
        'read_user',
        'update_user',
        'delete_user',

        'create_role',
        'read_role',
        'update_role',
        'delete_role',

        'read_category',
        'create_category',
        'update_category',
        'delete_category',

        'read_product',
        'create_product',
        'update_product',
        'delete_product',

        'read_client',
        'create_client',
        'update_client',
        'delete_client',

        'read_order',
        'show_order',
        'create_order',
        'update_order',
        'delete_order',

        'notifications',
     ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('123456789'),
            'roles_name' => json_encode(['super_admin']),
            'status' => 'active',
        ]);

        $role = Role::create(['name' => 'super_admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
