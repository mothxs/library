<?php

namespace Library\Models;

use Library\Models\BaseModel;

class PartnerModel extends BaseModel
{
    protected $table = 'partners';

    protected $fillable = [ 
        'name', 'surname', 'id_card', 'birth_date', 'address',
    ];

    /**
     * Get the rents.
     */
    public function rents()
    {
        return $this->hasMany(RentModel::class, 'partner_id');
    }
}
