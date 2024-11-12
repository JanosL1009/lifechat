<?php

namespace App\Http\Controllers;

use App\Models\BanMode;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLog;

class ChatController extends Controller
{
    public function index()
    {
        return view('Chat.index');
    }

    public function generalRoom(Request $request,$roomid)
    {
        $user = Auth::user();
        $userid = $user->id;
        $room = Room::find($roomid)??null;

        $userlog = new UserLog();
        $userlog->user_id = $userid;
        $userlog->ip_address = $request->ip();
        $userlog->save();

        if(is_null($room)) 
        {
            abort(404);
        }

        $banList = BanMode::all();

        return view('Chat.generalRoom')->with('room',$room)->with('banModes',$banList);
    }


    public function privateRoom(Request $request,$user_id)
    {

        

        $openerUser = Auth::user(); //a loginolt user mindiga megnyito, az elso alkalaommal, o kezdi a beszelgetest    
        $receiverUser = User::find($user_id); //akire ráírunk első alkalommal

        $roomName = null;



        $room = new Room();
        $room->name = 1;

        if(is_null($room)) 
        {
            abort(404);
        }


        return view('Chat.privateRoom')->with('room',$room);
    }
    
}
