<?php
namespace App\Models;
namespace App\Models\BackendPro;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_countries';
    protected $primaryKey = 'country_id';
    public $timestamps = false;

    public function states()
    {
        return $this->hasMany('App\Models\BackendPro\States');
    }

    public function country()
    {
        return $this->hasMany(CountryLanguage::class , 'countrylang_country_id', 'country_id');
    }

    public function allcountry()
    {
        return $this->hasMany(CountryLanguage::class, 'countrylang_country_id', 'country_id');
    }

}
