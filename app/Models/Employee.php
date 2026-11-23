<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable('user_id','job_title','hire_date')]
class Employee extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
