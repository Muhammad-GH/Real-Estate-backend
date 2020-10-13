<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\ProUser;

class ChatMessages extends Model
{
    use SoftDeletes;
    protected $table = 'pro_chat_messages';
 
    public function user()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'pro_user_id');
    } 
 
}
