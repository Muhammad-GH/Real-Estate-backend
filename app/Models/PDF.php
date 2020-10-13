<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PDF extends Model
{
    use SoftDeletes;
    protected $table = 'form_pdf';

}
