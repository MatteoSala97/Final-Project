<?php

namespace Database\Seeders;

use App\Models\Accomodation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccomodationAdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $accommodationIds = [1169, 1366, 489, 960, 1176, 1503, 999, 150, 1238, 793, 338, 14, 1495, 1314, 368];
        $adId = 3;
        $expirationDate = Carbon::now()->addYears(100);

        foreach ($accommodationIds as $accommodationId) {
            Accomodation::find($accommodationId)->ads()->attach($adId, ['expiration_date' => $expirationDate]);
        }
    }
}
