<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        return view('Friend.index');
    }
    
    public function sendRequest(Request $request)
    {
        $request->validate([
            'friend_identifier' => 'required|string',
        ]);

        $friend = User::where('username', $request->friend_identifier)
                    ->orWhere('email', $request->friend_identifier)
                    ->first();

        if (!$friend) {
            return response()->json(['success' => false, 'message' => 'Felhasználó nem található.'], 404);
        }

        if (auth()->user()->id === $friend->id) {
            return response()->json(['success' => false, 'message' => 'Nem veheted fel magadat barátnak.'], 400);
        }

        auth()->user()->sendFriendRequest($friend);

        return response()->json(['success' => true, 'message' => 'Barát kérés elküldve!']);
    }

    public function incomingRequests()
    {
        $requests = auth()->user()->receivedFriendRequests()->where('status', 0)->get();
        return response()->json(['requests' => $requests]);
    }
    
    public function acceptRequest($id)
    {
        $request = auth()->user()->receivedFriendRequests()->find($id);
        if ($request) {
            $request->pivot->status = 1; // Elfogadva (1)
            $request->pivot->save();
        }
        return response()->json(['message' => 'Barátfelkérés elfogadva']);
    }
    
    public function rejectRequest($id)
    {
        $request = auth()->user()->receivedFriendRequests()->find($id);
        if ($request) {
            $request->pivot->status = 2; // Elutasítva (2)
            $request->pivot->save();
        }
        return response()->json(['message' => 'Barátfelkérés elutasítva']);
    }
    public function countRequests()
    {
        $count = auth()->user()->receivedFriendRequests()->where('status', 0)->count();
        return response()->json(['count' => $count]);
    }

    public function search(Request $request)
{
    $identifier = $request->query('identifier');
    $user = User::where('email', $identifier)->orWhere('username', $identifier)->first();

    if ($user) {
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_picture' => $user->profile_picture, // feltételezve, hogy van ilyen mező
            ],
        ]);
    } else {
        return response()->json(['success' => false, 'message' => 'Felhasználó nem található.']);
    }
}


}
