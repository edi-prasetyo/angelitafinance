<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'brand-list',
        'brand-create',
        'brand-edit',
        'brand-delete',
        'car-list',
        'car-create',
        'car-edit',
        'car-delete',
        'category-list',
        'category-create',
        'category-edit',
        'category-delete',
        'customer-list',
        'customer-create',
        'customer-edit',
        'customer-delete',
        'package-list',
        'package-create',
        'package-edit',
        'package-delete',
        'product-list',
        'product-create',
        'product-edit',
        'product-delete',
        'transaction-list',
        'transaction-create',
        'transaction-edit',
        'transaction-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete'
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'Salim Santoso',
            'email' => 'atrans.salim@gmail.com',
            'role_as' => 1,
            'password' => Hash::make('Arwana65')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
