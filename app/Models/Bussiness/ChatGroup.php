<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\ProUser;

use App\Models\Business\ChatUserGroup;

class ChatGroup extends Model
{
    use SoftDeletes;
    protected $table = 'pro_chat_group';
 
    public function user()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'pro_user_id');
    } 
      
    public function group()
    {
        return $this->hasMany('App\Models\Bussiness\ChatUserGroup'  , 'cug_group_id', 'group_id');//->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
    }  
 
}
