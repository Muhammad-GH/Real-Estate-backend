<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomsData extends Model
{
    protected $table = 'rooms_data';
    public function room()
    {
        return $this->hasOne('App\Models\Rooms' , 'id', 'room_id');
    }
}
