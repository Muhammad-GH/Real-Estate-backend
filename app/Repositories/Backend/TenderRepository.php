<?php
namespace App\Repositories\Backend;

use App\Models\BackendPro\Tender;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Illuminate\Pagination\LengthAwarePaginator;


class TenderRepository extends BaseRepository
{
    /**
     * TenderRepository constructor.
     *
     * @param  Tender  $model
     */
    public function __construct(Tender $model)
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

    public function getPaginatedRecords($paged = 25, $orderBy = 'created_at', $sort = 'desc',$tender_type = '' ,$tender_category_type = '' ,$query='') : LengthAwarePaginator
    {    
        if($tender_type != '' && $tender_category_type !=''){
            return $this->model->with('category')
            ->where('tender_type',$tender_type) 
            ->where('tender_category_type',$tender_category_type) 
            ->whereDate('tender_expiry_date', '>=', date('Y-m-d H:i:s'))
            ->where('tender_title', 'like', '%'.$query.'%')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
        }else if($tender_type == '' && $tender_category_type !=''){
            return $this->model->with('category')
             
            ->where('tender_category_type',$tender_category_type) 
            ->whereDate('tender_expiry_date', '>=', date('Y-m-d H:i:s'))
            ->where('tender_title', 'like', '%'.$query.'%')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
        }else if($tender_type != '' && $tender_category_type ==''){
            return $this->model->with('category')
            ->where('tender_type',$tender_type) 
            ->whereDate('tender_expiry_date', '>=', date('Y-m-d H:i:s'))
            ->where('tender_title', 'like', '%'.$query.'%')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
        }else{
            return $this->model->with('category')
            
            ->whereDate('tender_expiry_date', '>=', date('Y-m-d H:i:s'))
            ->where('tender_title', 'like', '%'.$query.'%')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
        }
        
        
        
    }


    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $tender_type='') : LengthAwarePaginator
    {
        return $this->model->with('category')
            ->where('tender_type',$tender_type) 
            ->whereDate('tender_expiry_date', '>=', date('Y-m-d H:i:s'))
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'asc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'asc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}