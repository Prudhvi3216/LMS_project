<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        //Admin Gate
        Gate::define('isAdmin', function($user){
          foreach ($user->roles as $role) {
            if($role->name == 'admin'){
              return true;
            }
          }
        });

        //Instructor Gate
        Gate::define('isInstructor', function($user){
          foreach ($user->roles as $role) {
            if($role->name == 'instructor'){
              return true;
            }
          }
        });

        //Student Gate
        Gate::define('isStudent', function($user){
          foreach ($user->roles as $role) {
            if($role->name == 'student'){
              return true;
            }
          }
        });

        //Admin or Instructor Gate
        Gate::define('Admin_or_Inst', function($user){
          foreach ($user->roles as $role) {
            if($role->name == 'instructor' || $role->name == 'admin'){
              return true;
            }
          }
        });
    }
}
