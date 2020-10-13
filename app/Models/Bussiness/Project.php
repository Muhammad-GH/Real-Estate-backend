<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\ProUser;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'pro_project';

    public function resource()
    {
        return $this->hasOne('App\Models\Bussiness\Resources' , 'id', 'pro_resource_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'pro_user_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Bussiness\ProjectTask'  , 'project_id', 'id')->orderBy('parent_id', 'ASC')->orderBy('task_order', 'ASC');
        
    }

    public function agreement()
    {
        return $this->hasOne('App\Models\Bussiness\Agreement'  , 'agreement_id', 'aggrement_id')->orderBy('agreement_id', 'ASC');
        
    }
    
    public function proposal()
    {
        return $this->hasOne('App\Models\Bussiness\Proposal'  , 'proposal_id', 'proposal_id')->orderBy('proposal_id', 'ASC');
        
    }

    public function summarytasks()
    {
        return $this->hasMany('App\Models\Bussiness\ProjectTask'  , 'project_id', 'id')->orderBy('start_date', 'ASC');
        
    }
    
    public function taskresource()
    {
        return $this->hasmanyThrough(
        'App\Models\Bussiness\Resources' ,
        'App\Models\Bussiness\ProjectTask'  ,
         'project_id', 'id', 'id', 'assignee_to')->select( 'pro_project_task.*', 'pro_resources.first_name as first_name', 'pro_resources.last_name as last_name')->orderBy('start_date', 'ASC');
        
    }
    public function tasktime()
    {
        return $this->hasManyThrough(
            'App\Models\Bussiness\ProjectTask' ,     
        'App\Models\Bussiness\ProjectTaskTime', 'project_id', 'id',  'id', 'project_task_id')->select( 'pro_project_task_time.*');
        
    } 
    

    public function taskscreatedbyresource()
    {
        return $this->hasMany('App\Models\Bussiness\ProjectTask'  , 'project_id', 'id')->where('pro_resource_id','=',auth()->guard('proresource')->user()->id)->orderBy('parent_id', 'ASC')->orderBy('task_order', 'ASC');
        
    }
}
