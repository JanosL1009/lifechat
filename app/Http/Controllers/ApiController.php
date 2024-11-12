<?php

namespace App\Http\Controllers;

use App\Models\Radio;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoomEntered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{

    //lekerdezi az osszes elerheto szobat
    public function getRooms(Request $request)
    {
        $user_id = Auth::id();
        $enteredRooms = UserRoomEntered::where('user_id',$user_id)->get(['room_id'])->toArray();

        $rooms = Room::whereIn('id',$enteredRooms)->where('status',1)->get(['id','name','picture','number_of_employees','describe','status']);

        return json_encode($rooms);
    }

    public function getRoomData(Request $request)
    {
        $roomID = $request->input('room_id');
        $rooms = Room::where('status',1)->where('id',$roomID)->first(['id','name','picture','number_of_employees','describe']);

        return json_encode($rooms);
    }

    public function getRoomUsers(Request $request)
    {
        $room_id = $request->input('room_id');

        $userList =  UserRoomEntered::where('room_id',$room_id)->get(['user_id'])->toArray();

        $users = User::whereIn('id',$userList)->get(["id","username","profilepicture"]);
        $users = DB::table('users')
        ->leftJoin('room_operators', 'users.id', '=', 'room_operators.user_id')
        ->leftJoin('permission_to_users', 'users.id', '=', 'permission_to_users.user_id')
        ->whereIn('users.id', $userList)
        ->select('users.id', 'users.username', 'users.profilepicture', 'room_operators.room_id as op_room_id','permission_to_users.permission_id as p_id')
        ->get();
        
        return json_encode($users);

    }

    public function getRadioList(Request $request)
    {
        $radios = Radio::where('radioStatus', 1)->get();

        return json_encode($radios);
    }
}
