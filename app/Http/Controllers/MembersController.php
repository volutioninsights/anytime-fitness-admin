<?php

namespace App\Http\Controllers;

use App\User;
// use Illuminate\Http\Request;
// use Freshbitsweb\Laratables\Laratables;

class MembersController extends Controller {
    public function index()
    {
        return 'Be back soon!';
        // $data = [
        //     "title" => "All Members",
        //     "members" => User::where('type', "Client")->limit(100)->get()
        // ];

        // return view('member.list')->with($data);
    }

    // public function tableData(){
    //     return Laratables::recordsOf(User::class);
    // }
}