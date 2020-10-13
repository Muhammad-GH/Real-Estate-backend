<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Investpropertyimage;

class InvestProperty extends Model
{
    use SoftDeletes;
    protected $table = 'invest_property';

    public function investmentImage()
    {
        return $this->hasMany('App\Models\Investpropertyimage' , 'invest_property_id', 'id');
    }

}
