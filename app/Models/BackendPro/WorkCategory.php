<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;
class WorkCategory extends Model
{
    public $table = "work_category";
    protected $primaryKey = 'wc_id';
    public $timestamps = false;
 
     
    public function categories()
    {
         
        return $this->hasMany(WorkCategory::class, 'wc_parent_id', 'wc_id');
         
    }

    public function childrenCategories()
    {
        return $this->hasMany(WorkCategory::class, 'wc_parent_id', 'wc_id')->with('categories');
         
    }

    public function category()
    {
        return $this->hasMany(WorkCategory::class, 'wc_parent_id', 'wc_id');
    }
     
}