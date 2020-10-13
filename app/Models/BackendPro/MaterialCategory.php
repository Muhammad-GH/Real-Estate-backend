<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;
class MaterialCategory extends Model
{
    public $table = "material_category";
    protected $primaryKey = 'mc_id';
    public $timestamps = false;
 
     
    public function categories()
    {
         
        return $this->hasMany(MaterialCategory::class, 'mc_parent_id', 'mc_id');
         
    }

    public function childrenCategories()
    {
        return $this->hasMany(MaterialCategory::class, 'mc_parent_id', 'mc_id')->with('categories');
         
    }

    public function category()
    {
        return $this->hasMany(MaterialCategory::class, 'mc_parent_id', 'mc_id');
    }
     
}