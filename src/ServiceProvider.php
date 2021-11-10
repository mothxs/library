<?php

namespace Library;

use Library\Commands\CreateUser;
use Library\Contracts\BaseRepositoryInterface;
use Library\Contracts\BookRepositoryInterface;
use Library\Contracts\RentRepositoryInterface;
use Library\Contracts\UserRepositoryInterface;
use Library\Contracts\AuthorRepositoryInterface;
use Library\Repositories\BaseEloquentRepository;
use Library\Repositories\BookEloquentRepository;
use Library\Repositories\RentEloquentRepository;
use Library\Repositories\UserEloquentRepository;
use Library\Contracts\CategoryRepositoryInterface;
use Library\Repositories\AuthorEloquentRepository;
use Library\Contracts\EditorialRepositoryInterface;
use Library\Repositories\CategoryEloquentRepository;
use Library\Repositories\EditorialEloquentRepository;
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
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'library');
        $this->publishes([__DIR__.'/resources/css/login.css' => public_path('css/login.css')], 'public');
        $this->publishes([
            __DIR__.'/resources/css/library.css' => resource_path('css/library.css'),
            __DIR__.'/resources/components' => resource_path('components'),
        ], 'resource');
        $this->publishes([__DIR__.'/resources/img' => public_path('img')], 'public');
        $this->bindInterfaces();
    }

    private function bindInterfaces()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseEloquentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookEloquentRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, AuthorEloquentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryEloquentRepository::class);
        $this->app->bind(EditorialRepositoryInterface::class, EditorialEloquentRepository::class);
        $this->app->bind(RentRepositoryInterface::class, RentEloquentRepository::class);
    }
}
