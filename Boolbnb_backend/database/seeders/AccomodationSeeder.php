<?php

namespace Database\Seeders;

use App\Models\Accomodation;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccomodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonString = file_get_contents(config_path('api_data.json'));
        $dataArray = json_decode($jsonString, true);
        $userIds = User::pluck('id')->toArray();
        foreach ($dataArray as $record) {
            $new_record = new Accomodation();
            $new_record->title = $record['title'];
            $new_record->type = $record['type'];
            $new_record->rooms = $record['rooms'] ?? 1;
            $new_record->beds = $record['beds'] ?? 1;
            $new_record->bathrooms = $record['bathrooms'] ?? 0;
            $new_record->address = $record['address'];
            $new_record->city = $record['city'];
            $new_record->latitude = $record['latitude'];
            $new_record->longitude = $record['longitude'];
            $new_record->price_per_night = $record['price_per_night'];
            $new_record->thumb = $record['thumb'];
            $new_record->host_thumb = $record['host_thumb'];
            $new_record->rating = $record['rating'] ?? 0;
            $new_record->user_id = $userIds[array_rand($userIds)];
            $new_record->save();

            foreach ($record['pictures'] as $key => $picture) {
                $new_picture = new Picture();
                $new_picture->url = $picture;
                $new_picture->name = 'pic-' . $new_record->id . '-' . $key;
                $new_picture->accomodation_id = $new_record->id;
                $new_picture->save();
            };

            foreach ($record['services'] as $serviceId) {
                $new_record->services()->attach($serviceId, ['created_at' => now(), 'updated_at' => now()]);
            }
        };
    }
}
