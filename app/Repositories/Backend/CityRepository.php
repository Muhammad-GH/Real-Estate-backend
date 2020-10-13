<?php
namespace App\Repositories\Backend;

use App\Models\BackendPro\City;
use App\Models\BackendPro\CityLanguage;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Illuminate\Pagination\LengthAwarePaginator;


class CityRepository extends BaseRepository
{
    /**
     * CityRepository constructor.
     *
     * @param  City  $model
     */
    public function __construct(City $model)
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
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc' ) : LengthAwarePaginator
    {
        return $this->model->with('allcities')
            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPaginatedRecords($paged = 25, $orderBy = 'created_at', $sort = 'desc',$language='' ,$state_id='' ,$query='') : LengthAwarePaginator
    {   
        if(is_array($state_id)){
            return $this->model->with('allcities')
                    ->join('pro_cities_lang','pro_cities_lang.citylang_city_id','=','pro_cities.city_id')
                    ->join('languages','languages.id','=','pro_cities_lang.citylang_lang_id')
                    ->where('pro_cities_lang.citylang_lang_id',  $language)
                    ->whereIn('pro_cities.city_state_id',  $state_id)
                    ->where('pro_cities_lang.city_name', 'like', '%'.$query.'%')
                    ->orderBy($orderBy, $sort)
                    ->paginate($paged);
        }else{
            if($state_id ==''){
                return $this->model->with('allcities')
                    ->join('pro_cities_lang','pro_cities_lang.citylang_city_id','=','pro_cities.city_id')
                    ->join('languages','languages.id','=','pro_cities_lang.citylang_lang_id')
                    ->where('pro_cities_lang.citylang_lang_id',  $language)
    //                ->where('pro_cities.city_state_id',  $state_id)
                    ->where('pro_cities_lang.city_name', 'like', '%'.$query.'%')
                    ->orderBy($orderBy, $sort)
                    ->paginate($paged);
            }else{
                
                return $this->model->with('allcities')
                    ->join('pro_cities_lang','pro_cities_lang.citylang_city_id','=','pro_cities.city_id')
                    ->join('languages','languages.id','=','pro_cities_lang.citylang_lang_id')
                    ->where('pro_cities_lang.citylang_lang_id',  $language)
                    ->where('pro_cities.city_state_id',  $state_id)
                    ->where('pro_cities_lang.city_name', 'like', '%'.$query.'%')
                    ->orderBy($orderBy, $sort)
                    ->paginate($paged);
            }
        }
        
    }

    public function getStates($city_id,$language_id) : LengthAwarePaginator
    {
        return $this->model->with('allstates')
        ->join('pro_cities_lang','pro_cities_lang.citylang_city_id','=','pro_cities.city_id')
        ->join('languages','languages.id','=','pro_cities_lang.citylang_lang_id')
        ->where('pro_cities_lang.citylang_city_id',  $city_id)
        ->where('pro_cities_lang.citylang_lang_id',  $language_id)->first();
 
    }

     
}