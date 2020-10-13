<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProUserDetail.
 */
class ProUserDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_user_detail';


    protected $fillable = array('user_id');

    public function city_data()
    {
        return $this->hasOne('App\Models\City' ,  'id', 'city');
    }

}
