<?php

namespace App\Http\Controllers\Backend\Pro\Common;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
 
use App\Repositories\Backend\WorkareaRepository;
use App\Models\BackendPro\Workarea;

use App\Models\BackendPro\WorkareaLanguage;
use App\Models\Languages;
use Session;
use config;
//use App\Models\Marketplace\MaterialBid;

/**
 * Class MaterialOfferController.
 */
class WorkareaController extends Controller
{
    /**
     * @var WorkareaController
     */
    protected $WorkareaRepository;

    /**
     * WorkareaController constructor.
     *
     * @param WorkareaRepository $WorkareaRepository
     */
    public function __construct(WorkareaRepository $WorkareaRepository)
    {
        parent::__construct();
        $this->WorkareaRepository = $WorkareaRepository;
        
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
        $Workarea = $this->WorkareaRepository->getPaginatedRecords($default_pagination, 'area_identifier', 'asc',$default_global_language,'');
         
        //$Workarea = WorkareaLanguage::select('area_name','area_lang_area_id')->where(['area_lang_lang_id'=>$default_global_language])->pluck();
        return view('backend.pro.common.workarea_listing')
        ->withWorkarea($Workarea)->withLanguage($default_global_language);
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
            $workarea = $this->WorkareaRepository->getPaginatedRecords($default_pagination, 'area_identifier', 'asc',$default_global_language,$query);
             
            return view('backend.pro.common.workarea_listing_data', compact('workarea'))->render();
        }
        
    }

    public function getWorkarea($area_id)
    {
        return Workarea::where('area_id',$area_id)->first();
    }

 


    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $language = Languages::get()->pluck('name','id')->toArray();
        $area_identifier = Workarea::select(['area_id','area_identifier'])->pluck('area_identifier','area_id'); 
        return view('backend.pro.common.workarea_create',
        [
            'request' => $request ,
            'language' => $language ,
            'area_identifier' => $area_identifier 
             
        ]);
    }

    
    /**
     * @param Request $request
     * @return mixed
     */
    public function create_Workarea_language(Request $request)
    {
        
        $language = Languages::get()->pluck('name','id')->toArray();
        $area_identifier = Workarea::select(['area_id','area_identifier'])->pluck('area_identifier','area_id'); 
        return view('backend.pro.common.workarea_create_language',
        [
            'request' => $request ,
             
            'language' => $language ,
            'area_identifier' => $area_identifier 
             
        ]);
    }
    

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Workarea $Workarea, WorkareaLanguage $WorkareaLanguage)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'area_name'     => ['required','max:150'],
            'language' => 'required',
             
            
        ])->validate();
        if(isset($data['area_id'])){
            $area_id = $data['area_id']; 
        }
        

         if(isset($data['area_id']) && $data['area_id'] == 0){
            $Workarea->area_identifier =  $data['area_name']; 
            $Workarea->area_status =  1;
            $Workarea->save();
            $area_id = $Workarea->area_id;   
         } 
        

        
 
         $language_id = $data['language'];
         $WorkareaLanguageUpdate = $this->getWorkareaByLanguage($area_id,$language_id);
         if(isset($WorkareaLanguageUpdate)){
            //$WorkareaLanguage = $WorkareaLanguageUpdate;
            WorkareaLanguage::where('area_lang_area_id',$area_id)->where('area_lang_lang_id',$language_id)->update(['area_name'=>$data['area_name'] ]);
         }else{
            $WorkareaLanguage->area_name =  $data['area_name'];
            $WorkareaLanguage->area_lang_area_id =  $area_id; 
            $WorkareaLanguage->area_lang_lang_id =  $language_id; 
            $WorkareaLanguage->save();
         }

         

        return redirect()->route('admin.workarea.index')->withFlashSuccess(__('alerts.backend.workarea.created'));
    }
 
    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$area_id)
    { 
        $language = Languages::get()->pluck('name','id')->toArray();
        $language_id = $request->get('language');
        $Workarea = Workarea::join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->join('languages','languages.id','=','pro_area_lang.area_lang_lang_id')
        ->select(['*'])->where(['pro_area_lang.area_lang_area_id' => $area_id ,'pro_area_lang.area_lang_lang_id'=> $language_id])->get();
        //print_r($Workarea);die;
        $area_identifier = Workarea::select(['area_id','area_identifier'])->pluck('area_identifier','area_id'); 
        return view('backend.pro.common.workarea_edit')
        ->withWorkarea($Workarea)->withWorkareaCode($area_identifier)->withLanguage($language);
    }

    /**
     * @param Request $request
 
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $area_id)
    {
        $data = $request->all();
        
         $validator = Validator::make($data, [
            'area_name'     => ['required','max:150'],
            'area_identifier' => 'required',
            'language' => 'required'
            
        ])->validate();
        
        $Workarea = $this->getWorkarea($area_id);
        $Workarea->area_identifier =  $data['area_identifier']; 
        $Workarea->save();

        $language_id = $data['language'];
        $WorkareaLanguage = $this->getWorkareaByLanguage($area_id,$language_id);
         
        if($WorkareaLanguage){
            WorkareaLanguage::where('area_lang_area_id',$area_id)->where('area_lang_lang_id',$language_id)->update(['area_name'=>$data['area_name'] ]);
        }

     

        return redirect()->route('admin.workarea.index')->withFlashSuccess(__('alerts.backend.workarea.updated'));
    }

    
    public function getWorkareaByLanguage($area_id,$language_id)
    {
        return WorkareaLanguage::where('area_lang_area_id',$area_id)->where('area_lang_lang_id',$language_id)->first();
    }

 

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($area_id)
    {
        $post = Workarea::where('area_id',$area_id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.workarea.index')->withFlashSuccess(__('alerts.backend.workarea.deleted'));
        }
        return redirect()->back();
    }

       

}
