<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'date', 'start', 'end', 'available', 'day', 'user_id', 'gym_id' 
    ];
}
