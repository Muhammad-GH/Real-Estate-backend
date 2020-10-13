<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\BlogCategory;

class BlogLanguage extends Model
{

    use SoftDeletes;
    protected $table = 'blog_language';

    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory' , 'id', 'blog_category_id');
    }
}
