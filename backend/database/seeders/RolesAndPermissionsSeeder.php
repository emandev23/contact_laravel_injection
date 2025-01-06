<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        
        // Create Roles and assign permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('view users', 'edit users', 'delete users');
        
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('view users');
        
    // You can also assign roles to a user like this:
    // $user = User::find(1);
    // $user->assignRole('admin');
    }
}
