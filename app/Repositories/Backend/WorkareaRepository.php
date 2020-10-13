<?php
namespace App\Repositories\Backend;

use App\Models\BackendPro\Workarea;
use App\Models\BackendPro\WorkareaLanguage;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Illuminate\Pagination\LengthAwarePaginator;


class WorkareaRepository extends BaseRepository
{
    /**
     * WorkareaRepository constructor.
     *
     * @param  Workarea  $model
     */
    public function __construct(Workarea $model)
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
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $Workarea_code='') : LengthAwarePaginator
    {
        return $this->model->with('allworkarea')
            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPaginatedRecords($paged = 25, $orderBy = 'created_at', $sort = 'desc',$language='' ,$query='') : LengthAwarePaginator
    {
        return $this->model->with('allworkarea')
        ->join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->join('languages','languages.id','=','pro_area_lang.area_lang_lang_id')
        ->where('pro_area_lang.area_lang_lang_id',  $language)
        //->where('Workarea_code', 'like', '%'.$query.'%')
        ->where('pro_area_lang.area_name', 'like', '%'.$query.'%')
        
        
       
        ->orderBy($orderBy, $sort)
        ->paginate($paged);
    }

    public function getWorkarea($area_id,$language_id) : LengthAwarePaginator
    {
        return $this->model->with('allworkarea')
        ->join('pro_area_lang','pro_area_lang.area_lang_area_id','=','pro_area.area_id')
        ->join('languages','languages.id','=','pro_area_lang.area_lang_lang_id')
        ->where('pro_area_lang.area_lang_area_id',  $area_id)
        ->where('pro_area_lang.area_lang_lang_id',  $language_id)->first();
 
    }

     
}