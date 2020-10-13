<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    public $table = "pages";

    public function pageLanguage()
    {
        return $this->hasOne('App\Models\PagesLanguage' , 'parent_id', 'id');
    }
}
