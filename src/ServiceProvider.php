<?php

namespace Library;

use Library\Commands\CreateUser;
use Library\Contracts\BaseRepositoryInterface;
use Library\Contracts\UserRepositoryInterface;
use Library\Repositories\BaseEloquentRepository;
use Library\Repositories\UserEloquentRepository;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected $commands = [
        CreateUser::class
    ];

    public function register()
    {
        parent::register();
        
        $this->commands($this->commands);
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'library');
        $this->publishes([__DIR__.'/resources/css' => public_path('css')], 'public');
        $this->publishes([__DIR__.'/resources/img' => public_path('img')], 'public');
        $this->bindInterfaces();
    }

    private function bindInterfaces()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseEloquentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
    }
}
