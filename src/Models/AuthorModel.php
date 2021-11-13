<?php

namespace Library\Models;

use Library\Models\BaseModel;

class AuthorModel extends BaseModel
{
    protected $table = 'authors';

    protected $fillable = [
        'name', 'surname', 'country', 'language', 'birth_date'
    ];

    /**
     * Get the books.
     */
    public function books()
    {
        return $this->hasMany(BookModel::class, 'author_id');
    }
}
