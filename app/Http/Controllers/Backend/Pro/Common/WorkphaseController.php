<?php

namespace App\Http\Controllers\Backend\Pro\Common;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
 
 
use App\Repositories\Backend\WorkphaseRepository;
use App\Models\BackendPro\Workphase;
use App\Models\BackendPro\WorkphaseLanguage;

use App\Models\BackendPro\Workarea;
use App\Models\BackendPro\WorkareaLanguage;

use App\Models\Languages;
use Session;
use config;
//use App\Models\Marketplace\MaterialBid;

/**
 * Class MaterialOfferController.
 */
class WorkphaseController extends Controller
{
    /**
     * @var WorkphaseController
     */
    protected $workphaseRepository;

    /**
     * WorkphaseController constructor.
     *
     * @param WorkphaseRepository $workphaseRepository
     */
    public function __construct(WorkphaseRepository $workphaseRepository)
    {
        parent::__construct();
        $this->workphaseRepository = $workphaseRepository;
        
    }   

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {  
        $area_id = $request->get('area_id');
         
        $default_pagination =  config('global_configurations.admin.pagination');
        
        $default_language =  config('global_configurations.admin.language');
        $language = Languages::where(['lang_code'=>$default_language])->first();
        $default_global_language = $language['id'];
        $workphase = $this->workphaseRepository->getPaginatedRecords($default_pagination, 'aw_identifier', 'asc',$default_global_language,$area_id,'');
        
        $workareadropdown = Workarea::select(['area_id','area_name'])
        ->join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->pluck('pro_area_lang.area_name','pro_area.area_id')->toArray(); 
      
        return view('backend.pro.common.workphase_listing')
        ->withWorkphase($workphase)->withLanguage($default_global_language)->withWorkarea($area_id)->withWorkareadropdown($workareadropdown);
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
          
            $area_id = $request->get('area_id'); 
             
            $query = str_replace(" ", "%", $query);
            $workphase = $this->workphaseRepository->getPaginatedRecords($default_pagination, 'aw_identifier', 'asc',$default_global_language,$area_id,$query);
            return view('backend.pro.common.workphase_listing_data', compact('workphase'))->render();
        }
        
    }

    /**
     * @param Request $request
     * @return mixed
     */
    function get_workarea_by_workphase(Request $request)
    {
         
        if($request->ajax())
        {
            
       
            $area_id = $request->get('area_id');
            $language = $request->get('language');
            
            $workphase = Workphase::select(['pro_area_work.aw_id','pro_area_work.aw_identifier'])
            //->join('pro_area_work_lang','pro_area_work_lang.aw_lang_aw_id','=','pro_area_work.aw_id')
            //->where('pro_area_work_lang.aw_lang_lang_id',  $language)
            ->where('aw_area_id',$area_id)
            ->pluck('pro_area_work.aw_identifier','pro_area_work.aw_id')->toArray();
         
            return $workphase;
        }
        
    }
    /**
     * @param Workphase $aw_id
     * @return mixed
     */


    public function getWorkphase($aw_id)
    {
        return Workphase::where('aw_id',$aw_id)->first();
    }

 


    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $language = Languages::get()->pluck('name','id')->toArray();
        //$country = WorkArea::select(['area_id','country_code'])->pluck('country_code','area_id'); 
        $workarea = WorkArea::select(['area_id','area_name'])
        ->join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->pluck('pro_area_lang.area_name','pro_area.area_id')->toArray(); 
        return view('backend.pro.common.workphase_create',
        [
            'request' => $request,
            'language' => $language ,
            'workarea' => $workarea 
             
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create_workphase_language(Request $request)
    {
        
        
        $language = Languages::get()->pluck('name','id')->toArray();
        
        $workarea = WorkArea::select(['area_id','area_name'])
        ->join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->pluck('pro_area_lang.area_name','pro_area.area_id')->toArray(); 
        $workphase = Workphase::select(['aw_id','aw_identifier'])->pluck('aw_identifier','aw_id');
        
        return view('backend.pro.common.workphase_create_language',
        [
            'request' => $request ,
            'language' => $language,
            'workarea' => $workarea,
            'workphase' => $workphase 
             
        ]);
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Workphase $workphase, WorkphaseLanguage $workphaseLanguage)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'aw_lang_aw_name'     => ['required','max:150'],
            'aw_identifier' => 'required',
            'aw_area_id' => 'required',
            'language' => 'required',
             
            
        ])->validate();
        
        if(isset($data['aw_id']) && $data['aw_id'] == 0){
            $workphase->aw_identifier =  $data['aw_identifier']; 
            $workphase->aw_status =  1;
            $workphase->aw_area_id =  $data['aw_area_id']; 
            $workphase->aw_identifier =  $data['aw_identifier']; 
            
            $workphase->save();
            $aw_id = $workphase->aw_id; 
         }else{
            $aw_id = $data['aw_identifier'];    
         }

           
         
         $language_id = $data['language'];
         $stateLanguageUpdate = $this->getWorkphaseByLanguage($aw_id,$language_id);
         if(isset($stateLanguageUpdate)){
             
            WorkphaseLanguage::where('aw_lang_aw_id',$aw_id)->where('aw_lang_lang_id',$language_id)->update(['aw_lang_aw_name'=>$data['aw_lang_aw_name'] ]);
         }else{
            $workphaseLanguage->aw_lang_aw_name =  $data['aw_lang_aw_name'];
            $workphaseLanguage->aw_lang_aw_id =  $aw_id; 
            $workphaseLanguage->aw_lang_lang_id =  $language_id; 
            $workphaseLanguage->save();
         }
          


        return redirect()->route('admin.workphase.index')->withFlashSuccess(__('alerts.backend.workphase.created'));
    }
  
    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$aw_id)
    { 
        $language_id = $request->get('language');
        $workphase = Workphase::join('pro_area_work_lang','pro_area_work_lang.aw_lang_aw_id','=','pro_area_work.aw_id')
        ->join('languages','languages.id','=','pro_area_work_lang.aw_lang_lang_id')
        ->select(['*'])->where(['pro_area_work_lang.aw_lang_aw_id' => $aw_id ,'pro_area_work_lang.aw_lang_lang_id'=> $language_id])->get();
 
        $language = Languages::get()->pluck('name','id')->toArray();
        $workarea = WorkArea::select(['area_id','area_name'])
        ->join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->pluck('pro_area_lang.area_name','pro_area.area_id')->toArray();
        return view('backend.pro.common.workphase_edit')
        ->withWorkphase($workphase)->withWorkarea($workarea)->withLanguage($language);
    }

    /**
     * @param Request $request
 
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $aw_id)
    {
        $data = $request->all();
        
         $validator = Validator::make($data, [
            'aw_lang_aw_name'     => ['required','max:150'],
            'aw_identifier' => 'required',
            'language' => 'required'
            
        ])->validate();
        
        $workphase = $this->getWorkphase($aw_id);
        $workphase->aw_id =  $aw_id;
        $workphase->aw_identifier =  $data['aw_identifier']; 
        $workphase->aw_area_id =  $data['aw_area_id']; 
        
        $workphase->aw_identifier =  $data['aw_identifier']; 
    
        $workphase->save();

        $language_id = $data['language'];
        $workphaseLanguage = $this->getWorkphaseByLanguage($aw_id,$language_id);
        if($workphaseLanguage){
            WorkphaseLanguage::where('aw_lang_aw_id',$aw_id)->where('aw_lang_lang_id',$language_id)->update(['aw_lang_aw_name'=>$data['aw_lang_aw_name'] ]);
        }    
        
        
     
 
        return redirect()->route('admin.workphase.index')->withFlashSuccess(__('alerts.backend.workphase.updated'));
    }

    
    public function getWorkphaseByLanguage($aw_id,$language_id)
    {
        return WorkphaseLanguage::where('aw_lang_aw_id',$aw_id)->where('aw_lang_lang_id',$language_id)->first();
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($aw_id)
    {
        $post = Workphase::where('aw_id',$aw_id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.workphase.index')->withFlashSuccess(__('alerts.backend.workphase.deleted'));
        }
        return redirect()->back();
    }

       

}
