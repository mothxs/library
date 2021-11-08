<?php

namespace Library\Models;

use Library\Models\BaseModel;

class AuthorModel extends BaseModel
{
    protected $table = 'authors';

    /**
     * Get the books for the blog post.
     */
    public function books()
    {
        return $this->belongsToMany(BookModel::class, 'author_book', 'author_id', 'book_id');
    }
}
