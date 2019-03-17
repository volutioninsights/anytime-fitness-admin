<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'start', 'end', 'trainer_id', 'day', 'capacity', 'gym_id', "name", "class_date"
    ];

    public function gym(){
        return $this->belongsTo('App\Gyms');
    }

    public function trainer(){
        return $this->belongsTo('App\User', 'trainer_id');
    }
}