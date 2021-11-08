<?php

namespace Library\Models;

use Library\Models\BaseModel;

class CategoryModel extends BaseModel
{
    protected $table = 'categories';

    /**
     * Get the books for the blog post.
     */
    public function books()
    {
        return $this->belongsToMany(BookModel::class, 'category_book', 'category_id', 'book_id');
    }
}
