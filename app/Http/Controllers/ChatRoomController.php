<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\ChatsInTheRoom;
use Exception;
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
        return view('ChatRooms.createAnNewRoom');
    }   


    /**
     * Method: POST
     * Az elozo fuggvenyhez kapcsolodik. Menti az az uj szobat, majd vissza iranyit es kiirja hogy sikeres lett vagy nem a szoba letrehozassa.
     * 
     * @return redirect back
     */
    public function CreateNewRoom(Request $request)
    {
        $newroom = new Room();

        $newroom->name = $request->roomname;
        if ($request->hasFile('roompictures')) {
            $originalFileName = $request->file('roompictures')->getClientOriginalName();
            $request->file('roompictures')->move(public_path('roompictures'), $originalFileName);
            $newroom->picture =  $originalFileName;
        }

        if ($request->hasFile('chatpictures')) {
            $originalFileName = $request->file('chatpictures')->getClientOriginalName();
            $request->file('chatpictures')->move(public_path('chatpictures'), $originalFileName);
            $newroom->chatpicture =  $originalFileName;
        }

        $newroom->number_of_employees = $request->nmbofempl;
        $newroom->describe = $request->describe;
        $newroom->status = $request->input('status');

        try {
            if($newroom->save())
            {
                return redirect()->route('admin.roomlist')->with('success','A szoba létrehozása sikeresen megtörtént!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.roomlist')->with('failed','A szoba létrehozása sikertelen!');
        }
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
        $room = Room::find($room_id);
        // dd($room);
        return view('ChatRooms.updatteAnRoom')->with('room',$room);
    }


     /**
     * Method: POST
     * Egy szoba adatait modositja. Update része.
     * 
     * @return redirect back
     */
    public function UpdateRoom($id, Request $request)
    {
        $updateroom = Room::find($id);

        $updateroom->name = $request->input('roomname');

        if ($request->hasFile('roompictures')) {
            $originalFileName = $request->file('roompictures')->getClientOriginalName();
            $request->file('roompictures')->move(public_path('roompictures'), $originalFileName);
            $updateroom->picture = $originalFileName;
        }

        if ($request->hasFile('chatpictures')) {
            $originalFileName = $request->file('chatpictures')->getClientOriginalName();
            $request->file('chatpictures')->move(public_path('chatpictures'), $originalFileName);
            $updateroom->chatpicture =  $originalFileName;
        }

        $updateroom->number_of_employees = $request->input('nmbofempl');
        $updateroom->describe = $request->input('describe');
        $updateroom->status = $request->input('status');

        try {
            if ($updateroom->save()) {
                return redirect()->route('admin.roomlist')->with('success','A szoba módosítása sikeresen megtörtént!');
            }
        } catch (Exception $error) {
            return redirect()->route('admin.roomlist')->with('failed','A szoba módosítása sikertelen!');
        }
    }


    /** 
    *Ki fogja listázni az adminoknak a szobákat
    */
    public function adminRoomList()
    {
        $rooms = Room::paginate(10);

        return view('ChatRooms.roomListForAdmins')->with('rooms',$rooms);
    }

    /** 
    *Ki fogja listázni a usereknek a szobákat
    */
    public function getRoomList()
    {
        $rooms = Room::paginate(10);
        return view('ChatRooms.roomList')->with('rooms',$rooms);
    }

}
