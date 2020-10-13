<?php

namespace App\Http\Controllers\Backend\Pro\Marketplace;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
 
use App\Repositories\Backend\TenderRepository;
use App\Models\BackendPro\Tender;
use App\Models\BackendPro\Category;
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
class TenderController extends Controller
{
    /**
     * @var TenderController
     */
    protected $tenderRepository;

    /**
     * MaterialOfferController constructor.
     *
     * @param TenderRepository $tenderRepository
     */
    public function __construct(TenderRepository $tenderRepository)
    {
        parent::__construct();
        $this->tenderRepository = $tenderRepository;
        
    }   

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {  
        // if ($this->checkLogin() == ''){ 
        //     return redirect()->route('admin.');
        // }
       
 
        $default_pagination =  config('global_configurations.admin.pagination');
        $tender = $this->tenderRepository->getActivePaginated($default_pagination, 'tender_id', 'asc');
        
        return view('backend.pro.marketplace.listing')
                ->withTender($tender);
    }

    
    /**
     * @param Request $request
     * @return mixed
     */
    function fetch_data(Request $request)
    {
         
        $default_pagination =   config('global_configurations.admin.pagination');
        if($request->ajax())
        {
            
            
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $tender_type = $request->get('tender_type');
            $tender_category_type = $request->get('tender_category_type');
       
            $query = str_replace(" ", "%", $query);
            
            $tender = $this->tenderRepository->getPaginatedRecords($default_pagination, 'tender_id', 'asc',$tender_type,$tender_category_type,$query);
            
            return view('backend.pro.marketplace.listing_data')
                    ->withTender($tender);
        }
        
    }
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        
        //Session::put('locale', 'en');
        
        $categories = Category::pluck('category_name','category_id');
        return view('backend.pro.marketplace.create')->withCategories($categories);
    }

        /**
     * @param Request $request
     * @return mixed
     */
    public function material_offer(Request $request)
    {
        
        //Session::put('locale', 'en');
        $language = Languages::get()->pluck('name','id')->toArray();
        $current_country_id = config('global_configurations.admin.default_country');;

        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();

        $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
        ->where('state_country_id',$current_country_id)
        ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
        $categories = Category::pluck('category_name','category_id');
        return view('backend.pro.marketplace.material_offer',
        [
             
            'state' => $state ,
            'language' => $language ,
            'country_id' => $current_country_id 
             
        ])->withCategories($categories);
    }
        /**
     * @param Request $request
     * @return mixed
     */
    public function material_request(Request $request)
    {
        
        //Session::put('locale', 'en');
        $language = Languages::get()->pluck('name','id')->toArray();
        $current_country_id = config('global_configurations.admin.default_country');;

        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();

        $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
        ->where('state_country_id',$current_country_id)
        ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
        $categories = Category::pluck('category_name','category_id');
        return view('backend.pro.marketplace.material_request',
        [
             
            'state' => $state ,
            'language' => $language ,
            'country_id' => $current_country_id 
             
        ])->withCategories($categories);
    }
        /**
     * @param Request $request
     * @return mixed
     */
    public function work_offer(Request $request)
    {
        
        //Session::put('locale', 'en');
        $language = Languages::get()->pluck('name','id')->toArray();
        $current_country_id = config('global_configurations.admin.default_country');;

        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();

        $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
        ->where('state_country_id',$current_country_id)
        ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
        $categories = Category::pluck('category_name','category_id');
        return view('backend.pro.marketplace.work_offer',
        [
             
            'state' => $state ,
            'language' => $language ,
            'country_id' => $current_country_id 
             
        ])->withCategories($categories);
    }
        /**
     * @param Request $request
     * @return mixed
     */
    public function work_request(Request $request)
    {
        
        //Session::put('locale', 'en');
        
        $language = Languages::get()->pluck('name','id')->toArray();
        $current_country_id = config('global_configurations.admin.default_country');;

        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();

        $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
        ->where('state_country_id',$current_country_id)
        ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
        $categories = Category::pluck('category_name','category_id');
        return view('backend.pro.marketplace.work_request',
        [
             
            'state' => $state ,
            'language' => $language ,
            'country_id' => $current_country_id 
             
        ])->withCategories($categories);
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Tender $tender)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'tender_title'     => ['required','max:150'],
            'tender_category_type' => 'required',
            'tender_category_id' => 'required',
            'tender_description'   => 'required',
            'tender_attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
            'tender_featured_image' => 'required',
            'tender_featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tender_slider_image' => 'required',
            'tender_slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ])->validate();
        
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Offer'){
            $validator = Validator::make($data, [
           
                'tender_budget'    => 'required',
                'tender_available_from'    => 'required',
                'tender_available_to'   => 'required',
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
                
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
            
                
            ])->validate();
        }
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Request'){
            $validator = Validator::make($data, [
                
                'tender_rate'    => 'required|numeric',
                
                'tender_budget'    => 'required',
           
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
               
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
           
                
            ])->validate();
        }
        
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Request'){
            $validator = Validator::make($data, [
                 
                
                'tender_quantity'    => 'required|numeric',
                'tender_unit'    => 'required',
           
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
               
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
                
            ])->validate();
        }
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Offer'){
            $validator = Validator::make($data, [
                 
                'tender_quantity'    => 'required|numeric',
                'tender_cost_per_unit'    => 'required|numeric',
                'tender_unit'   => 'required',
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
                'tender_warranty'    => 'required|numeric',
                'tender_warranty_type'     => 'required',
                'delivery_type'    => 'required',
                'tender_delivery_type_cost*'    => 'required|numeric',
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
                'tender_attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
                'tender_featured_image' => 'required',
                'tender_featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tender_slider_image' => 'required',
                'tender_slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                
            ])->validate();
        }
        $user_id =   $this->checkLogin();
        $tender->tender_title     =  $data['tender_title'];
        $tender->tender_category_type =  $data['tender_category_type'];
        $tender->tender_category_id =  $data['tender_category_id'];
        $tender->tender_user_id =   $user_id;
        // $property->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $tender->tender_description  =  $data['tender_description'];
        $tender->tender_type   =  $data['tender_type'];
        // Add work Offer
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Offer'){
            $tender->tender_budget   =  $data['tender_budget'];
            $tender->tender_available_from   =  $data['tender_available_from'];
            $tender->tender_available_to   =  $data['tender_available_to'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
        }

        // Add Work Request  
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Request'){
            $tender->tender_rate   =  $data['tender_rate'];
            $tender->tender_budget   =  $data['tender_budget'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
        }
        // Add Material Request  
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Request'){
            $tender->tender_quantity   =  $data['tender_quantity'];
            $tender->tender_unit   =  $data['tender_unit'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour")); 
            
            
        }
        // Add Work Request  
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Offer'){
            $tender->tender_quantity   =  $data['tender_quantity'];
            $tender->tender_cost_per_unit   =  $data['tender_cost_per_unit'];
            $tender->tender_unit   =  $data['tender_unit'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $tender->tender_warranty   =  $data['tender_warranty'];
            $tender->tender_warranty_type   =  $data['tender_warranty_type'];
            
            $deliverytype_cost = [];
            foreach ($data['delivery_type'] as $key => $value) {
               # code...
                $deliverytype_cost[$value] = $data['tender_delivery_type_cost'][$key];
            }
            if(!empty($deliverytype_cost)){
                $tender->tender_delivery_type_cost = json_encode($deliverytype_cost);
            }

            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour")); 
            
        }
        

        
        
        $tender->tender_attachment = '';

        if($request->hasfile('tender_attachment'))
        {
            // $name   = explode('.', ($data['attachment']->getClientOriginalName() ))[0];;
            // $ext    =  $data['attachment']->getClientOriginalExtension();
            // $imageName = $name.'_'.time().'.'.$ext;
            // $data['attachment']->move(public_path().'/images/marketplace/material/', $imageName);  

            $document = $request->file('tender_attachment');
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $tender->tender_attachment = $imageName;

        }
        $tender->tender_featured_image = '';
        if($request->hasfile('tender_featured_image'))
        {
            // $name   = explode('.', ($data['featured_image']->getClientOriginalName() ))[0];;
            // $ext    =  $data['featured_image']->getClientOriginalExtension();
            // $imageName = $name.'_'.time().'.'.$ext;
            // $data['featured_image']->move(public_path().'/images/marketplace/material/', $imageName);  
            #$imgsizes = $request->file('featured_image')->getSize(); 

            $document = $request->file('tender_featured_image');
            $size = $document->getSize();
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $tender->tender_featured_image = $imageName;

        }
        if($request->hasfile('tender_slider_image'))
         {
            $sliderImages = [];
            foreach($request->file('tender_slider_image') as $image)
            {
                $size = $image->getSize();
                // $name   = explode('.', ($image->getClientOriginalName() ))[0];
                // $ext    =  $image->getClientOriginalExtension();
                 $imageName  = time()."_".$image->getClientOriginalName();
                $image->move(public_path().'/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }
            if(!empty($sliderImages)){
                $tender->tender_slider_images = json_encode($sliderImages);
            }
            
         }

         $tender->save();

        return redirect()->route('admin.tender.index')->withFlashSuccess('The material offer was successfully created.');
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

    public function getTender($tender_id)
    {
        return Tender::where('tender_id',$tender_id)->with('category')->first();
    }

    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$tender_id)
    {
        $tenderData = $this->getTender($tender_id);
       
        $language = Languages::get()->pluck('name','id')->toArray();
        $current_country_id = config('global_configurations.admin.default_country');;
        $language_id = config('global_configurations.admin.language');;

        $country = Country::select(['country_id','country_name'])
        ->join('pro_countries_lang','pro_countries_lang.countrylang_country_id','=','pro_countries.country_id')
        ->pluck('pro_countries_lang.country_name','pro_countries.country_id')->toArray();

        $state = States::select(['pro_states.state_id','pro_states.state_identifier'])
        ->where('state_country_id',$current_country_id)
        ->pluck('pro_states.state_identifier','pro_states.state_id')->toArray();
        $categories = Category::pluck('category_name','category_id');
        if(isset($tenderData->tender_city) && $tenderData->tender_city !=''){
            $city = City:: join('pro_states','pro_states.state_id','=','pro_cities.city_state_id')
            ->join('pro_countries','pro_countries.country_id','=','pro_states.state_country_id')
            ->select(['pro_states.state_id' ])->where(['pro_cities.city_id' => $tenderData->tender_city ]) ->get();
            $state_id = $city[0]['state_id'];
            $city = City:: join('pro_states','pro_states.state_id','=','pro_cities.city_state_id')
            ->join('pro_countries','pro_countries.country_id','=','pro_states.state_country_id')
            
            ->select(['pro_cities.city_id','pro_cities.city_identifier' ])->where(['pro_cities.city_id' => $tenderData->tender_city ]) ->pluck('pro_cities.city_identifier','pro_cities.city_id' )->toArray();
    
        }else{
            $city = array();
        }
        
        
        if( $tenderData->tender_category_type == 'Work' && $tenderData->tender_type == 'Offer' ){
            return view('backend.pro.marketplace.work_offer_edit',
            [
                
                'state' => $state ,
                'state_id' => $state_id ,
                'city' => $city ,
                'language' => $language ,
                'country_id' => $current_country_id 
                
            ])->withTender($tenderData)->withCategories($categories);
        }
        if( $tenderData->tender_category_type == 'Work' && $tenderData->tender_type == 'Request' ){
            return view('backend.pro.marketplace.work_request_edit',
            [
                
                'state' => $state ,
                'state_id' => $state_id ,
                'city' => $city ,
                'language' => $language ,
                'country_id' => $current_country_id 
                
            ])->withTender($tenderData)->withCategories($categories);
        }
        if( $tenderData->tender_category_type == 'Material' && $tenderData->tender_type == 'Offer' ){
            return view('backend.pro.marketplace.material_offer_edit',
            [
                
                'state' => $state ,
                'state_id' => $state_id ,
                'city' => $city ,
                'language' => $language ,
                'country_id' => $current_country_id 
                
            ])->withTender($tenderData)->withCategories($categories);
        }
        if( $tenderData->tender_category_type == 'Material' && $tenderData->tender_type == 'Request' ){
            return view('backend.pro.marketplace.material_request_edit',
            [
                
                'state' => $state ,
                'state_id' => $state_id ,
                'city' => $city ,
                'language' => $language ,
                'country_id' => $current_country_id 
                
            ])->withTender($tenderData)->withCategories($categories);
        }
        
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $tender_id)
    {
        $data = $request->all();
        
        //  $validator = Validator::make($data, [
        //     'tender_title'     => ['required','max:150'],
        //     'tender_category_type' => 'required',
        //     'tender_category_id' => 'required',
        //     'tender_description'   => 'required',
        //     'tender_quantity'    => 'required|numeric',
        //     'tender_cost_per_unit'    => 'required|numeric',
        //     'tender_unit'   => 'required',
        //     'tender_city'      => 'required',
        //     'tender_pincode'     => 'required',
        //     'tender_warranty'    => 'required|numeric',
        //     'tender_warranty_type'     => 'required',
        //     'delivery_type'    => 'required',
        //     'tender_delivery_type_cost*'    => 'required|numeric',
        //     'tender_expiry_days'  => 'required|numeric',
        //     'tender_expiry_hour'  => 'numeric',
        //     'tender_attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
        //     'tender_featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'tender_slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        // ])->validate();
        $validator = Validator::make($data, [
            'tender_title'     => ['required','max:150'],
            'tender_category_type' => 'required',
            'tender_category_id' => 'required',
            'tender_description'   => 'required',
            'tender_attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
            'tender_featured_image' => 'required',
            'tender_featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            'tender_slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ])->validate();
        
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Offer'){
            $validator = Validator::make($data, [
           
                'tender_budget'    => 'required',
                'tender_available_from'    => 'required',
                'tender_available_to'   => 'required',
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
                
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
            
                
            ])->validate();
        }
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Request'){
            $validator = Validator::make($data, [
                
                'tender_rate'    => 'required|numeric',
                
                'tender_budget'    => 'required',
                'tender_available_from'    => 'required',
                'tender_available_to'   => 'required',
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
               
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
           
                
            ])->validate();
        }
        
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Request'){
            $validator = Validator::make($data, [
                 
                
                'tender_quantity'    => 'required|numeric',
                'tender_unit'    => 'required',
           
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
               
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
                
            ])->validate();
        }
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Offer'){
            $validator = Validator::make($data, [
                 
                'tender_quantity'    => 'required|numeric',
                'tender_cost_per_unit'    => 'required|numeric',
                'tender_unit'   => 'required',
                'tender_city'      => 'required',
                'tender_pincode'     => 'required',
                'tender_warranty'    => 'required|numeric',
                'tender_warranty_type'     => 'required',
                'delivery_type'    => 'required',
                'tender_delivery_type_cost*'    => 'required|numeric',
                'tender_expiry_days'  => 'required|numeric',
                'tender_expiry_hour'  => 'numeric',
                'tender_attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
                'tender_featured_image' => 'required',
                'tender_featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
                'tender_slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                
            ])->validate();
        }
        $tender = $this->getTender($tender_id);
        $tender->tender_title     =  $data['tender_title'];
        $tender->tender_category_type =  $data['tender_category_type'];
        $tender->tender_category_id =  $data['tender_category_id'];
     
        // $property->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $tender->tender_description  =  $data['tender_description'];
        $tender->tender_type   =  $data['tender_type'];
        // Add work Offer
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Offer'){
            $tender->tender_budget   =  $data['tender_budget'];
            $tender->tender_available_from   =  $data['tender_available_from'];
            $tender->tender_available_to   =  $data['tender_available_to'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
        }

        // Add Work Request  
        if($data['tender_category_type'] == 'Work' && $data['tender_type'] == 'Request'){
            $tender->tender_rate   =  $data['tender_rate'];
            $tender->tender_budget   =  $data['tender_budget'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
        }
        // Add Material Request  
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Request'){
            $tender->tender_quantity   =  $data['tender_quantity'];
            $tender->tender_unit   =  $data['tender_unit'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour")); 
            
            
        }
        // Add Work Request  
        if($data['tender_category_type'] == 'Material' && $data['tender_type'] == 'Offer'){
            $tender->tender_quantity   =  $data['tender_quantity'];
            $tender->tender_cost_per_unit   =  $data['tender_cost_per_unit'];
            $tender->tender_unit   =  $data['tender_unit'];
            $tender->tender_city   =  $data['tender_city'];
            $tender->tender_pincode   =  $data['tender_pincode'];
            $tender->tender_warranty   =  $data['tender_warranty'];
            $tender->tender_warranty_type   =  $data['tender_warranty_type'];
            
            $deliverytype_cost = [];
            foreach ($data['delivery_type'] as $key => $value) {
               # code...
                $deliverytype_cost[$value] = $data['tender_delivery_type_cost'][$key];
            }
            if(!empty($deliverytype_cost)){
                $tender->tender_delivery_type_cost = json_encode($deliverytype_cost);
            }

            $expDays = $data['tender_expiry_days'];
            $expiry_hour = $data['tender_expiry_hour']?$data['tender_expiry_hour']:0;

            if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
                $expDays = $data['tender_expiry_days']-1;
            }
            $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour")); 
            
        }



        /*$tender->tender_title     =  $data['tender_title'];
        $tender->tender_category_type =  $data['tender_category_type'];
        $tender->tender_category_id =  $data['tender_category_id'];
       
        $tender->tender_description  =  $data['tender_description'];
        $tender->tender_quantity   =  $data['tender_quantity']; 
        $tender->tender_cost_per_unit   =  $data['tender_cost_per_unit'];
        $tender->tender_unit   =  $data['tender_unit'];
        $tender->tender_city   =  $data['tender_city'];
        $tender->tender_pincode   =  $data['tender_pincode'];
        $tender->tender_warranty   =  $data['tender_warranty'];
        $tender->tender_warranty_type   =  $data['tender_warranty_type'];
        $tender->tender_type   =  'Offer';

        $expDays = $data['tender_expiry_days'];

        if(empty($data['tender_expiry_hour']) || $data['tender_expiry_hour'] == 0){
            $expDays = $data['tender_expiry_days']-1;
        }
        $addtime = "+$expDays day";
        if(!empty($data['tender_expiry_hour'])){
            $addtime .= '+'.$data['tender_expiry_hour'].' hour';
        }
        $tender->tender_expiry_date  =  date('Y-m-d H:i:s',strtotime($addtime));
        
        $deliverytype_cost = [];
        $key = 0;
        foreach ($data['delivery_type'] as $value) {
           # code...
            if(!empty($value)){
                $deliverytype_cost[$value] = $data['tender_delivery_type_cost'][$key];
            }
            $key++;
        }
        if(!empty($deliverytype_cost)){
            $tender->tender_delivery_type_cost = json_encode($deliverytype_cost);
        }
        */
        if($request->hasfile('tender_attachment'))
        {
            $document = $request->file('tender_attachment');
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $tender->tender_attachment = $imageName;

        }

        if($request->hasfile('tender_featured_image'))
        {

            $document = $request->file('tender_featured_image');
            $size = $document->getSize();
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $tender->tender_featured_image = $imageName;

        }
        if($request->hasfile('tender_slider_image'))
         {
            $sliderImages = json_decode($tender->tender_slider_images);
            foreach($request->file('tender_slider_image') as $image)
            {
                $size = $image->getSize();
                $imageName  = time()."_".$image->getClientOriginalName();
                $image->move(public_path().'/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }

            if(!empty($sliderImages)){
                $tender->tender_slider_images = json_encode($sliderImages);
            }
            
         }

         $tender->save();

        return redirect()->route('admin.tender.index')->withFlashSuccess('The material offer was successfully updated.');
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($materialId)
    {
        $post = MaterialPost::where('id',$materialId)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.marketplace.MaterialOffers')->withFlashSuccess(__('The material offer has been deleted successfully.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Property              $property
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete($propertyId)
    {
        $post = Property::where('id',$propertyId)->onlyTrashed()->first();
        if ($post != null) {
            $propertyImages = PropertyImage::where('property_id',$propertyId)->forceDelete();
            $post->forceDelete();
            return redirect()->route('admin.property.deleted')->withFlashSuccess(__('The property has been permanently deleted successfully.'));
        }
        return redirect()->back();

    }

    public function deleteimage($materialId, $imgKey)
    {
        $materialPost = MaterialPost::where('id',$materialId)->first();
        if ($materialPost != null) {
            $images = json_decode($materialPost->slider_images);
          
            if(!empty($images)){
                unset($images[$imgKey]);
            }
            $images = array_values($images);
            $materialPost->slider_images = json_encode($images);
            $materialPost->save();
            return redirect()->back()->withFlashSuccess(__('The slider image has been deleted successfully.'));
        }
        return redirect()->back()->withFlashSuccess(__('The material offer does not exist.'));

    }	
	
	public function bidListing($id)
	{	
		$workBid = MaterialBid::Where('material_post_id',$id)->paginate(10);	
		$materialData = MaterialPost::select('unit')->where('id',$id)->first();
		$bid_type = 'offer';		
		return view('backend.marketplace.material.bids')->with(['workBid'=>$workBid,'bid_type'=>$bid_type,'materialData'=>$materialData]);	
	}		
	public function bidDetail($id,$bidId)
	{		
		$workData = MaterialBid::where('id',$id)->first();	
		$materialData = MaterialPost::select('unit')->where('id',$bidId)->first();	
		$bid_type = 'offer';			
		return view('backend.marketplace.material.bid-detail')->with(['workData'=>$workData,'materialData'=>$materialData,'bid_type'=>$bid_type]);	
	}

}
