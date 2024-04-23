<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Accomodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type','rooms',
        'beds',
        'bathrooms',
        'address',
        'city',
        'latitude',
        'longitude',
        'price_per_night',
        'hidden',
        'thumb',
        'host_thumb',
        'rating',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
