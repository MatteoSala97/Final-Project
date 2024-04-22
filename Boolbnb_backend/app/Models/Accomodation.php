<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Accomodation extends Model
{
    use HasFactory;

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    // public function beds()
    // {
    //     return $this->hasMany();
    // }
}
