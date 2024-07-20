<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create user permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // create equipment permissions
        Permission::create(['name' => 'create equipment']);
        Permission::create(['name' => 'view equipment']);
        Permission::create(['name' => 'edit equipment']);
        Permission::create(['name' => 'delete equipment']);

        // create equipment assignment  permissions
        Permission::create(['name' => 'view equipment assignment']);
        Permission::create(['name' => 'assign equipment']);
        Permission::create(['name' => 'unassign equipment']);
        Permission::create(['name' => 'record return of equipment']);

        // create roles and assign existing permissions
        $company_admin = Role::create(['name' => 'company-admin']);
        $company_admin->givePermissionTo('create equipment');
        $company_admin->givePermissionTo('edit equipment');
        $company_admin->givePermissionTo('delete equipment');
        $company_admin->givePermissionTo('view equipment assignment');
        $company_admin->givePermissionTo('assign equipment');
        $company_admin->givePermissionTo('view equipment');
        $company_admin->givePermissionTo('record return of equipment');

        $super_admin = Role::create(['name' => 'super-admin']);

        $normal_user = Role::create(['name' => 'regular-user']);

        // create demo users
        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole($normal_user);

        $user = User::factory()->create([
            'name' => 'Company Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole($company_admin);

        $user = User::factory()->create([
            'name' => 'Super-Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole($super_admin);

    }
}
