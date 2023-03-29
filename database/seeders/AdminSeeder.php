<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin=User::factory(1)->create([
            'email' => 'admin@admin.com',
            'password' => '123456',
            'is_admin' => true
        ]);
        $admin->assignRole(['admin']);
    }
}
