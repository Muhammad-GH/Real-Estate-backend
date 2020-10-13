<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\PropertyImage;

class Property extends Model
{
    use SoftDeletes;
    protected $table = 'property';

    public function primaryImage()
    {
        $relation = $this->hasOne('App\Models\PropertyImage' , 'property_id', 'id');
        $relation->getQuery()->where('primary', '=', 1);
        return $relation;
    }

    public function propertyImage()
    {
        $relation = $this->hasMany('App\Models\PropertyImage' , 'property_id', 'id');
        $relation->getQuery()->where('primary', '=', 0);
        return $relation;
    }
}
