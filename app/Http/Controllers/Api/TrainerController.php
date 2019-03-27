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

        $sessions =Sessions::where('pt_id', $u->id)->get();

        $clients = User::find($sessions->pluck('client_id'));

        if (empty($clients)) {
            return response()->json([
                'no clients for this user'
            ], 400);
        }
        return response()->json($clients, 200);

    }
}
