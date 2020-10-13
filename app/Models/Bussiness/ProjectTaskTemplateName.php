<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTaskTemplateName extends Model
{
    use SoftDeletes;
    protected $table = 'pro_project_task_template_name';


}
