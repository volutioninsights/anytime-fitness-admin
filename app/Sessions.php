<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sessions extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'sessions_type', 'client_id', 'package_id', 'availability_id', 'when', 'price', 'pt_id', 'completed' , "total_sessions", "session_number", "payment_mode", "date_purchased", "expiry", "sessions_left"
    ];

    public function package(){
        return $this->belongsTo('App\Packages', 'package_id');
    }

    public function client(){
        return $this->belongsTo('App\User', 'client_id');
    }
}
