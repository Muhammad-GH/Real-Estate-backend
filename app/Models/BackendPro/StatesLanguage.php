<?php
namespace App\Models\BackendPro;
use Illuminate\Database\Eloquent\Model;


class StatesLanguage extends Model
{
    // use SoftDeletes;
    protected $table = 'pro_states_lang';
    
    public $timestamps = false;

    public function states()
    {
        return $this->hasMany(States::class , 'state_id', 'statelang_state_id');
    }

}
