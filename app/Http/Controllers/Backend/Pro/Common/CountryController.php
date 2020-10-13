<?php

namespace App\Http\Controllers\Backend\Pro\Common;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
 
use App\Repositories\Backend\CountryRepository;
use App\Models\BackendPro\Country;

use App\Models\BackendPro\CountryLanguage;
use App\Models\Languages;
use Session;
use config;
//use App\Models\Marketplace\MaterialBid;

/**
 * Class MaterialOfferController.
 */
class CountryController extends Controller
{
    /**
     * @var CountryController
     */
    protected $countryRepository;

    /**
     * CountryController constructor.
     *
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        parent::__construct();
        $this->countryRepository = $countryRepository;
        
    }   

    public function getStates(Country $country)
    {
        return $country->states()->select('state_id', 'state_code')->get();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {  
 
        $default_pagination =  config('global_configurations.admin.pagination');
        
        $default_language =  config('global_configurations.admin.language');
        $language = Languages::where(['lang_code'=>$default_language])->first();
        $default_global_language = $language['id'];
        $country = $this->countryRepository->getPaginatedRecords($default_pagination, 'country_code', 'asc',$default_global_language,'');
        //print_r($country);
        //$country = CountryLanguage::select('country_name','countrylang_country_id')->where(['countrylang_lang_id'=>$default_global_language])->pluck();
        return view('backend.pro.common.country_listing')
        ->withCountry($country)->withLanguage($default_global_language);
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
            

            $query = str_replace(" ", "%", $query);
            $country = $this->countryRepository->getPaginatedRecords($default_pagination, 'country_code', 'asc',$default_global_language,$query);
            return view('backend.pro.common.country_listing_data', compact('country'))->render();
        }
        
    }

    public function getCountry($country_id)
    {
        return Country::where('country_id',$country_id)->first();
    }

 


    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        
        $country_code = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
        return view('backend.pro.common.country_create',
        [
            'request' => $request ,
             
            'country_code' => $country_code 
             
        ]);
    }

    
    /**
     * @param Request $request
     * @return mixed
     */
    public function create_country_language(Request $request)
    {
        
        
        $country_code = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
        return view('backend.pro.common.country_create_language',
        [
            'request' => $request ,
             
            'country_code' => $country_code 
             
        ]);
    }
    

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Country $country, CountryLanguage $countryLanguage)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'country_name'     => ['required','max:150'],
            'country_code' => 'required',
            'language' => 'required',
             
            
        ])->validate();
         if(isset($data['country_id']) && $data['country_id'] == 0){
            $country->country_code =  $data['country_code']; 
            $country->country_active =  1;
            $country->country_language_id =  0;   
            $country->save();
            $country_id = $country->country_id;   
         }else{
            $country_id = $data['country_code'];    
         }
        

        
 
         $language_id = $data['language'];
         $countryLanguageUpdate = $this->getCountryByLanguage($country_id,$language_id);
         
         if($countryLanguageUpdate){
             CountryLanguage::where('countrylang_country_id',$country_id)->where('countrylang_lang_id',$language_id)->update(['country_name'=>$data['country_name'] ]);
         }else{
            $countryLanguage->country_name =  $data['country_name'];
            $countryLanguage->countrylang_country_id =  $country_id; 
            $countryLanguage->countrylang_lang_id =  $language_id; 
            $countryLanguage->save();
         }
         

        return redirect()->route('admin.country.index')->withFlashSuccess(__('alerts.backend.country.created'));
    }

    /**
     * @param Request $request
    * @param Property  $property
     *
     * @return mixed
     */
    public function show(Request $request,$tender_id)
    {
        $materialData = $this->getTender($tender_id);
        return view('backend.marketplace.material.offer-show')
            ->withMaterial($materialData);
    }

 



    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$country_id)
    { 
        $language_id = $request->get('language');
        $country = Country::join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->join('languages','languages.id','=','pro_countries_lang.countrylang_lang_id')
        ->select(['*'])->where(['pro_countries_lang.countrylang_country_id' => $country_id ,'pro_countries_lang.countrylang_lang_id'=> $language_id])->get();
        //print_r($country);die;
        $country_code = Country::select(['country_id','country_code'])->pluck('country_code','country_id'); 
        return view('backend.pro.common.country_edit')
        ->withCountry($country)->withCountryCode($country_code);
    }

    /**
     * @param Request $request
 
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $country_id)
    {
        $data = $request->all();
        
         $validator = Validator::make($data, [
            'country_name'     => ['required','max:150'],
            'country_code' => 'required',
            'language' => 'required'
            
        ])->validate();
        
        $country = $this->getCountry($country_id);
        $country->country_code =  $data['country_code']; 
        $country->save();

        $language_id = $data['language'];
        $countryLanguage = $this->getCountryByLanguage($country_id,$language_id);
         
        if($countryLanguage){
            CountryLanguage::where('countrylang_country_id',$country_id)->where('countrylang_lang_id',$language_id)->update(['country_name'=>$data['country_name'] ]);
        }

    

        //$country->country_name     =  $data['country_name'];
        //$country->language  =  $data['language'];
     
           

         

        return redirect()->route('admin.country.index')->withFlashSuccess(__('alerts.backend.country.updated'));
    }

    
    public function getCountryByLanguage($country_id,$language_id)
    {
        return CountryLanguage::where('countrylang_country_id',$country_id)->where('countrylang_lang_id',$language_id)->first();
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($country_id)
    {
        $post = Country::where('country_id',$country_id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.country.index')->withFlashSuccess(__('alerts.backend.country.deleted'));
        }
        return redirect()->back();
    }

       

}
