<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable('center_id', 'name', 'description', 'type',
        'maximum_capacity', 'hourly_price', 'status')]
class Space extends Model
{
    public function center(){
        return $this->belongsTo(Center::class);
    }

     public function bookings(){
        return $this->hasMany(Booking::class);
    }


}
