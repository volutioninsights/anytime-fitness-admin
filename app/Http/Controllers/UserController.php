<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function password(Request $request){
        $user = Auth::user();
        if($request->isMethod("post")){
            $e = [];
            // Save
            $authed = Hash::check($request->currentPW, $user->password);
            if(!$authed){
                $e[] = "The current password you entered is incorrect";
            }

            $same = $request->newPW == $request->newPWConfirm;
            if(!$same){
                $e[] = "Your new password and the confirm must match";
            }

            if(count($e) > 0){
                return view('user.password')->with(["title" => "Change Password", "errors" => $e]);
            }else{
                $user->password = Hash::make($request->newPW);
                $user->force_pw_change = false;
                $user->save();
                return view('user.password')->with(["title" => "Change Password", "success" => true]);
            }
        }

        return view('user.password')->withTitle("Change Password");
    }
}
