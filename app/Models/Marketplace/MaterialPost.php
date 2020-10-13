<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Model;

class MaterialPost extends Model
{
    protected $table = 'material_post';

    public function category()
    {
        $relation = $this->hasOne('App\Models\Marketplace\MaterialCategory' , 'mc_id', 'categoryId');
        #$relation->getQuery()->where('primary', '=', 1);
        return $relation;
    }
}
