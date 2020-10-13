<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'pro_area';

    public $timestamps = false;

    public function areawork()
    {
        return $this->hasMany('App\Models\Bussiness\AreaWork', 'aw_area_id', 'area_id');
    }
}
