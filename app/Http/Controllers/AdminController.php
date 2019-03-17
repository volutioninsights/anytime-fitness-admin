<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $roles = [
        0 => "Member",
        // 1 => "Trainer",
        // 2 => "Manager",
        // 3 => "Gym Owner",
        // 4 => "Head Office",
        1 => "Admin"
    ];

    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard')->withTitle("Admin Dashboard");
    }

    public function edit(User $user)
    {
        $data = [
            "title" => $user->name,
            "user" => $user,
            "roles" => $this->roles
        ];
        return view('admin.users.edit')->with($data);
    }

    public function update(Request $request, User $user){
        $user->update($request->only('name', 'email'));
        $user->admin = $request->role === "1" ? true : false;

        if($request->filled("password")){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return $this->edit($user);
    }

    public function users()
    {
        $data = [
            "title" => "User Management",
            "users" => User::all(),
        ];
        // dd($data);
        return view('admin.users.list')->with($data);

    }
}
