<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTaskTemplate extends Model
{
    use SoftDeletes;
    protected $table = 'pro_project_task_template';

    
    public function childtask()
    {
        return $this->hasMany('App\Models\Bussiness\ProjectTaskTemplate', 'parent_id', 'id');
    }

    public function allchildtask()
    {
        return $this->childtask()->with('allchildtask');
    }


}
