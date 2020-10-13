<?php
namespace App\Models;
namespace App\Models\BackendPro;

use Illuminate\Database\Eloquent\Model;


class Workarea extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_area';
    protected $primaryKey = 'area_id';
    public $timestamps = false;

    public function phases()
    {
        return $this->hasMany('App\Models\BackendPro\Workphase');
    }

    public function Workarea()
    {
        return $this->hasMany(WorkareaLanguage::class , 'area_lang_area_id', 'area_id');
    }

    public function allworkarea()
    {
        return $this->hasMany(WorkareaLanguage::class, 'area_lang_area_id', 'area_id');
    }

}
