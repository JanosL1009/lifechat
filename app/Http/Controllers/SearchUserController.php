<?php

namespace App\Http\Controllers;

use App\Models\PermissionToUser;
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

        $sex = $this->GetSex($user);
        $age = $this->GetCurrentAge($user);
        $height = $user->height ?? "Nincs kitöltve";
        $weight = $user->weight ?? "Nincs kitöltve";
        $haircolor = $user->hairColor ?? "Nincs kitöltve";
        $eyecolor = $user->eyeColor ?? "Nincs kitöltve";
        $work = $user->work ?? "Nincs kitöltve";
        $pet = $user->pet ?? "Nincs kitöltve";
        $maritalstatus = $this->GetMaritalStatus($user);
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
       ->with('user',$user);
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

        try {
            if($user->save() && $permissions->save())
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
        return $user->is_vip ? 'Igen' : 'Nem';
    }

    public function GetMaritalStatus(User $user)
    {
        switch ($user->marital_status_id) {
            case 1:
                return 'Egyedülálló';
            case 2:
                return 'Házas';
            case 3:
                return 'Elvált';
            case 4:
                return 'Özvegy';
            default:
                return 'Ismeretlen';
        }
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
