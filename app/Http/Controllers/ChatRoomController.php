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


    /**
     * kidolgozni hogy betoltson az uj szoba, amit aaz admin tetszolegesen letrehozhat. 
     * 
     * @return view
     */
    public function NewRoom(Request $request)
    {

    }


    /**
     * Method: POST
     * Az elozo fuggvenyhez kapcsolodik. Menti az az uj szobat, majd vissza iranyit es kiirja hogy sikeres lett vagy nem a szoba letrehozassa.
     * 
     * @return redirect back
     */
    public function CreateNewRoom(Request $request)
    {

    }

    /**
     * kidolgozni hogy betoltson az uj szoba, amit aaz admin tetszolegesen letrehozhat. 
     * igazabol ugyan az minta letrehozas, az a view kell, csak ugye ez a szerkesztés része és ehez tartozik majda következő metodus
     * 
     * @param int $room_id a szoba amit modositani fog
     * 
     * @return view
     */
    public function GetUpdateRoom(Request $request,$room_id)
    {

    }


     /**
     * Method: POST
     * Egy szoba adatait modositja. Update része.
     * 
     * @return redirect back
     */
    public function UpdateRoom(Request $request)
    {

    }


    /** 
    *Ki fogja listázni az adminoknak a szobákat
    */
    public function adminRoomList()
    {

    }

    /** 
    *Ki fogja listázni a usereknek a szobákat
    */
    public function getRoomList()
    {

    }

}
