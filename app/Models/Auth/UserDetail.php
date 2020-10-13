<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDetail.
 */
class UserDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_detail';


    protected $fillable = array('user_id');

    public function city_data()
    {
        return $this->hasOne('App\Models\City' ,  'id', 'city');
    }

}
