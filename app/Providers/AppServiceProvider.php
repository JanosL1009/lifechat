<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::if('isAdmin', function () {
            // Ellenőrizzük, hogy van-e bejelentkezett felhasználó
            if (Auth::check()) {
                $id = Auth::id();
                // Lekérjük a bejelentkezett felhasználót és a permission_id-t
                $user = User::where('id',$id)->first();
                
                // Ellenőrizzük, hogy az admin jogosultság be van-e állítva
                return $user && $user->permission->permission_id === 1; // Feltételezve, hogy az admin az 1-es ID
            }
    
            return false;
        });


    }


 

}
