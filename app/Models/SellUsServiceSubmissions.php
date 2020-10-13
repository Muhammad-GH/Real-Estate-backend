<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellUsServiceSubmissions extends Model
{
    public $table = "selltous_service_submission";
    public function ContactForm(){
    	return $this->hasOne('App\Models\SellUsService','service_id','contactformid');
    }
}