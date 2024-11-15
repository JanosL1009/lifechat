<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Ellenőrizd, hogy a felhasználó be van-e jelentkezve
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::check()) {
            $id = Auth::id();
            // Lekérjük a bejelentkezett felhasználót és a permission_id-t
            $user = User::where('id',$id)->first();
            
            // Ellenőrizzük, hogy az admin jogosultság be van-e állítva
            if( $user && $user->permission->permission_id === 1) // Feltételezve, hogy az admin az 1-es ID
            {
                abort(403, 'Nincs megfelelő jogosultságod a hozzáféréshez.');
            }
        }

        return $next($request);
    }
}
