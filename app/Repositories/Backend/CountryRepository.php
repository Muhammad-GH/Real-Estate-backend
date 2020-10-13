<?php
namespace App\Repositories\Backend;

use App\Models\BackendPro\Country;
use App\Models\BackendPro\CountryLanguage;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Illuminate\Pagination\LengthAwarePaginator;


class CountryRepository extends BaseRepository
{
    /**
     * CountryRepository constructor.
     *
     * @param  Country  $model
     */
    public function __construct(Country $model)
    {
        $this->model = $model;
    }


    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $country_code='') : LengthAwarePaginator
    {
        return $this->model->with('allcountry')
            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPaginatedRecords($paged = 25, $orderBy = 'created_at', $sort = 'desc',$language='' ,$query='') : LengthAwarePaginator
    {
        return $this->model->with('allcountry')
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->join('languages','languages.id','=','pro_countries_lang.countrylang_lang_id')
        ->where('pro_countries_lang.countrylang_lang_id',  $language)
        //->where('country_code', 'like', '%'.$query.'%')
        ->where('pro_countries_lang.country_name', 'like', '%'.$query.'%')
        
        
       
        ->orderBy($orderBy, $sort)
        ->paginate($paged);
    }

    public function getCountry($country_id,$language_id) : LengthAwarePaginator
    {
        return $this->model->with('allcountry')
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->join('languages','languages.id','=','pro_countries_lang.countrylang_lang_id')
        ->where('pro_countries_lang.countrylang_country_id',  $country_id)
        ->where('pro_countries_lang.countrylang_lang_id',  $language_id)->first();
 
    }

     
}