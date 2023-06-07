<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        /* define a admin role */
          Gate::define('isAdmin',function($user){
            return $user->hasRole('admin');
        });
      
        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->hasRole('user');
        });

        /* define a manager role */
        Gate::define('isManager',function($user){
            return $user->hasRole('manager');
        });

        /* define a admin | user role */
        Gate::define('isAllowAdminUser', function($user) {
            return $user->hasAnyRoles(['admin' , 'user']);
        });

         /* define a admin | manager role */
        Gate::define('isAllowAdminManager', function($user) {
            return $user->hasAnyRoles(['admin' , 'manager']);
        });

         /* define a admin | user | manager role */
        Gate::define('isAllowUserAdminManager', function($user) {
            return $user->hasAnyRoles(['admin' , 'user' , 'manager']);
        });

    }
}
