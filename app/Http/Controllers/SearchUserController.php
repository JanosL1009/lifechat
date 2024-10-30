<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchUserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $users = collect(); 

        if ($query) {
            $users = User::where('email', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->get();
        
        }
        return view('szemely_kereses', compact('users'));
    }
    
}
