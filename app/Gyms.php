<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\PackageType;


class Gyms extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'city', "zip", "phone", "email"
    ];
    

    public function users(){
        return $this->hasMany('App\User', 'gym_id');
    }

    public function pts(){
        return $this->users()->where('type', "PT");
    }

    public function packages(){
        return PackageType::where("gym_id", $this->id)->orWhere("gym_id", null)->get();
    }

    public function classes(){
        return $this->hasMany('App\Classes');
    }

    public function members(){
        return $this->users()->where('type', "Client");
    }

    public function sessions(){
        return $this->hasMany('App\Sessions', 'gym_id');
    }
}
