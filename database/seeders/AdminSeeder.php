<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin=User::create([
            'name' => 'admin',
            'email' => 'admin1@admin.com',
            'password' => Hash::make('123456'),
            'is_admin' => true
        ])->assignRole('admin');

    }
}
