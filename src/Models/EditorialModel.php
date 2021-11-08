<?php

namespace Library\Models;

use Library\Models\BaseModel;

class EditorialModel extends BaseModel
{
    protected $table = 'editorials';

     /**
     * Get the books for the blog post.
     */
    public function books()
    {
        return $this->belongsToMany(Books::class, 'editorial_book', 'editorial_id', 'book_id');
    }
}
