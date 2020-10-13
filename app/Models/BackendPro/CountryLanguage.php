<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;


class CountryLanguage extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_countries_lang';
    
    public $timestamps = false;

    public function country()
    {
        return $this->hasMany(Country::class , 'country_id', 'countrylang_country_id');
    }

}
