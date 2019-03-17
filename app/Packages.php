<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Packages extends Model
{
    protected $appends = ['sessionsUsed', 'nextSession'];

    public function type(){
        return $this->belongsTo('App\PackageType', "package_type_id");
    }

    public function client(){
        return $this->belongsTo('App\User', "client_id");
    }

    public function pt(){
        return $this->belongsTo('App\User', "trainer_id");
    }

    public function sessions(){
        return $this->hasMany('App\Sessions', 'package_id');
    }

    public function getSessionsUsedAttribute(){
        return $this->sessions()->count();
    }

    public function getNextSessionAttribute(){
        $s = $this->sessions()->where("when", '>', Carbon::now())->first();
        return ($s == null) ? false : $s;
    }
}
