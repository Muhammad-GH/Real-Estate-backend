<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;


class WorkphaseLanguage extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_area_work_lang';
    
    public $timestamps = false;

    public function workphases()
    {
        return $this->hasMany(Workphase::class , 'aw_id', 'aw_lang_aw_id');
    }

}
