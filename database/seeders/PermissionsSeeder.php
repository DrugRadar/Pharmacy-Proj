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

        Permission::firstOrCreate(['name' => 'edit pharmacy']);
        Permission::firstOrCreate(['name' => 'delete pharmacy']);
        Permission::firstOrCreate(['name' => 'create pharmacy']);
        Permission::firstOrCreate(['name' => 'see all pharmacies']);
        Permission::firstOrCreate(['name' => 'edit serving area for pharmacy']);
        Permission::firstOrCreate(['name' => 'edit priority for pharmacy']);
       
        Permission::firstOrCreate(['name' => 'edit doctor']);
        Permission::firstOrCreate(['name' => 'delete doctor']);
        Permission::firstOrCreate(['name' => 'create doctor']);
        Permission::firstOrCreate(['name' => 'see all doctors']);

        Permission::firstOrCreate(['name' => 'edit area']);
        Permission::firstOrCreate(['name' => 'delete area']);
        Permission::firstOrCreate(['name' => 'create area']);
        Permission::firstOrCreate(['name' => 'see all areas']);

        Permission::firstOrCreate(['name' => 'edit medicine']);
        Permission::firstOrCreate(['name' => 'delete medicine']);
        Permission::firstOrCreate(['name' => 'create medicine']);
        Permission::firstOrCreate(['name' => 'see all medicines']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $pharmacy = Role::firstOrCreate(['name' => 'pharmacy']);
        $doctor = Role::firstOrCreate(['name' => 'doctor']);
  


        $admin->syncPermissions(['edit pharmacy','delete pharmacy','create pharmacy','edit doctor','delete doctor','create doctor','see all doctors','edit area','delete area','create area','see all areas','edit medicine','delete medicine','create medicine', 'see all medicines']);
        $pharmacy->syncPermissions(['edit doctor','delete doctor','create doctor','see all doctors']);
    }
}
