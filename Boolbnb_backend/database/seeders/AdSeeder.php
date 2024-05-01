<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ads = [
            [
                'name' => 'Silver',
                'duration' => 1,
                'price_per_day' => 2.99
            ],
            [
                'name' => 'Gold',
                'duration' => 3,
                'price_per_day' => round(5.99 / 3, 2)
            ],
            [
                'name' => 'Platinum',
                'duration' => 6,
                'price_per_day' => round(9.99 / 6, 2)
            ],
        ];

        foreach ($ads as $ad) {
            Ad::create([
                'name' => $ad['name'],
                'duration' => $ad['duration'],
                'price_per_day' => $ad['price_per_day']
            ]);
        }
    }
}
