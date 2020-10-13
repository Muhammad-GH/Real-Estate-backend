<?php

namespace App\Models\BackendPro;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = "pro_cities";
    protected $primaryKey = 'city_id';
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo('App\Models\BackendPro\States');
    }

    public function cities()
    {
        return $this->hasMany(CityLanguage::class, 'citylang_city_id', 'city_id');
    }

    public function allcities()
    {
        return $this->hasMany(CityLanguage::class, 'citylang_city_id', 'city_id');
    }
}
