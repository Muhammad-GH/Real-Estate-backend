<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTask extends Model
{
    use SoftDeletes;
    protected $table = 'pro_project_task';

    public function time()
    {
        return $this->hasMany('App\Models\Bussiness\ProjectTaskTime'  , 'project_task_id', 'id');
    }

    public function reporter()
    {
        return $this->hasOne('App\Models\Bussiness\Resources'  , 'id' ,'report_to');
    }

    public function childtask()
    {
        return $this->hasMany('App\Models\Bussiness\ProjectTask', 'parent_id', 'id');
    }

    public function allchildtask()
    {
        return $this->childtask()->with('allchildtask');
    }

    public function area()
    {
        return $this->hasOne('App\Models\Bussiness\Area', 'area_id', 'area_id');
        // return $this->hasMany('App\Models\Bussiness\Area', 'area_id', 'id');
    }


}
