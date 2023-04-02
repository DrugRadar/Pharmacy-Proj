<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class OrderPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $banned = Role::firstOrCreate(['name' => 'banned']);
        
        Permission::firstOrCreate(['name' => 'create order']);
        Permission::firstOrCreate(['name' => 'delete order']);
        Permission::firstOrCreate(['name' => 'edit order']);
        Permission::firstOrCreate(['name' => 'see all orders']);

        $admin = Role::findByName('admin');
        $doctor = Role::findByName('doctor');
        $pharmacy = Role::findByName('pharmacy');
        $pharmacy->syncPermissions(['create order','delete order','edit order','see all orders']);
        $doctor->syncPermissions(['create order','delete order','edit order','see all orders']);
        $admin->syncPermissions(['create order','delete order','edit order','see all orders']);
    }
}
