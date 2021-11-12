<?php

namespace Library;

use Library\Events\RentCreated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Library\Events\RentDeleted;
use Library\Listeners\AddBookStock;
use Library\Listeners\DiscountBookStock;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RentCreated::class => [
            DiscountBookStock::class,
        ],
        RentDeleted::class => [
            AddBookStock::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
