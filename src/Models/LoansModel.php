<?php

namespace Library\Models;

use Library\Models\BaseModel;

class LoanModel extends BaseModel
{
    protected $table = 'loans';

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
