<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table = 'pro_agreement';
    
    public function prouser()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'agreement_client_id');
    }

}
