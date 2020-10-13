<?php

namespace App\Http\Controllers\Backend\Pro\Common;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
 
 
use App\Repositories\Backend\StateRepository;
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
class StateController extends Controller
{
    /**
     * @var StateController
     */
    protected $stateRepository;

    /**
     * StateController constructor.
     *
     * @param StateRepository $stateRepository
     */
    public function __construct(StateRepository $stateRepository)
    {
        parent::__construct();
        $this->stateRepository = $stateRepository;
        
    }   

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {  
        $country_id = $request->get('country_id');
         
        $default_pagination =  config('global_configurations.admin.pagination');
        
        $default_language =  config('global_configurations.admin.language');
        $language = Languages::where(['lang_code'=>$default_language])->first();
        $default_global_language = $language['id'];
        $state = $this->stateRepository->getPaginatedRecords($default_pagination, 'state_code', 'asc',$default_global_language,$country_id,'');
        //print_r($state);
        $countrydropdown = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray(); 
        return view('backend.pro.common.state_listing')
        ->withState($state)->withLanguage($default_global_language)->withCountry($country_id)->withCountrydropdown($countrydropdown);
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
          
            $country_id = $request->get('country_id'); 
             
            $query = str_replace(" ", "%", $query);
            $state = $this->stateRepository->getPaginatedRecords($default_pagination, 'state_code', 'asc',$default_global_language,$country_id,$query);
            return view('backend.pro.common.state_listing_data', compact('state'))->render();
        }
        
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function get_country_by_state(Request $request)
    {
         
        if($request->ajax())
        {
            
       
            $country_id = $request->get('country_id');
            $language = $request->get('language');
            
            $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
            //->join('pro_states_lang','pro_states_lang.statelang_state_id','=','pro_states.state_id')
            //->where('pro_states_lang.statelang_lang_id',  $language)
            ->where('state_country_id',$country_id)
            ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
         
            return $state;
        }
        
    }
    /**
     * @param State $state_id
     * @return mixed
     */


    public function getStates($state_id)
    {
        return States::where('state_id',$state_id)->first();
    }

 


    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        
        //$country = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray(); 
        return view('backend.pro.common.state_create',
        [
            'request' => $request,
            'country' => $country 
             
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create_state_language(Request $request)
    {
        
        
        //$country = Country::select(['country_id','country_code'])->pluck('country_code','country_id');
        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray(); 
        $state = States::select(['state_id','state_code'])->pluck('state_code','state_id');
        
        return view('backend.pro.common.state_create_language',
        [
            'request' => $request ,
            'country' => $country,
            'state' => $state 
             
        ]);
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, States $states, StatesLanguage $stateLanguage)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'state_name'     => ['required','max:150'],
            'state_code' => 'required',
            'state_country_id' => 'required',
            'language' => 'required',
             
            
        ])->validate();
        
        if(isset($data['state_id']) && $data['state_id'] == 0){
            $states->state_code =  $data['state_code']; 
            $states->state_active =  1;
            $states->state_country_id =  $data['state_country_id']; 
            $states->state_identifier =  $data['state_code']; 
            
            $states->save();
            $state_id = $states->state_id; 
         }else{
            $state_id = $data['state_code'];    
         }

           
         
         $language_id = $data['language'];
         $stateLanguageUpdate = $this->getStateByLanguage($state_id,$language_id);
         if(isset($stateLanguageUpdate)){
            //$stateLanguage = $stateLanguageUpdate;
            StatesLanguage::where('statelang_state_id',$state_id)->where('statelang_lang_id',$language_id)->update(['state_name'=>$data['state_name'] ]);
         }else{
            $stateLanguage->state_name =  $data['state_name'];
            $stateLanguage->statelang_state_id =  $state_id; 
            $stateLanguage->statelang_lang_id =  $language_id; 
            $stateLanguage->save();
         }
          


        return redirect()->route('admin.state.index')->withFlashSuccess(__('alerts.backend.state.created'));
    }
  
    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$state_id)
    { 
        $language_id = $request->get('language');
        $state = States::join('pro_states_lang','pro_states_lang.statelang_state_id','=','pro_states.state_id')
        ->join('languages','languages.id','=','pro_states_lang.statelang_lang_id')
        ->select(['*'])->where(['pro_states_lang.statelang_state_id' => $state_id ,'pro_states_lang.statelang_lang_id'=> $language_id])->get();
        //print_r($state);die;

        
        // $country = Country::join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        // ->join('languages','languages.id','=','pro_countries_lang.countrylang_lang_id')
        // ->select(['pro_countries.country_id','pro_countries_lang.country_name'])->where(['pro_countries_lang.countrylang_lang_id'=> $language_id])->get()->pluck('country_name','country_id');
        //print_r($country);die;
        $country = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
        return view('backend.pro.common.state_edit')
        ->withState($state)->withCountry($country);
    }

    /**
     * @param Request $request
 
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $state_id)
    {
        $data = $request->all();
        
         $validator = Validator::make($data, [
            'state_name'     => ['required','max:150'],
            'state_code' => 'required',
            'language' => 'required'
            
        ])->validate();
        
        $state = $this->getStates($state_id);
        $state->state_id =  $state_id;
        $state->state_code =  $data['state_code']; 
        $state->state_country_id =  $data['state_country_id']; 
        
        $state->state_identifier =  $data['state_code']; 
       // echo '<pre>';print_r($state);die;
        $state->save();

        $language_id = $data['language'];
        $stateLanguage = $this->getStateByLanguage($state_id,$language_id);
        if($stateLanguage){
            StatesLanguage::where('statelang_state_id',$state_id)->where('statelang_lang_id',$language_id)->update(['state_name'=>$data['state_name'] ]);
        }    
        
        
     
 
        return redirect()->route('admin.state.index')->withFlashSuccess(__('alerts.backend.state.updated'));
    }

    
    public function getStateByLanguage($state_id,$language_id)
    {
        return StatesLanguage::where('statelang_state_id',$state_id)->where('statelang_lang_id',$language_id)->first();
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($state_id)
    {
        $post = States::where('state_id',$state_id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.state.index')->withFlashSuccess(__('alerts.backend.state.deleted'));
        }
        return redirect()->back();
    }

       

}
