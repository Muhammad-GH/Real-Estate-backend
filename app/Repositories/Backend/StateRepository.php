<?php
namespace App\Repositories\Backend;

use App\Models\BackendPro\States;
use App\Models\BackendPro\StateLanguage;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Illuminate\Pagination\LengthAwarePaginator;


class StateRepository extends BaseRepository
{
    /**
     * StateRepository constructor.
     *
     * @param  State  $model
     */
    public function __construct(States $model)
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
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $state_code='') : LengthAwarePaginator
    {
        return $this->model->with('allstates')
            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPaginatedRecords($paged = 25, $orderBy = 'created_at', $sort = 'desc',$language='' ,$country_id='' ,$query='') : LengthAwarePaginator
    {   
        if($country_id ==''){
            return $this->model->with('allstates')
                ->join('pro_states_lang','pro_states_lang.statelang_state_id','=','pro_states.state_id')
                ->join('languages','languages.id','=','pro_states_lang.statelang_lang_id')
                ->where('pro_states_lang.statelang_lang_id',  $language)
//                ->where('pro_states.state_country_id',  $country_id)
                ->where('pro_states_lang.state_name', 'like', '%'.$query.'%')
                ->orderBy($orderBy, $sort)
                ->paginate($paged);
        }else{
            return $this->model->with('allstates')
                ->join('pro_states_lang','pro_states_lang.statelang_state_id','=','pro_states.state_id')
                ->join('languages','languages.id','=','pro_states_lang.statelang_lang_id')
                ->where('pro_states_lang.statelang_lang_id',  $language)
                ->where('pro_states.state_country_id',  $country_id)
                ->where('pro_states_lang.state_name', 'like', '%'.$query.'%')
                ->orderBy($orderBy, $sort)
                ->paginate($paged);
        }
        
    }

    public function getStates($state_id,$language_id) : LengthAwarePaginator
    {
        return $this->model->with('allstates')
        ->join('pro_states_lang','pro_states_lang.statelang_state_id','=','pro_states.state_id')
        ->join('languages','languages.id','=','pro_states_lang.statelang_lang_id')
        ->where('pro_states_lang.statelang_state_id',  $state_id)
        ->where('pro_states_lang.statelang_lang_id',  $language_id)->first();
 
    }

     
}