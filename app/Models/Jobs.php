<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public $table = "jobs";

    public function JobLanguage()
    {
        return $this->hasMany('App\Models\JobsLanguage' , 'parent_id', 'id');
    }
    
    public function department()
    {
        return $this->hasOne('App\Models\JobDepartment' , 'department_id', 'departmentId');
    }
}
