<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Property;

class ContactUs extends Model
{
    use SoftDeletes;
    protected $table = 'contact_us';
    
    public function property()
    {
        $relation = $this->belongsTo('App\Models\Property' , 'property_id', 'id');
        return $relation;
    }

}
