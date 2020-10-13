<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    public $table = "pro_category";
    protected $primaryKey = 'category_id';
    
    // public function categories()
    //  {
    //     return $this->hasMany('App\Models\BackendPro\Category' , 'category_parent_id', 'category_id');
    // }

     
    public function categories()
    {
        //return $this->hasMany(Category::class, 'category_parent_id', 'category_id');
        return $this->hasMany(Category::class, 'category_parent_id', 'category_id');
        //return $this->hasMany(Category::class, 'category_parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'category_parent_id', 'category_id')->with('categories');
        //return $this->hasMany(Category::class, 'category_parent_id')->with('categories');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'category_parent_id', 'category_id');
    }
     
}