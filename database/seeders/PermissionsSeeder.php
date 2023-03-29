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
        $guards = ['admin', 'pharmacy'];

        foreach ($guards as $guard) {
        Permission::create(['name' => 'edit pharmacy', 'guard_name' => $guard]);
        Permission::create(['name' => 'edit doctor', 'guard_name' => $guard]);
        Permission::create(['name' => 'delete doctor', 'guard_name' => $guard]);
        Permission::create(['name' => 'create doctor', 'guard_name' => $guard]);
        }
        // Permission::firstOrCreate(['guard_name' => ['admin', 'pharmacy'],'name' => 'edit pharmacy']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'delete pharmacy']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'create pharmacy']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'see all pharmacies']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'edit serving area of pharmacy']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'edit priority of pharmacy']);
       
        // Permission::firstOrCreate(['guard_name' => ['admin', 'pharmacy'],'name' => 'edit doctor']);
        // Permission::firstOrCreate(['guard_name' => ['admin', 'pharmacy'],'name' => 'delete doctor']);
        // Permission::firstOrCreate(['guard_name' => ['admin', 'pharmacy'],'name' => 'create doctor']);

        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'edit area']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'delete area']);
        Permission::firstOrCreate(['guard_name' => 'admin','name' => 'create area']);

        $admin = Role::firstOrCreate(['guard_name' => 'admin','name' => 'admin']);
        $pharmacy = Role::firstOrCreate(['guard_name' => 'pharmacy','name' => 'pharmacy']);
        $doctor = Role::firstOrCreate(['guard_name' => 'doctor','name' => 'doctor']);


        $admin->syncPermissions(['edit pharmacy','delete pharmacy','create pharmacy','edit doctor','delete doctor','create doctor','edit area','delete area','create area']);
        $pharmacy->syncPermissions(['edit doctor','delete doctor','create doctor']);
    }
}
