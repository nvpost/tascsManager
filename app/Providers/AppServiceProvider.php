<?php

namespace App\Providers;

use App\Models\UserAdminRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('isSuperAdmin', function($user){
            $res = UserAdminRole::where([
                'admin_user_id' => $user->id,
                'role_id' => 1
            ])->exists();
            return $res;
        });

        Gate::define('isAdmin', function($user){
            $res = UserAdminRole::where([
                'admin_user_id' => $user->id,
                'role_id' => 4
            ])->exists();
            return $res;
        });

        Gate::define('canEdit', function($user, $item_id){
            $res = $user->id == $item_id;
            return $res;
        });
    }
}
