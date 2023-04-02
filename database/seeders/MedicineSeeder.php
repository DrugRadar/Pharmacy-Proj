<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            [
                'name' => 'zyrtec',
                'type' => 'antihistaminic',
                'price' =>'50',
            ],
            [
                'name' => 'concor',
                'type' => 'antihypertensive',
                'price' =>'60',
            ],
            [
                'name' => 'Brufen',
                'type' => 'painkiller',
                'price' =>'40',
            ],
            [
                'name' => 'adancor',
                'type' => 'antihypertensive',
                'price' =>'90',
            ],

        ];

        foreach ($medicines as$medicine){
            Medicine::create($medicine);
        }
    }
}
