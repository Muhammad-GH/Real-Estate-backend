<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;
class Tender extends Model
{
    public $table = "pro_tender";
    protected $primaryKey = 'tender_id';
    
 
     
    public function category()
    {
        $relation = $this->hasOne('App\Models\BackendPro\Category' , 'category_id', 'tender_category_id');
        
        return $relation;
    }

     
     
}