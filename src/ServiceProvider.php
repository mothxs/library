<?php

namespace Library;

use Library\Contracts\RepositoryInterface;
use Library\Repositories\BaseEloquentRepository;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Library\Contracts\UserRepositoryInterface;
use Library\Repositories\UserEloquentRepository;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        parent::register();
        
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
