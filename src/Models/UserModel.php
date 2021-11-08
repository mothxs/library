<?php

namespace Library\Models;

use App\Models\User;

class UserModel extends User
{
    protected $table = 'users';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:Y-m-d h:m:s',
        'deleted_at' => 'datetime:Y-m-d h:m:s',
    ];

    /**
     * Get the loans for the blog post.
     */
    public function loans()
    {
        return $this->hasMany(LoanModel::class, 'user_id');
    }
}
