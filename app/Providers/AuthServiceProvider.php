<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Laravel\Passport\Passport;
use App\Policies\EventPolicy;
use App\Policies\AdminPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Admin::class => UserPolicy::class,
        Admin::class => AdminPolicy::class,
        Admin::class => EventPolicy::class,
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

        Gate::define('show_listAdmin', 'App\Policies\AdminPolicy@view');
        Gate::define('add_Admin', 'App\Policies\AdminPolicy@restore');
        Gate::define('edit_Admin', 'App\Policies\AdminPolicy@create');
        Gate::define('remove_Admin', 'App\Policies\AdminPolicy@delete');

        Gate::define('show_listEvent', 'App\Policies\EventPolicy@view');
        Gate::define('add_Event', 'App\Policies\EventPolicy@restore');
        Gate::define('edit_Event', 'App\Policies\EventPolicy@create');
        Gate::define('remove_Event', 'App\Policies\EventPolicy@delete');


        Passport::routes();

        Passport::tokensCan([
            'user' => 'User Type',
            'admin' => 'Admin User Type',
        ]);
    }
}