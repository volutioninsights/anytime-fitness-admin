<?php

namespace App\Http\Controllers;

use App\Availability;
use App\Files;
use App\Gyms;
use App\Sessions;
use App\TrainerDetails;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class PTController extends Controller
{
    public function session(Request $request, User $pt)
    {
        // dd($request);
        $s = new Sessions;
        $s->when = Carbon::createFromTimestamp($request->start);
        $s->pt_id = $pt->id;
        $s->fill($request->all());
        // $s = new Sessions;
        // $s->when = Carbon::createFromTimestamp($request->start);
        // $s->pt_id = $pt->id;
        // $s->client_id = $request->client;
        // $s->price = $request->price;
        // $s->sessions_type = $request->type;
        // $s->notes = $request->notes;
        // $s->fill($request->only(["total_sessions", "session_number", "payment_mode", "date_purchased", "expiry", "sessions_left"]));

        return response()->json($s->save());
    }

    public function editSession(Request $request, User $pt, Sessions $session)
    {
        $session->update($request->all());
        return response()->json(true);
    }

    public function removeSession(Request $request, User $pt, Sessions $session)
    {
        $session->cancel_reason = $request->reason;
        $session->save();
        return response()->json($session->delete());
    }

    public function changeSession(Request $request, User $pt, Sessions $session)
    {
        $session->update([
            'when' => Carbon::createFromTimestamp($request->start),
        ]);

        return response()->json(true);
    }

    public function completeSession(Request $request, User $pt, Sessions $session)
    {
        $session->update([
            'completed' => true,
        ]);

        return response()->json(true);
    }

    public function availability(Request $request, User $pt, Availability $availability = null)
    {
        if ($request->isMethod('post')) {
            if ($availability != null) {

                if ($request->has('action') || @$request['action'] == "delete") {
                    $availability->delete();
                    return response()->json(true);
                }

                $availability->update([
                    'start' => Carbon::createFromTimestamp($request->start),
                    'end' => Carbon::createFromTimestamp($request->end),
                ]);

                return response()->json(true);
            }

            $r = Availability::create([
                'date' => Carbon::createFromTimestamp($request->start)->toDateString(),
                'start' => Carbon::createFromTimestamp($request->start),
                'end' => Carbon::createFromTimestamp($request->end),
                'day' => Carbon::createFromTimestamp($request->start)->dayOfWeek,
                'user_id' => $pt->id,
                'gym_id' => $pt->gym_id,
            ]);
            return response()->json(($r));
        }

        $start = Carbon::createFromTimestamp($request->start);
        $end = Carbon::createFromTimestamp($request->end);
        $av = Availability::where('user_id', $pt->id)->where("start", ">=", $start->toDateTimeString())->where("end", "<=", $end->toDateTimeString())->get();
        return response()->json($av);
    }

    public function toggle(User $pt)
    {
        $pt->disabled = !$pt->disabled;
        $pt->save();
        return redirect()->route('pt.view', ['pt' => $pt->id]);
    }

    public function delete(User $pt)
    {
        $gym = $pt->gym;
        $pt->delete();
        return redirect()->route('gyms.view', ['gym' => $gym->id]);
    }

    public function cal(Request $request, User $pt)
    {
        $start = Carbon::createFromTimestamp($request->start);
        $end = Carbon::createFromTimestamp($request->end);

        $avs = Availability::where('user_id', $pt->id)->where("start", ">=", $start->toDateTimeString())->where("end", "<=", $end->toDateTimeString())->get();

        // $sesh = new Collection();
        // foreach ($avs as $a) {
        //     $s = Sessions::with('package', 'package.client', 'package.pt.gym')->where('availability_id', $a->id)->where("when", ">=", $start->toDateTimeString())->where("when", "<=", $end->toDateTimeString())->get();
        //     $sesh = $sesh->merge($s);
        // }

        $sesh = Sessions::with('client')->where('pt_id', $pt->id)->where('completed', false)->where("when", ">=", $start->toDateTimeString())->where("when", "<=", $end->toDateTimeString())->get();
        $comp = Sessions::with('client')->where('pt_id', $pt->id)->where('completed', true)->where("when", ">=", $start->toDateTimeString())->where("when", "<=", $end->toDateTimeString())->get();

        $res['completeSessions'] = $comp;
        $res['sessions'] = $sesh;
        $res['availability'] = $avs;
        return response()->json($res);
    }

    function new (Request $request, Gyms $gym) {
        if ($request->method() == "POST") {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gym_id = $gym->id;
            $user->type = "PT";
            $user->api_token = Str::random(100);
            $user->save();

            // dd($user);

            $details = TrainerDetails::make($request->all());
            $details->fill(['user_id' => $user->id]);
            $details->save();

            // dd($details);

            if ($request->has('avatar') && @$request->avatar != null) {
                $avatar = new Files;

                // $file = Image::make($request->file('avatar'))->resize(300, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // });

                $avatar->path = $request->file('avatar')->store('public/avatars');
                $avatar->user_id = $user->id;
                $avatar->fileName = basename($avatar->path);
                $avatar->save();
            }

            return redirect()->route('pt.view', ['pt' => $user->id]);
        }

        $data = [
            "title" => "New Trainer ({$gym->name})",
            "gym" => $gym,
        ];
        return view('pt.details')->with($data);
    }

    public function edit(Request $request, User $pt)
    {
        if ($request->method() == "POST") {
            $pt->update($request->all());
            if ($pt->details) {
                $pt->details->update($request->all());
            } else {
                $details = TrainerDetails::create(['user_id' => $pt->id]);
                $details->fill($request->all());
            }
            $pt->save();

            if ($request->has('avatar') && @$request->avatar != null) {
                $av = $pt->avatar();
                if ($av) {
                    $av->delete();
                }
                $avatar = new Files;
                $avatar->path = $request->file('avatar')->store('public/avatars');
                $avatar->user_id = $pt->id;
                $avatar->fileName = basename($avatar->path);
                $avatar->save();
            }
            return redirect()->route('pt.view', ['pt' => $pt->id]);
        }
        $pt->load('details');
        $data = [
            "title" => "Edit Trainer ({$pt->name})",
            "pt" => $pt,
            "avatar" => $pt->avatar(),
            "gym" => $pt->gym,
        ];
        return view('pt.details')->with($data);
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
            case "kickstart":
                $type = 750;
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

    public function view(User $pt)
    {
        $pt->load('packages', 'packages.type', 'packages.client');

        $rev = $pt->sessions->sum(function ($session) {
            return $session->price;
        });

        $complete = Sessions::where("completed", true)->where('pt_id', $pt->id)->get()->sum(function ($session) {
            return $this->getCompletedPrice($session);
            // return 0;//$this->getCompletedPrice($session);
        });

        $clientsCount = $pt->sessions->groupBy('client_id')->count();

        $cancel = Sessions::onlyTrashed()->where('pt_id', $pt->id)->where('cancel_reason', 'cancel')->get()->count();
        $noshow = Sessions::onlyTrashed()->where('pt_id', $pt->id)->where('cancel_reason', 'noshow')->get()->count();

        $c = $pt->sessions->groupBy('client_id');

        // $clients = [];
        // foreach($c as $k => $cl){
        //     $cur = [];
        //     // $cur['client'] = User::find($k);
        //     $s = Sessions::where("pt_id", $pt->id)->where("client_id", $k)->groupBy("sessions_type")->get();
        //     dump($s);
        // }





        // dd($c);

        $data = [
            "title" => $pt->name,
            "pt" => $pt,
            "clients" => $c,
            "avatar" => $pt->avatar(),
            "stats" => [
                [
                    "statTitle" => "Total Clients",
                    "stat" => $clientsCount,
                ],
                [
                    "statTitle" => "Cancellations",
                    "stat" => $cancel,
                ],
                [
                    "statTitle" => "No Shows",
                    "stat" => $noshow,
                ],
                [
                    "statTitle" => "Completed Sessions",
                    "stat" => Sessions::where('pt_id', $pt->id)->where("completed", true)->whereNotIn("sessions_type", ["wc", "wc1"])->get()->count(),
                ],
                [
                    "statTitle" => "Completed WC",
                    "stat" => Sessions::where('pt_id', $pt->id)->where("completed", true)->whereIn("sessions_type", ["wc", "wc1"])->get()->count(),
                ],
                // [
                //     "statTitle" => "Booked Sessions",
                //     "stat" => Sessions::where('pt_id', $pt->id)->where("completed", false)->get()->count(),
                // ],
                [
                    "statTitle" => "Completed Revenue",
                    "stat" => $complete,
                    "currency" => true,
                ],
                [
                    "statTitle" => "Total Revenue",
                    "stat" => $rev,
                    "currency" => true,
                ],
                // ,
                // [
                //     "statTitle" => "Close Ratio",
                //     "stat" => 0,
                //     "percent" => true,
                // ],
            ],
        ];


        // if(Auth::user()->id == 1){
            return view('pt.Nview')->with($data);
        // }
        // return view('pt.view')->with($data);
    }
}
