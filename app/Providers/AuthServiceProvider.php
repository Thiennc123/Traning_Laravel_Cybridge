<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show_listUser', 'App\Policies\UserPolicy@view');
        Gate::define('add_User', 'App\Policies\UserPolicy@restore');
        Gate::define('edit_User', 'App\Policies\UserPolicy@create');
        Gate::define('remove_User', 'App\Policies\UserPolicy@delete');
    }
}
