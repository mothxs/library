<?php

namespace Library\Models;

use Library\Models\BaseModel;

class EditorialModel extends BaseModel
{
    protected $table = 'editorials';

    protected $fillable = [ 
        'name', 'country', 'foundation_date', 'website',
    ];

     /**
     * Get the books.
     */
    public function books()
    {
        return $this->belongsToMany(Books::class, 'editorial_book', 'editorial_id', 'book_id');
    }
}
