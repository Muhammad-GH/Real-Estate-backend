<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;

class ProjectPlan extends Model
{
    protected $table = 'pro_projectplanning';
    protected $fillable = [
        'items',
        'est_time',
        'sub_total',
        'tax',
        'profit',
        'tax_calc',
        'profit_calc',
        'items_cost',
        'total',
        'type',
    ];
}
