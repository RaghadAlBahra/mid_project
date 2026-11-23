<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable('customer_id', 'space_id', 'booking_date', 'start_time',
        'end_time', 'number_of_people', 'total_price', 'status')]
class Booking extends Model
{
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

        public function space(){
        return $this->belongsTo(Space::class);
    }

}
