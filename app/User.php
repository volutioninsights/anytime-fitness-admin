<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'force_pw_change'
    ];

    public function gym(){
        return $this->belongsTo('App\Gyms');
    }

    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }

    public function packages(){
        return $this->hasMany('App\Packages', 'trainer_id');  
        if($this->type == "PT"){
            return $this->hasMany('App\Packages', 'trainer_id');    
        }

        if($this->type == "Client"){
            return $this->hasMany('App\Packages', 'client_id');    
        }
    }

    public function details(){
        return $this->hasOne('App\TrainerDetails');
    }

    public function files(){
        return $this->hasMany('App\Files');
    }

    public function avatar(){
        return $this->files->where('type', 'avatar')->first();
    }

    public function pts(){
        return $this->where('type', 'PT')->get();
    }

    public function sessions(){
        if($this->type == "PT"){
            return $this->hasMany('App\Sessions', 'pt_id');    
        }

        if($this->type == "Client"){
            return $this->hasMany('App\Sessions', 'client_id');    
        }
    }
}
