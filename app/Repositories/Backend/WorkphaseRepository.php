<?php
namespace App\Repositories\Backend;

use App\Models\BackendPro\Workphase;
use App\Models\BackendPro\WorkphaseLanguage;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Illuminate\Pagination\LengthAwarePaginator;


class WorkphaseRepository extends BaseRepository
{
    /**
     * WorkphaseRepository constructor.
     *
     * @param  Workphase  $model
     */
    public function __construct(Workphase $model)
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
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $aw_identifier='') : LengthAwarePaginator
    {
        return $this->model->with('allworkphases')
            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPaginatedRecords($paged = 25, $orderBy = 'created_at', $sort = 'desc',$language='' ,$area_id='' ,$query='') : LengthAwarePaginator
    {   
        if($area_id ==''){
            return $this->model->with('allworkphases')
                ->join('pro_area_work_lang','pro_area_work_lang.aw_lang_aw_id','=','pro_area_work.aw_id')
                ->join('languages','languages.id','=','pro_area_work_lang.aw_lang_lang_id')
                ->where('pro_area_work_lang.aw_lang_lang_id',  $language)
 
                ->where('pro_area_work_lang.aw_lang_aw_name', 'like', '%'.$query.'%')
                ->orderBy($orderBy, $sort)
                ->paginate($paged);
        }else{
            return $this->model->with('allworkphases')
                ->join('pro_area_work_lang','pro_area_work_lang.aw_lang_aw_id','=','pro_area_work.aw_id')
                ->join('languages','languages.id','=','pro_area_work_lang.aw_lang_lang_id')
                ->where('pro_area_work_lang.aw_lang_lang_id',  $language)
                ->where('pro_area_work.aw_area_id',  $area_id)
                ->where('pro_area_work_lang.aw_lang_aw_name', 'like', '%'.$query.'%')
                ->orderBy($orderBy, $sort)
                ->paginate($paged);
        }
        
    }

    public function getWorkphase($aw_id,$language_id) : LengthAwarePaginator
    {
        return $this->model->with('allworkphases')
        ->join('pro_area_work_lang','pro_area_work_lang.aw_lang_aw_id','=','pro_area_work.aw_id')
        ->join('languages','languages.id','=','pro_area_work_lang.aw_lang_lang_id')
        ->where('pro_area_work_lang.aw_lang_aw_id',  $aw_id)
        ->where('pro_area_work_lang.aw_lang_lang_id',  $language_id)->first();
 
    }

     
}