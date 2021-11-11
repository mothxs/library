<?php

namespace Library\Models;

use Library\Models\BaseModel;

class BookModel extends BaseModel
{
    protected $table = 'books';

    protected $fillable = [ 
        'title', 'isbn', 'pages', 'cover_types',
        'copyright', 'publishing_place', 'release_date', 'qty', 'photo'
    ];

    /**
     * Get the authors for the blog post.
     */
    public function authors()
    {
        return $this->belongsToMany(AuthorModel::class, 'author_book', 'book_id', 'author_id');
    }

    /**
     * Get the editorials for the blog post.
     */
    public function editorials()
    {
        return $this->belongsToMany(EditorialModel::class, 'editorial_book', 'book_id', 'editorial_id');
    }

    /**
     * Get the categories for the blog post.
     */
    public function categories()
    {
        return $this->belongsToMany(CategoryModel::class, 'category_book', 'book_id', 'category_id');
    }

    /**
     * Get the rents for the blog post.
     */
    public function rents()
    {
        return $this->hasMany(RentModel::class, 'book_id');
    }
}
