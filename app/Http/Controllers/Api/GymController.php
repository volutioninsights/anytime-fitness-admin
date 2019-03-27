<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GymController extends Controller
{
    public function index()
    {
        $u = Auth::user();
        if(!$u->isAdmin()){
            return redirect()->route('gyms.view', ['gym' => $u->gym_id]);
        }
        $data = [
            "title" => "All Gyms",
            "gyms" => Gyms::all()->map(function($g){
                $g->sessions = $g->pts->sum(function ($pt) {
                    return Sessions::where('pt_id', $pt->id)->where("completed", true)->get()->count();
                });
                return $g;
            }),
        ];

        return response()->json($data, 200);
    }

    public function edit(Request $request, Gyms $gym)
    {
        if ($request->isMethod('post')) {
            $gym->update($request->all());
            return redirect()->route('gyms.view', ['gym' => $gym->id]);
        }
        $data = [
            "title" => "Edit Gym ({$gym->name})",
            "gym" => $gym,
        ];

        return response()->json($data, 200);
    }

    function deleteMember(Request $request, Gyms $gym, User $member){
        $member->delete();
        return response()->json($gym, 200);
    }

    function deleteClass(Request $request, Gyms $gym, Classes $class){
        $class->delete();
        return response()->json($gym, 200);
    }

    function newMember(Request $request, Gyms $gym) {
        if ($request->method() == "POST") {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gym_id = $gym->id;
            $user->type = "Client";
            $user->api_token = Str::random(100);
            $user->save();

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

            return response()->json($gym, 200);
        }

        $data = [
            "title" => "New Member ({$gym->name})",
            "gym" => $gym,
        ];
        return response()->json($data, 200);
    }

    public function editMember(Request $request, Gyms $gym, User $member)
    {
        if ($request->method() == "POST") {
            $member->update($request->all());
            $member->save();

            if ($request->has('avatar') && @$request->avatar != null) {
                $av = $member->avatar();
                if ($av) {
                    $av->delete();
                }
                $avatar = new Files;
                $avatar->path = $request->file('avatar')->store('public/avatars');
                $avatar->user_id = $member->id;
                $avatar->fileName = basename($avatar->path);
                $avatar->save();
            }
            return response()->json($member, 200);
        }
        $data = [
            "title" => "Edit Member ({$member->name})",
            "member" => $member,
            "avatar" => $member->avatar(),
            "gym" => $member->gym,
        ];

        return response()->json($data, 200);
    }

    public function delete(Gyms $gym){
        $gym->delete();
        return response()->json($gym->delete(), 200);
    }

    public function classes(Request $request, Gyms $gym, Classes $class = null)
    {
        if ($request->isMethod('post')) {
            if ($class != null) {
                if($request->has("start")){
                    $class->class_date = Carbon::createFromTimestamp($request->start)->toDateString();
                    $class->start = Carbon::createFromTimestamp($request->start);
                    $class->end = Carbon::createFromTimestamp($request->end);
                    $class->day = Carbon::createFromTimestamp($request->start)->dayOfWeek;
                    $class->save();
                }else{
                    $class->update($request->only(['name', 'capacity']));
                    $class->update(["trainer_id" => $request->trainer_id]);
                }

                return response()->json(true);
            }

            $class = new Classes;
            $class->name = $request->name; //$request->name;
            $class->gym_id = $gym->id;
            $class->trainer_id = $request->trainer_id;
            $class->class_date = Carbon::createFromTimestamp($request->start)->toDateString();
            $class->start = Carbon::createFromTimestamp($request->start);
            $class->end = Carbon::createFromTimestamp($request->end);
            $class->day = Carbon::createFromTimestamp($request->start)->dayOfWeek;
            $class->capacity = $request->capacity;

            // if (is_int($request->user)) {
            //     $class->trainer_id = $request->user;
            // } else {
            //     $class->freelance = $request->user;
            // }

            $class->save();
            return response()->json($class);
        }

        $start = Carbon::createFromTimestamp($request->start);
        $end = Carbon::createFromTimestamp($request->end);
        $av = Classes::with('trainer')->where('gym_id', $gym->id)->where("start", ">=", $start->toDateTimeString())->where("end", "<=", $end->toDateTimeString())->get();
        return response()->json($av, 200);
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

    public function view(Gyms $gym)
    {

        // dd($gym->sessions);

        $rev = $gym->pts->sum(function ($pt) {
            return $pt->sessions->sum('price');
        });

        // $booked = $gym->pts->sum(function ($pt) {
        //     return Sessions::where('pt_id', $pt->id)->where("completed", false)->get()->count();
        // });

        $complete = $gym->pts->sum(function ($pt) {
            return Sessions::where('pt_id', $pt->id)->where("completed", true)->whereNotIn("sessions_type", ["wc", "wc1"])->get()->count();
        });

        $completeWC = $gym->pts->sum(function ($pt) {
            return Sessions::where('pt_id', $pt->id)->where("completed", true)->whereIn("sessions_type", ["wc", "wc1"])->get()->count();
        });

        $completeRev = $gym->pts->sum(function ($pt) {
            return Sessions::where("completed", true)->where('pt_id', $pt->id)->get()->sum(function ($session) {
                return $this->getCompletedPrice($session);
            });
            // return Sessions::where('pt_id', $pt->id)->where("completed", true)->get()->count();
        });

        $cancel = $gym->pts->sum(function ($pt) {
            return Sessions::onlyTrashed()->where('pt_id' , $pt->id)->where('cancel_reason', 'cancel')->get()->count();
        });

        $noshow = $gym->pts->sum(function ($pt) {
            return Sessions::onlyTrashed()->where('pt_id' , $pt->id)->where('cancel_reason', 'noshow')->get()->count();
        });

        // $cancel = Sessions::onlyTrashed()->where('pt_id' , $pt->id)->where('cancel_reason', 'cancel')->get()->count();
        // $noshow = Sessions::onlyTrashed()->where('pt_id' , $pt->id)->where('cancel_reason', 'noshow')->get()->count();

        $data = [
            "title" => $gym->name,
            "gym" => $gym,
            "stats" => [
                [
                    "statTitle" => "Total PTs",
                    "stat" => $gym->pts->count(),
                ],
                [
                    "statTitle" => "Total Members",
                    "stat" => $gym->members->count(),
                ],
                [
                    "statTitle" => "Cancelled Sessions",
                    "stat" => $cancel
                ],
                [
                    "statTitle" => "Session No Shows",
                    "stat" => $noshow
                ],
                [
                    "statTitle" => "Completed WC",
                    "stat" => $completeWC
                ],
                [
                    "statTitle" => "Completed Sessions",
                    "stat" => $complete
                ],

                // [
                //     "statTitle" => "Booked Sessions",
                //     "stat" => $booked,
                // ],
                [
                    "statTitle" => "Completed Revenue",
                    "stat" => $completeRev,
                    "currency" => true,
                ],
                [
                    "statTitle" => "Total Revenue",
                    "stat" => $rev,
                    "currency" => true,
                ],
            ],
        ];

        // dd($gym->packages());

        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $g = Gyms::create($input);

        return response()->json($g, 200);
    }
}
