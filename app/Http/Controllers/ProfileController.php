<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionToUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userid = $user->id;

        $permissions = DB::table('permission_to_users')
        ->where('user_id',$userid)
        ->first();

        $sex = $this->GetSex();
        $age = $this->GetCurrentAge();
        $height = $user->height ?? "Nincs kitöltve";
        $weight = $user->weight ?? "Nincs kitöltve";
        $haircolor = $user->hairColor ?? "Nincs kitöltve";
        $eyecolor = $user->eyeColor ?? "Nincs kitöltve";
        $work = $user->work ?? "Nincs kitöltve";
        $pet = $user->pet ?? "Nincs kitöltve";
        $maritalstatus = $this->GetMaritalStatus();
        $vip = $this->GetVip();
        $lastlogin = $user->lastlogin ?? "Ismeretlen";
        $registered = $user->created_at ?? "Ismeretlen";
        $szuletesiido = $user->birthdate ?? "Ismeretlen";
        $jogosultsag = $this->GetPermission();

        $defaultImage = asset('img/avatar-3.jpg');

        $profileImage = $user->profilepicture ? asset('storage/profilepictures/' . $user->profilepicture) : $defaultImage;

        return view('profil.index')->with('user',$user)->with('sex',$sex)->with('age',$age)->with('height',$height)
       ->with('weight',$weight)->with('haircolor',$haircolor)->with('eyecolor',$eyecolor)->with('work',$work)
       ->with('pet',$pet)->with('maritalstatus',$maritalstatus)->with('vip',$vip)->with('lastlogin',$lastlogin)
       ->with('registered',$registered)->with('szuletesiido',$szuletesiido)
       ->with('permissions',$permissions)->with('jogosultsag',$jogosultsag)
       ->with('profileImage',$profileImage);
    }

    public function EditProfile(Request $request, $id)
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
        try {
            if($user->save())
            {
                return redirect()->route('user.profile', $id)->with('success', 'Profil sikeresen frissítve.');
            }
        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Hiba történt a profil mentésekor.');
        }
    }

    // public function EditProfileAdmin(Request $request, $id)
    // {
    
    //     $user = User::findOrFail($id);
    //     // dd($user);
        
    //     $user->username = $request->input('username');
    //     $user->email = $request->input('email');
    //     $user->sex = $request->input('sex');
    //     $user->birthdate = $request->input('birthdate');
    //     $user->marital_status_id = $request->input('marital_status');
    //     $user->height = $request->input('height');
    //     $user->weight = $request->input('weight');
    //     $user->hairColor = $request->input('haircolor'); 
    //     $user->eyeColor = $request->input('eyecolor'); 
    //     $user->work = $request->input('work');
    //     $user->pet = $request->input('pet');
        
    //     $permissions = PermissionToUser::find($id);
    //     $permissions->permission_id = $request->input('permission');

    //     try {
    //         if($user->save() && $permissions->save())
    //         {
    //             return redirect()->route('user.profile', $id)->with('success', 'Profil sikeresen frissítve.');
    //         }
    //     } catch (Exception $error) {
    //         return redirect()->back()->with('error', 'Hiba történt a profil mentésekor.');
    //     }
    // }
    

    public function GetPermission()
    {
        $userid = Auth::user()->id; 

        $permissions = DB::table('permission_to_users')
        ->where('user_id',$userid)
        ->first();
        switch ($permissions->permission_id) {
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
    

    public function GetVip()
    {
        $user = Auth::user();
        switch($user->is_vip) 
        {
            case 1:
                return 'Igen';
            case 2:
                return 'Nem';
            default:
                return 'Nem';
        }
    }

    public function GetMaritalStatus()
    {
        $user = Auth::user();

        switch($user->marital_status_id)
        {
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

    public function GetSex()
    {
        $user = Auth::user();
        
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
    
    
        return null;
    }
    public function GetCurrentAge()
    {
        $user = Auth::user();

        if ($user->birthdate) {
            $birthdate = Carbon::parse($user->birthdate);
            return $birthdate->age; 
        }

        return null; 
    }
}
