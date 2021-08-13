<?php

namespace App\Providers;

use App\Repositories\UserRepositories\UserRepository;
use App\Repositories\UserRepositories\UserRepositoryInterface;

use App\Repositories\AdminRepositories\AdminRepository;
use App\Repositories\AdminRepositories\AdminRepositoryInterface;

use App\Repositories\EventRepositories\EventRepository;
use App\Repositories\EventRepositories\EventRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);

        /* $models = array(
            'User',
            'Admin',

        );

        foreach ($models as $model) {
            $this->app->bind($model.''.RepositoryInterface, "{$model}Repository");
        }*/
    }
}
