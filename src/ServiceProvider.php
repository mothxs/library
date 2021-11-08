<?php

namespace Library;

use Library\Commands\CreateUser;
use Library\Contracts\RepositoryInterface;
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
        $this->bindInterfaces();
    }

    private function bindInterfaces()
    {
        $this->app->bind(RepositoryInterface::class, BaseEloquentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
    }
}
