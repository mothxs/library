<?php

namespace Library\Models;

use Library\Models\BaseModel;

class PartnerModel extends BaseModel
{
    protected $table = 'partners';

    protected $fillable = [ 
        'name', 'surname', 'id_card', 'age', 'address',
    ];
}
