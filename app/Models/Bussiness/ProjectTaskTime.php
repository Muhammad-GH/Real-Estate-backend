<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTaskTime extends Model
{
    use SoftDeletes;
    protected $table = 'pro_project_task_time';

    public function resource_time()
    {
        return $this->hasOne('App\Models\Bussiness\Resources' , 'id', 'pro_resource_id	');
    }

    public function user_time()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'pro_user_id');
    }

}
