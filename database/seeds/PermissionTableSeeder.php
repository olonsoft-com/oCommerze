<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'page-list',
           'page-create',
           'page-edit',
           'page-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',
           'customer-list',
           'customer-create',
           'customer-edit',
           'customer-delete',
           'bill-list',
           'bill-generate',
           'bill-edit',
           'bill-delete',
           'payment-list',
           'payment-create',
           'payment-edit',
           'payment-delete'
        ];

        $role = Role::where('name', 'super_admin')->first();

        foreach ($permissions as $permission) {
          $permission = Permission::create(['name' => $permission]);
          $permission->assignRole($role);
        }
    }
}
