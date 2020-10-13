<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Bussiness\Project;

class ProjectClosure extends Model
{
    use SoftDeletes;
    protected $table = 'pro_project_closure';

}
