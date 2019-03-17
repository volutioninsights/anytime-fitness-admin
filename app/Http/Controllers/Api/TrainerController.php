<?php

namespace App\Http\Controllers\Api;

use App\Availability;
use App\Files;
use App\Gyms;
use App\Sessions;
use App\TrainerDetails;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class TrainerController extends Controller
{
    public function clients(){
        $u = Auth::user();
        $u->type = "PT";
        $clients = $u->sessions;
        dd($clients);
    }
}
