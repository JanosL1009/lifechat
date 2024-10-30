<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

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

    
}
