<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class ApiController extends Controller
{

    //lekerdezi az osszes elerheto szobat
    public function getRooms(Request $request)
    {
        $rooms = Room::where('status',1)->get(['id','name','picture','number_of_employees','describe','status']);

        return json_encode($rooms);
    }
}
