<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;


class WorkareaLanguage extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_area_lang';
    
    public $timestamps = false;

    public function Workarea()
    {
        return $this->hasMany(Workarea::class , 'area_id', 'area_lang_area_id');
    }

}
