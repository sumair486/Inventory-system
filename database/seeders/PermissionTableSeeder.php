<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'setting-list',
            'setting-create',
            'setting-edit',
            'setting-delete',
            'transaction-list',
            'transaction-create',
            'transaction-edit',
            'transaction-delete',
            'transfer-list',
            'transfer-create',
            'transfer-edit',
            'transfer-delete',
            'commission-list',
            'commission-create',
            'commission-edit',
            'commission-delete',
            'warehouse-list',
            'warehouse-create',
            'warehouse-edit',
            'warehouse-delete',
            'sale-list',
            'sale-create',
            'sale-edit',
            'sale-delete',
            'report-list'

         ];
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
