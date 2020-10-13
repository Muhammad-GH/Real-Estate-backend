<?php

namespace App\Models\BackendPro;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    public $table = "pro_states";
    protected $primaryKey = 'state_id';
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo('App\Models\BackendPro\Country');
    }

    public function states()
    {
        return $this->hasMany(StatesLanguage::class, 'statelang_state_id', 'state_id');
    }

    public function allstates()
    {
        return $this->hasMany(StatesLanguage::class, 'statelang_state_id', 'state_id');
    }
}
