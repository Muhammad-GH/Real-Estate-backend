<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Model;

class ProTender extends Model
{
    protected $table = 'pro_tender';

    public function category()
    {
        $relation = $this->hasOne('App\Models\Marketplace\MaterialCategory' , 'mc_id', 'tender_category_id');
        #$relation->getQuery()->where('primary', '=', 1);
        return $relation;
    }    
    public function roles()
    {
        return auth()->user()->roles_label;
    }
}
