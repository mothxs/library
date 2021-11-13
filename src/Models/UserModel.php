<?php

namespace Library\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class UserModel extends User
{
    use SoftDeletes;
    
    protected $table = 'users';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:Y-m-d h:m:s',
        'deleted_at' => 'datetime:Y-m-d h:m:s',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if(isset($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });
    }

    /**
     * Get the rents for the blog post.
     */
    public function rents()
    {
        return $this->hasMany(RentModel::class, 'user_id');
    }
}
