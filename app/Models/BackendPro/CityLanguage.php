<?php

namespace App\Models\BackendPro;

use Illuminate\Database\Eloquent\Model;


class CityLanguage extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_cities_lang';

    public $timestamps = false;

    public function city()
    {
        return $this->hasMany(City::class, 'city_id', 'citylang_city_id');
    }
}
