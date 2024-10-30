<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\PermissionToUser;
use App\Models\Tag;
use App\Models\TagToUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('szemely_kereses')->with('users',$users);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $permissions = DB::table('permission_to_users')
            ->where('user_id', $id)
            ->first();


        $maritalStatuses = MaritalStatus::all(); 
        $maritalstatus = $user->marital_status_id ? MaritalStatus::find($user->marital_status_id) : null;

        $tags = Tag::all();

        $tagToUser = DB::table('tag_to_users')->where('user_id', $id)->first();
        $selectedTagId = $tagToUser ? $tagToUser->tag_id : null; 


        $sex = $this->GetSex($user);
        $age = $this->GetCurrentAge($user);
        $height = $user->height ?? "Nincs kitöltve";
        $weight = $user->weight ?? "Nincs kitöltve";
        $haircolor = $user->hairColor ?? "Nincs kitöltve";
        $eyecolor = $user->eyeColor ?? "Nincs kitöltve";
        $work = $user->work ?? "Nincs kitöltve";
        $pet = $user->pet ?? "Nincs kitöltve";
        $vip = $this->GetVip($user);
        $lastlogin = $user->lastlogin ?? "Ismeretlen";
        $registered = $user->created_at ?? "Ismeretlen";
        $szuletesiido = $user->birthdate ?? "Ismeretlen";
        $jogosultsag = $this->GetPermission($user);

      
        return view('szemely_szerkesztes')->with('user',$user)->with('sex',$sex)->with('age',$age)->with('height',$height)
       ->with('weight',$weight)->with('haircolor',$haircolor)->with('eyecolor',$eyecolor)->with('work',$work)
       ->with('pet',$pet)->with('maritalstatus',$maritalstatus)->with('vip',$vip)->with('lastlogin',$lastlogin)
       ->with('registered',$registered)->with('szuletesiido',$szuletesiido)
       ->with('permissions',$permissions)->with('jogosultsag',$jogosultsag)
       ->with('user',$user)->with('maritalStatuses',$maritalStatuses)
       ->with('selectedTagId',$selectedTagId)->with('tags',$tags);
    }

    public function EditProfile_Post(Request $request, $id)
    {
    
        $user = User::findOrFail($id);

       
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->sex = $request->input('sex');
        $user->birthdate = $request->input('birthdate');
        $user->marital_status_id = $request->input('marital_status');
        $user->height = $request->input('height'); 
        $user->weight = $request->input('weight'); 
        $user->hairColor = $request->input('haircolor'); 
        $user->eyeColor = $request->input('eyecolor'); 
        $user->work = $request->input('work');
        $user->pet = $request->input('pet');
        $user->is_vip = $request->input('vip');

        if ($request->hasFile('profilepicture')) {
            $originalFileName = $request->file('profilepicture')->getClientOriginalName();
            $request->file('profilepicture')->move(public_path('profilepicture'), $originalFileName);
            $user->profilepicture = $originalFileName;
        }
        $permissions = PermissionToUser::where('user_id', $id)->first();

        if (!$permissions) {
            $permissions = new PermissionToUser();
            $permissions->user_id = $id;
        }

        $permissions->permission_id = $request->input('permission');

        $tagToUser = TagToUser::where('user_id', $id)->first();
        if (!$tagToUser) {
            $tagToUser = new TagToUser();
            $tagToUser->user_id = $id; 
        }
    
        $tagToUser->tag_id = $request->input('tag_id');
        $tagToUser->id = $id;

        try {
            if($user->save() && $permissions->save() && $tagToUser->save() )
            {
                return redirect()->route('user.profile', $id)->with('success', 'Profil sikeresen frissítve.');
            }
        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Hiba történt a profil mentésekor.');
        }
    }

    public function GetPermission(User $user)
    {
        $permissions = DB::table('permission_to_users')
            ->where('user_id', $user->id)
            ->first();

        switch ($permissions->permission_id ?? null) {
            case 1:
                return 'Adminisztrátor';
            case 2:
                return 'Operátor';
            case 3:
                return 'Felhasználó';
            default:
                return 'Ismeretlen felhasználói szint!';
        }
    }

    public function GetVip(User $user)
    {
        return $user->is_vip == 1 ? 'Igen' : 'Nem';
    }
    
    public function GetSex(User $user)
    {
        switch ($user->sex) {
            case 1:
                return 'Férfi';
            case 2:
                return 'Nő';
            case 3:
                return 'Egyéb';
            default:
                return 'Ismeretlen';
        }
    }

    public function GetCurrentAge(User $user)
    {
        if ($user->birthdate) {
            $birthdate = Carbon::parse($user->birthdate);
            return $birthdate->age;
        }

        return null;
    }
    
}
