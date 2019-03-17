<?php

namespace App\Http\Controllers\Api;

use Nahid\Talk\Facades\Talk;
use App\User;
use Illuminate\Http\Request;

class MessagingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('talk');
    }

    public function thread($thread){
        $thread = Talk::getConversationsById($thread);
        if ($thread) {
            return response()->json(['status'=>'success', 'data'=> $thread], 200);
       }
        return response()->json(['status'=>'error', 'data'=> "Thread retreval failed"], 200);
    }

    public function create(Request $request){
        $thread = Talk::sendMessageByUserId($request->user, $request->message);
        if ($thread) {
            return response()->json(['status'=>'success', 'data'=> $thread], 200);
       }
        return response()->json(['status'=>'error', 'data'=> "Thread creation failed"], 200);
    }

    public function send(Request $request){
        $msg = Talk::sendMessage($request->thread, $request->message);
        if ($msg) {
            return response()->json(['status'=>'success', 'data'=> $msg], 200);
       }
        return response()->json(['status'=>'error', 'data'=> "Message send failed"], 200);
    }

    public function inbox(){
        $inbox = Talk::getInbox();
        return response()->json($inbox);
    }
}
