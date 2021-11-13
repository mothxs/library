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
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($author) {
            if(count($author->books) > 0) {
                return false;
            }
        });
    }

    /**
     * Get the books.
     */
    public function books()
    {
        return $this->hasMany(BookModel::class, 'author_id');
    }
}
