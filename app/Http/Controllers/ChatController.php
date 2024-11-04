<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        return view('Chat.index');
    }

    public function generalRoom(Request $request,$roomid)
    {
        $room = Room::find($roomid)??null;

        if(is_null($room)) 
        {
            abort(404);
        }


        return view('Chat.generalRoom')->with('room',$room);
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
