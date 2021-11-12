<?php

namespace Library\Listeners;

use Library\Events\RentDeleted;
use Library\Persisters\BookPersister;
use Library\Providers\BookProvider;

class AddBookStock
{
    /**
     * The book provider
     * 
     * @var BookProvider
     */
    protected $bookProvider;

    /**
     * The book provider
     * 
     * @var BookPersister
     */
    protected $bookPersister;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        BookProvider $bookProvider,
        BookPersister $bookPersister
    ){
        $this->bookProvider = $bookProvider;
        $this->bookPersister = $bookPersister;
    }

    /**
     * Handle the event and updates de book stock.
     *
     * @param  RentDeleted  $event
     * @return void
     */
    public function handle(RentDeleted $event)
    {
        $rent = $event->rent;

        $book = $this->bookProvider->find($rent->book_id);

        if(empty($book)) {
            return null;
        }

        $this->bookPersister->update($book['id'], ['qty' => ($book['qty'] + $rent->qty)]);
    }
}
