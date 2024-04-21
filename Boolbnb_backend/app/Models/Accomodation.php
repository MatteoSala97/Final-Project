<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Accomodation extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
