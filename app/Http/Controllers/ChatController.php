<?php

namespace App\Http\Controllers;

use App\Models\BanMode;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserBan;
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
    
    public function upload(Request $request)
    {
        // if ($request->hasFile('upload')) {
        //     // Ellenőrizzük, hogy valóban van fájl
        //     $file = $request->file('upload');
            
        //     // A fájl neve, itt az időbélyeggel történik az egyediség biztosítása
        //     $filename = time() . '_' . $file->getClientOriginalName();
    
        //     // A fájl tárolása a `public/ckeditorimg` mappába
        //     $filePath = $file->move(public_path('ckeditorimg'), $filename);
    
        //     // A fájl elérési útja
        //     $url = asset('ckeditorimg/' . $filename);
    
        //     // JSON válasz a képpel
        //     return response()->json([
        //         'url' => $url,
        //     ]);
        // }
    
        // return response()->json(['error' => 'Kép feltöltése sikertelen.'], 400);

     
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image = $request->file('upload');
        $imagePath = $image->store('images', 'public');

        return response()->json(['url' => asset('storage/' . $imagePath)]);
    
    
    }

    public function BannedList()
    {
        $banlist = UserBan::with('user')->with('room')->with('banmode')->paginate(20);
        

        return view('banlist')->with('banlist',$banlist);
    }

    public function UnBan_Post(Request $request)
    {

        $request->validate([
            'banid' => 'required|integer|exists:user_bans,id', 
        ]);

        try {
            $banid = $request->input('banid');
            $res = UserBan::where('id', $banid)->delete();

            if ($res) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Nem sikerült törölni a rádiót.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Hiba lépett fel a kérés közben.'], 500);
        }
    }
}
