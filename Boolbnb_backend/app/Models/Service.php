<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accomodation;

class Service extends Model
{
    use HasFactory;

    public function accomodations()
    {
        return $this->belongsToMany(Accomodation::class);
    }
}
