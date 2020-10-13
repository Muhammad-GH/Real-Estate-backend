<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Blog;

class BlogCategory extends Model
{
    use SoftDeletes;
    protected $table = 'blog_category';

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog' , 'blog_category_id', 'id');
    }

}
