<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Model;

class FavouriteTender extends Model
{
    protected $table = 'pro_users_favourite_tender';
    public function tenders()
    {
        return $this->hasMany('App\Models\Marketplace\ProTender', 'tender_user_id', 'uft_tender_id');
    }
}
