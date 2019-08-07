<?php

namespace App\Providers;

use App\Models\Permission\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::before(function ($user) {
            if ($user->level == 1) {
                return true;
            }
        });

        if (!$this->app->runningInConsole()) {
            $permissions = Permission::select('key')->get();
            foreach ($permissions as $permission) {
                Gate::define($permission->key, function ($user) use ($permission) {
                    return $user->hasFilePermission($permission->key, $user->id);
                });
            }
        }
    }
}
