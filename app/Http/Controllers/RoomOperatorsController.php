<?php

namespace App\Http\Controllers;

use App\Models\PermissionToUser;
use App\Models\Room;
use App\Models\RoomOperators;
use App\Models\User;
use Illuminate\Http\Request;

class RoomOperatorsController extends Controller
{

    /**
     * Ez olyan felület legyen mint a volhuban a beosztó meg az elerkezett az időn a termék választó amit csináltál.
     *  Tehát egyik oldalról akit át billentesz ember, lefut a fetch es beleteszi a DB-be 
     */
    /**
     * ez a kivalszto felulet a view lesz
     */
    
     public function selectOperator(int $room_id, Request $request)
     {
         $room = Room::findOrFail($room_id);
     
         $users = PermissionToUser::with('user') 
         ->where('user_id', 2)
         ->get()
         ->pluck('user');
         $addedUsersIds = RoomOperators::where('room_id', $room_id)->pluck('user_id')->toArray();
     
         $availableUsers = $users->whereNotIn('id', $addedUsersIds);
     
         $addedUsers = RoomOperators::where('room_id', $room_id)->with('user')->get();
     
         return view('operators.addoperator')
             ->with('users', $users)
             ->with('addedUsers', $addedUsers)
             ->with('availableUsers', $availableUsers)
             ->with('room_id', $room->id)
             ->with('room',$room); 
     }

     /*
     * Hozzáadja az operátort
     */
    public function addOperator(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $roomOperator = RoomOperators::create([
            'user_id' => $request->input('user_id'),
            'room_id' => $request->input('room_id'),
        ]);

        return response()->json(['success' => true, 'data' => $roomOperator]);
        
    }


    /**
     * Az adatbazisbol eltavlit egy operatort
     */
    public function removeOperator(Request $request)
    {
        $userId = $request->input('user_id');
        $roomId = $request->input('room_id');
    
        RoomOperators::where('user_id', $userId)->where('room_id', $roomId)->delete();
    
        return response()->json(['success' => true]);
    }
}
