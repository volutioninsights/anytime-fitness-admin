<?php

namespace App\Http\Controllers;

use App\User;
use App\Gyms;
use App\Sessions;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    private function getCompletedPrice($session)
    {
        // dump($session);
        switch ($session->sessions_type) {
            case "wc1":
                $type = 0;
                break;
            case "wc2":
                $type = 0;
                break;
            case "p12":
                $type = 908.33;
                break;
            case "p24":
                $type = 850;
                break;
            case "p30":
                $type = 796.67;
                break;
            case "p50":
                $type = 699.98;
                break;
            case "senior":
                $type = 0;
                break;
            case "ra":
                $type = 0;
                break;
            default:
                $type = 0;
                break;
        }
        // dump($type);
        return $type;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u = Auth::user();
        if(!$u->isAdmin()){
            return redirect()->route('gyms.view', ['gym' => $u->gym_id]);
        }


        $data = [
            "title" => "Dashboard",
            "stats" => [
                [
                    "statTitle" => "Total Gyms",
                    "stat" => Gyms::count(),
                ],
                [
                    "statTitle" => "Total PTs",
                    "stat" => User::where('type', 'PT')->count(),
                ],
                [
                    "statTitle" => "Total Members",
                    "stat" => User::where('type', 'Client')->get()->count(),
                ],
                [
                    "statTitle" => "Total Sessions",
                    "stat" => Sessions::all()->count(),
                ],
                [
                    "statTitle" => "Cancelled Sessions",
                    "stat" => Sessions::onlyTrashed()->where('cancel_reason', 'cancel')->get()->count()
                ],
                [
                    "statTitle" => "Session No Shows",
                    "stat" => Sessions::onlyTrashed()->where('cancel_reason', 'noshow')->get()->count()
                ],
                [
                    "statTitle" => "Completed Revenue",
                    "stat" => Sessions::where("completed", true)->get()->sum(function ($s) {
                        return $this->getCompletedPrice($s);
                    }),
                    "currency" => true
                ],
                [
                    "statTitle" => "Total Revenue",
                    "stat" => Sessions::all()->sum(function ($s) {
                        return $s->price;
                    }),
                    "currency" => true
                ],
            ],
        ];

        return view('dashboard')->with($data);
    }
}
