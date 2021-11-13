<?php

namespace Library\Models;

use Library\Events\RentCreated;
use Library\Events\RentDeleted;
use Library\Models\BaseModel;

class RentModel extends BaseModel
{
    protected $table = 'rents';

    protected $fillable = [
        'book_id', 'partner_id', 'start_date', 'end_date', 'qty', 'times_extended',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($model) {
            event(new RentCreated($model));
        });

        static::deleted(function ($model) {
            event(new RentDeleted($model));
        });
    }

    /**
     * Get the rented book.
     */
    public function book()
    {
        return $this->belongsTo(BookModel::class, 'book_id');
    }

    /**
     * Get the partner who rented the book.
     */
    public function partner()
    {
        return $this->belongsTo(PartnerModel::class, 'partner_id');
    }
}
