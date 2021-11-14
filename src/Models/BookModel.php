<?php

namespace Library\Models;

use Library\Models\BaseModel;

class BookModel extends BaseModel
{
    protected $table = 'books';

    protected $fillable = [ 
        'title', 'isbn', 'pages', 'cover_type', 'category', 'author_id', 'editorial_id',
        'copyright', 'publishing_place', 'release_date', 'qty', 'image'
    ];

    /**
     * Get the authors.
     */
    public function author()
    {
        return $this->belongsTo(AuthorModel::class, 'author_id');
    }

    /**
     * Get the editorials.
     */
    public function editorial()
    {
        return $this->belongsTo(EditorialModel::class, 'editorial_id');
    }
    
    /**
     * Get the rents.
     */
    public function rents()
    {
        return $this->hasMany(RentModel::class, 'book_id');
    }
}
