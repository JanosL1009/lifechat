<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $friends = Friends::where('user_id', $user->id)
                      ->orWhere('friend_id', $user->id)
                      ->where('status', 1)  
                      ->paginate(20);

        $sentRequests = Friends::where('user_id', $user->id)
                            ->where('status', 'sent')  
                            ->paginate(20);

        $allFriendsAndRequests = $friends->merge($sentRequests)->unique('friend_id');

        return view('Friend.index')->with('allFriendsAndRequests', $allFriendsAndRequests)->with('friends',$friends)->with('sentRequests',$sentRequests);
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
            $request->pivot->status = 1; 
            $request->pivot->save();
        }
        return response()->json(['message' => 'Barátfelkérés elfogadva']);
    }
    
    public function rejectRequest($id)
    {
        $request = auth()->user()->receivedFriendRequests()->find($id);
    
        if ($request) {
            $request->pivot->delete();
    
            return response()->json(['message' => 'Barátfelkérés elutasítva és törölve']);
        }
    
        return response()->json(['message' => 'Barátfelkérés nem található']);
    }
    
    public function countRequests()
    {
        $count = auth()->user()->receivedFriendRequests()->where('status', 0)->count();
        return response()->json(['count' => $count]);
    }

    public function cancelFriendRequest($id)
    {
        $user = auth()->user();
        $friendRequest = Friends::where(function($query) use ($user, $id) {
            $query->where('user_id', $user->id)->where('friend_id', $id)
                ->orWhere('user_id', $id)->where('friend_id', $user->id);
        })->where('status', '0')->first();

        if ($friendRequest) {
            $friendRequest->delete();
            return response()->json(['success' => true, 'message' => 'Barátfelkérés visszavonva']);
        }

        return response()->json(['success' => false, 'message' => 'A barátfelkérés nem található']);
    }

    public function deleteFriend($id)
    {
        $friend = Friends::find($id);

        if (!$friend) {
            return response()->json(['success' => false, 'message' => 'A barát nem található!']);
        }

        if ($friend->status == 1 && ($friend->user_id == auth()->user()->id || $friend->friend_id == auth()->user()->id)) {
            $friend->delete();
            return response()->json(['success' => true, 'message' => 'A barát sikeresen törölve!']);
        }

        return response()->json(['success' => false, 'message' => 'Nem törölhető, mivel nem barát!']);
    }


public function cancelRequest($id)
{
    $friendRequest = Friends::find($id);

    if (!$friendRequest) {
        return response()->json(['success' => false, 'message' => 'A barátfelkérés nem található!']);
    }

    if ($friendRequest->status == 0 && ($friendRequest->user_id == auth()->user()->id || $friendRequest->friend_id == auth()->user()->id)) {
        $friendRequest->delete();
        return response()->json(['success' => true, 'message' => 'A barátfelkérés visszavonva!']);
    }

    return response()->json(['success' => false, 'message' => 'Nem törölhető, mivel a barátfelkérés már el lett fogadva vagy nem te küldted!']);
}
}
