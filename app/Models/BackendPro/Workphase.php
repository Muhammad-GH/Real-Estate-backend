<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;
class Workphase extends Model
{
    public $table = "pro_area_work";
    protected $primaryKey = 'aw_id';
    public $timestamps = false;

    public function workarea()
    {
        return $this->belongsTo('App\Models\BackendPro\Workarea');
    }

    public function workphases()
    {
        return $this->hasMany(WorkphaseLanguage::class , 'aw_lang_aw_id', 'aw_id');
    }

    public function allworkphases()
    {
        return $this->hasMany(WorkphaseLanguage::class, 'aw_lang_aw_id', 'aw_id');
    }
     
}