<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\ChatGroup;
use App\Models\Auth\ProUser;
use App\Models\Business\Resources;

use App\Models\Business\ChatMessages;

class ChatUserGroup extends Model
{
    use SoftDeletes;
    protected $table = 'pro_chat_user_group';
 
    public function user()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'cug_pro_user_id');
    }  
    public function resource()
    {
        return $this->hasOne('App\Models\Bussiness\Resources'  , 'id', 'cug_resource_id');
    }  
    public function group()
    {
        return $this->hasMany('App\Models\Bussiness\ChatGroup'  , 'group_id', 'cug_group_id');//->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
    }   
    public function messages()
    {
        //return $this->hasMany('App\Models\Bussiness\ChatMessages'  , 'message_group_id', 'cug_group_id');
        return $this->hasManyThrough(
            'App\Models\Bussiness\ChatMessages' ,
            'App\Models\Auth\ProUser'  )->select( 'pro_chat_messages.*', 'pro_users.*');
            
    } 
 
}
