<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user){
            if ($user->level == 1){
                return true;
            }
        });


//        if (!$this->app->runningInConsole()){
//            foreach (Permission\Permission::select('key')->get() as $permission){
//                Gate::define($permission->key, function ($user) use ($permission){
//                    return  $user->hasFilePermission($permission->key, $user->id);
//                });
//            }
//        }
    }
}
