<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions 
        Permission::create(['name' => 'edit pharmacy']);
        Permission::create(['name' => 'delete pharmacy']);
        Permission::create(['name' => 'create pharmacy']);
        // Permission::create(['name' => 'see all pharmacies']);
        // Permission::create(['name' => 'edit serving area of pharmacy']);
        // Permission::create(['name' => 'edit priority of pharmacy']);
       
        Permission::create(['name' => 'edit doctor']);
        Permission::create(['name' => 'delete doctor']);
        Permission::create(['name' => 'create doctor']);

        Permission::create(['name' => 'edit area']);
        Permission::create(['name' => 'delete area']);
        Permission::create(['name' => 'create area']);

        $admin = Role::create(['name' => 'admin']);
        $pharmacy = Role::create(['name' => 'pharmacy']);
        $doctor = Role::create(['name' => 'doctor']);


        $admin->syncPermissions(['edit pharmacy','delete pharmacy','create pharmacy','edit doctor','delete doctor','create doctor','edit area','delete area','create area']);
        $pharmacy->syncPermissions(['edit doctor','delete doctor','create doctor']);
    }
}
