<?php

namespace App\Http\Controllers\Api\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Marketplace\ProConfig;
use Validator;
use DB;

class ConfigApiController extends Controller
{
    protected function index()
    {
        $data = ProConfig::get();
        return response()->json(["data" => $data], 200);
    }

    protected function lang()
    {
        $data = ProConfig::where('configuration_name', 'language_pro')->get();
        return response()->json(["data" => $data], 200);
    }

    protected function fee()
    {
        $data = ProConfig::where('configuration_name', 'site_service_fee')->get();
        return response()->json(["data" => $data], 200);
    }

    protected function currency()
    {
        $left = config('global_configurations.admin.left_currency_symbol');
        $right = config('global_configurations.admin.right_currency_symbol');

        $currency = array();    // create array
        $currency['left'] = $left;   // add first object
        $currency['right'] = $right;  // add second object

        return response()->json($currency, 200);
    }
}
