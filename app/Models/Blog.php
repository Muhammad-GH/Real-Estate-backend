<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\BlogCategory;

class Blog extends Model
{

    use SoftDeletes;
    protected $table = 'blog';

    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory' , 'id', 'blog_category_id');
    }
}
