<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable('name','description','address', 'city', 'country',
        'contact_number', 'latitude', 'longitude', 'status')]
class Center extends Model
{
    public function spaces(){
        return $this->hasMany(Space::class);
    }
}
