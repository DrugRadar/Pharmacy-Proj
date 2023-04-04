<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AreaSeeder::class);
        $this->call(MedicineSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->command->info('Seeded the countries!');
        // $this->call(AdminSeeder::class);
    }
}
