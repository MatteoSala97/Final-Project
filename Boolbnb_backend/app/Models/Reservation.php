<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_id',
        'accomodation_id',
        'start_date',
        'end_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the accommodation that the reservation is for.
     */
    public function accommodation()
    {
        return $this->belongsTo(Accomodation::class, 'accomodation_id');
    }

    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
}
