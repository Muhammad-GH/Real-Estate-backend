<?php

namespace App\Http\Controllers\Backend\Pro\Common;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
 
 
use App\Repositories\Backend\CityRepository;
use App\Models\BackendPro\City;
use App\Models\BackendPro\CityLanguage;

use App\Models\BackendPro\States;
use App\Models\BackendPro\StatesLanguage;

use App\Models\BackendPro\Country;
use App\Models\BackendPro\CountryLanguage;

use App\Models\Languages;
use Session;
use config;
//use App\Models\Marketplace\MaterialBid;

/**
 * Class MaterialOfferController.
 */
class CityController extends Controller
{
    /**
     * @var CityController
     */
    protected $cityRepository;

    /**
     * StateController constructor.
     *
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        parent::__construct();
        $this->cityRepository = $cityRepository;
        
         
        
    }   

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {  
        
        $state = array(__('labels.backend.city.select_state'));
        $current_country_id = config('global_configurations.admin.default_country');;
        $state_id = $request->get('state_id');
        if($state_id !=''){
            $current_country = States::select(['pro_states.state_country_id'])->where(['state_id'=>$state_id])->first();
            if($current_country){
                $current_country_id = $current_country->state_country_id; 
                $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
                ->where('state_country_id',$current_country_id)
                ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
            }
            $states =  $state_id;
        }else{
             
            $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
            ->where('state_country_id',$current_country_id)
            ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
            $states = array_keys($state);
        }
        $default_pagination =  config('global_configurations.admin.pagination');
        
        $default_language =  config('global_configurations.admin.language');
        $language = Languages::where(['lang_code'=>$default_language])->first();
        $default_global_language = $language['id'];
        $city = $this->cityRepository->getPaginatedRecords($default_pagination, 'city_name', 'asc',$default_global_language,$state_id,'');
        
        
        $countrydropdown = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray(); 
        return view('backend.pro.common.city_listing')
        ->withCity($city)->withLanguage($default_global_language)->withStates($state)->withState($state_id)->withCountry($current_country_id)->withCountrydropdown($countrydropdown);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function fetch_data(Request $request)
    {
        $default_pagination =  config('global_configurations.admin.pagination');
        if($request->ajax())
        {
            
            
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $default_global_language = $request->get('language');
            
            
            $default_language =  config('global_configurations.admin.language');
            $language = Languages::where(['lang_code'=>$default_language])->first();
            if($default_global_language == ''){
                $default_global_language = $language['id'];
            }
          
            $state_id = $request->get('state_id'); 
             
            $query = str_replace(" ", "%", $query);
            $city = $this->cityRepository->getPaginatedRecords($default_pagination, 'city_name', 'asc',$default_global_language,$state_id,$query);
            return view('backend.pro.common.city_listing_data', compact('city'))->render();
        }
        
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function get_city_by_state(Request $request)
    {
         
        if($request->ajax())
        {
            
       
            $state_id = $request->get('state_id');
            $language = $request->get('language');
            
            $state = City::select(['pro_cities.city_id','pro_cities.city_identifier'])
            //->join('pro_states_lang','pro_states_lang.citylang_city_id','=','pro_states.city_id')
            //->where('pro_states_lang.citylang_lang_id',  $language)
            ->where('city_state_id',$state_id)
            ->pluck('pro_cities.city_identifier','pro_cities.city_id')->toArray();
         
            return $state;
        }
        
    }
    /**
     * @param State $city_id
     * @return mixed
     */


    public function getCities($city_id)
    {
        return City::where('city_id',$city_id)->first();
    }

 


    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $language = Languages::get()->pluck('name','id')->toArray();
        $current_country_id = config('global_configurations.admin.default_country');;
        //$country = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();

        return view('backend.pro.common.city_create',
        [
            'request' => $request,
            'country' => $country ,
            'language' => $language ,
            'country_id' => $current_country_id 
             
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create_city_language(Request $request)
    {
        
        
        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();
        $state = States::select(['state_id','state_name'])
        ->join('pro_states_lang','pro_states_lang.statelang_state_id','=','pro_states.state_id')
        ->pluck('pro_states_lang.state_name','pro_states.state_id')->toArray(); 
        $city = City::select(['city_id','city_identifier'])->pluck('city_identifier','city_id');
        
        return view('backend.pro.common.city_create_language',
        [
            'request' => $request ,
            'country' => $country,
            'state' => $state,
            'city' => $city
             
        ]);
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, City $city, CityLanguage $cityLanguage)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'city_name'     => ['required','max:150'],
             
            'city_state_id' => 'required',
            'language' => 'required',
             
            
        ])->validate();
        if(isset($data['city_id'])){
            $city_id = $data['city_id']; 
        }
        if(isset($data['city_id']) && $data['city_id'] == 0){
             
            $city->city_active =  1;
            $city->city_state_id =  $data['city_state_id']; 
            $city->city_identifier =  $data['city_name']; 
            
            $city->save();
            $city_id = $city->city_id; 
         } 

           
         
         $language_id = $data['language'];
         $cityLanguageUpdate = $this->getCityByLanguage($city_id,$language_id);
         if(isset($cityLanguageUpdate)){
            //$cityLanguage = $cityLanguageUpdate;
            CityLanguage::where('citylang_city_id',$city_id)->where('citylang_lang_id',$language_id)->update(['city_name'=>$data['city_name'] ]);
         }else{
 
            $cityLanguage->city_name =  $data['city_name'];
            $cityLanguage->citylang_city_id =  $city_id; 
            $cityLanguage->citylang_lang_id =  $language_id; 
            $cityLanguage->save();
         }
         

        return redirect()->route('admin.city.index')->withFlashSuccess(__('alerts.backend.city.created'));
    }
  
    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$city_id)
    { 
        $language_id = $request->get('language');
        $language = Languages::get()->pluck('name','id')->toArray();
        $city = City::join('pro_cities_lang','pro_cities_lang.citylang_city_id','=','pro_cities.city_id')
        ->join('languages','languages.id','=','pro_cities_lang.citylang_lang_id')
        ->join('pro_states','pro_states.state_id','=','pro_cities.city_state_id')
        ->join('pro_countries','pro_countries.country_id','=','pro_states.state_country_id')
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->select(['pro_cities.*','pro_countries.country_id','pro_cities_lang.*'])->where(['pro_cities_lang.citylang_city_id' => $city_id ,'pro_cities_lang.citylang_lang_id'=> $language_id])->get();
        //echo '<pre>';print_r($city);die;
        if(isset($city[0])){
            $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
            ->where('state_country_id',$city[0]['country_id'])
            ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
            
            // $country = Country::join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
            // ->join('languages','languages.id','=','pro_countries_lang.countrylang_lang_id')
            // ->select(['pro_countries.country_id','pro_countries_lang.country_name'])->where(['pro_countries_lang.countrylang_lang_id'=> $language_id])->get()->pluck('country_name','country_id');
            //print_r($country);die;
            $country = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
            return view('backend.pro.common.city_edit')
            ->withCity($city)->withState($state)->withCountry($country)->withLanguage($language);
        }else{
            return redirect()->route('admin.city.index')->withFlashSuccess(__('alerts.backend.city.invalid_request'));
        }
    }

    /**
     * @param Request $request
 
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $city_id)
    {
        $data = $request->all();
        
         $validator = Validator::make($data, [
            'city_name'     => ['required','max:150'],
            
            'language' => 'required'
            
        ])->validate();
        
        $state = $this->getCities($city_id);
        $state->city_id =  $city_id;
        
        $state->city_state_id =  $data['city_state_id']; 
        
        //$state->city_identifier =  $data['city_name']; 
       // echo '<pre>';print_r($state);die;
        $state->save();

        $language_id = $data['language'];
        $cityLanguage = $this->getCityByLanguage($city_id,$language_id);
        if($cityLanguage){
            CityLanguage::where('citylang_city_id',$city_id)->where('citylang_lang_id',$language_id)->update(['city_name'=>$data['city_name'] ]);
        }    
        
        
     
 
        return redirect()->route('admin.city.index')->withFlashSuccess(__('alerts.backend.city.updated'));
    }

    
    public function getCityByLanguage($city_id,$language_id)
    {
        return CityLanguage::where('citylang_city_id',$city_id)->where('citylang_lang_id',$language_id)->first();
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($city_id)
    {
        $post = City::where('city_id',$city_id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.city.index')->withFlashSuccess(__('alerts.backend.city.deleted'));
        }
        return redirect()->back();
    }

       

}
