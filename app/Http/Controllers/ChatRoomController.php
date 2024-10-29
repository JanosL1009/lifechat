<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\ChatsInTheRoom;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function getRoomMessages($roomId)
    {

        $messages = ChatsInTheRoom::where('room_id', $roomId)->with('user')->get();
         return response()->json($messages);
    }

    public function setRoomMessage(Request $request)
    {
        $roomID = $request->input('room_id');
        $roomMsg = $request->input('msg');
        $user_id = Auth::id();
     
        $newMessageForTheRoom = new ChatsInTheRoom();
        $newMessageForTheRoom->room_id = $roomID;
        $newMessageForTheRoom->user_id = $user_id;
        $newMessageForTheRoom->message = $roomMsg??"s";

        try 
        {
            if($newMessageForTheRoom->save()) 
            {
                return response()->json(['status' => 1]);
            }
        }
        catch(\Exception $e) 
        {
            return response()->json(['status' => 2, "error" => $e->getMessage()]);
        }
         
    }

}
