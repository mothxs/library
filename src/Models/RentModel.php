<?php

namespace Library\Models;

use Library\Models\BaseModel;

class RentModel extends BaseModel
{
    protected $table = 'rents';

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    /**
     * Get the book that owns the comment.
     */
    public function book()
    {
        return $this->belongsTo(BookModel::class, 'book_id');
    }
}
