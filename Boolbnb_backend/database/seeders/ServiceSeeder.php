<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = config('amenities');
        foreach ($services as $key => $service) {
            Service::create([
                'id' => $key,
                'name' => $service,
                'icons' => Str::slug($service, '_') . '.svg'
            ]);
        }
    }
}
