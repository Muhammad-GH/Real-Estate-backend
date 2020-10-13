<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Auth\User;
use App\Models\InvestProperty;

class UserInvest extends Model
{
    // use SoftDeletes;
    protected $table = 'user_invest';

    public function investmentProperty()
    {
        return $this->hasOne('App\Models\InvestProperty' , 'id', 'invest_property_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Auth\User' , 'id', 'user_id');
    }
    public function userDetails()
    {
        return $this->hasOne('App\Models\Auth\UserDetail' , 'user_id', 'user_id');
    }

}
