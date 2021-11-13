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
        return $this->hasMany(BookModel::class, 'editorial_id');
    }
}
