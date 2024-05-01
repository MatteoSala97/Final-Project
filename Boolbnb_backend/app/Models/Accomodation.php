<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Accomodation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function distanceToPoint($lng, $lat)
    {
        // Calculate the distance between two points using longitude and latitude
        $earth_radius = 6371; // Radius of the earth in kilometers
        $dLat = deg2rad($lat - $this->latitude);
        $dLon = deg2rad($lng - $this->longitude);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($this->latitude)) * cos(deg2rad($lat)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c; // Distance in kilometers

        return $distance;
    }
}
