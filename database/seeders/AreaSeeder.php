<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Smouha',
                'address' => '26 smouha',
            ],
            [
                'name' => 'Sidibishr',
                'address' => '16 mahmoud reda',
            ],
            [
                'name' => 'campchizar',
                'address' => '46 helipolis',
            ],
        ];

        foreach($areas as $area){
            Area::create($area);
        }
    }
}
