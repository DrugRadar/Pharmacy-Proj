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
                'country_id' => '818',
            ],
            [
                'name' => 'Sidibishr',
                'address' => '16 mahmoud reda',
                'country_id' => '818',
            ],
            [
                'name' => 'campchizar',
                'address' => '46 helipolis',
                'country_id' => '818',
            ],
        ];

        foreach($areas as $area){
            Area::create($area);
        }
    }
}
