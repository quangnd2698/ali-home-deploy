<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-post', function ($user) {
        //     return true;
        // });

        Gate::define('isAdmin', function($user) {
            return $user->permission === 1;
        });

        Gate::define('isSale', function($user) {
            return $user->permission === 2;
        });

        Gate::define('isWarehouseStaff', function($user) {
            return $user->permission === 3;
        });
        
        Gate::define('isMarketing', function($user) {
            return $user->permission === 4;
        });

        Gate::define('isAdminOrSale', function($user) {
            return $user->permission === 1 || $user->permission === 2;
        });

        Gate::define('itMe', function($user, $auth) {
            return $user->id === $auth->id;
        });
    }
}
