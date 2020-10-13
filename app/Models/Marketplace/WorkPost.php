<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Model;

class WorkPost extends Model
{

    public $table = "work_post";

    public function category()
    {
        $relation = $this->hasOne('App\Models\Marketplace\WorkCategories' , 'wc_id', 'categoryId');
        #$relation->getQuery()->where('primary', '=', 1);
        return $relation;
    }
}