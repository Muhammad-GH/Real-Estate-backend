<?php

namespace App\Http\Controllers\Api\Feeds;

use DB;
use Validator;
use App\Models\Languages;
use Illuminate\Http\Request;
use App\Models\BackendPro\City;
use App\Models\BackendPro\States;
use App\Models\BackendPro\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Marketplace\ProConfig;
use App\Models\Marketplace\ProTender;
use App\Models\BackendPro\CityLanguage;
use App\Models\BackendPro\StatesLanguage;
use ParagonIE\Sodium\Core\Poly1305\State;
use App\Models\Marketplace\FavouriteTender;

class FeedsApiController extends Controller
{
    protected function index()
    {
        $data = ProTender::select(
            'tender_id as id',
            'tender_title as title',
            'tender_description as description',
            'tender_city as city',
            'tender_category_type as category_type',
            'tender_category_id as category_id',
            'tender_type as type',
            'tender_cost_per_unit as cost_per_unit',
            'tender_budget as budget',
            'tender_unit as unit',
            'tender_quantity as quantity',
            'tender_rate as rate',
            'extra',
            'tender_featured_image as featured_image',
            'tender_expiry_date as time_left'
        )->latest()->get();
        foreach ($data as $key => $value) {
            $cat = DB::table('pro_category')->where('category_id', $value->category_id)->select('category_name')->get();
            $data[$key]->category = $cat[0]->category_name;
            $data[$key]->time_left = mb_substr($data[$key]->time_left, 0, 24);
        }
        return response()->json(["data" => $data, "count" => count($data)], 200);
    }

    // 
    protected function saved()
    {
        $data = FavouriteTender::where('uft_users_id', Auth::user()->id)->get();
        $saved = [];
        foreach ($data as $key => $value) {
            $data2[] = ProTender::where('tender_id', $value->uft_tender_id)->get();
            $saved = $data2;
        }
        return response()->json(['data' => $saved, 'count' => count($saved)], 200);
    }

    protected function icons()
    {
        $data = collect(FavouriteTender::where('uft_users_id', Auth::user()->id)->get('uft_tender_id'));
        $unique = $data->unique();
        return response()->json(['data' => $unique], 200);
    }

    // 
    protected function category()
    {
        $data = Category::get();
        return response()->json(['data' => $data], 200);
    }
    // 
    protected function state($lng)
    {
        $lang = Languages::where('lang_code', $lng)->first('id');
        $config = ProConfig::select('configuration_name', 'configuration_val')->where('configuration_name', 'default_country')->first();
        $states = States::where([['state_country_id', $config->configuration_val]])->select(array('state_identifier', 'state_id'))
            ->get();
        foreach ($states as $key => $value) {
            $state_lang =  StatesLanguage::where([['statelang_state_id', $value->state_id], ['statelang_lang_id', $lang->id]])->get();
            if ($state_lang->count() > 0) {
                $states[$key]->state_identifier = $state_lang[0]->state_name;
                $states[$key]->state_id = $state_lang[0]->statelang_state_id;
            } else {
                unset($states[$key]->state_identifier, $states[$key]->state_id);
            }
        }
        return response()->json(['data' => $states], 200);
    }

    protected function cityById($id, $lng)
    {
        $lang = Languages::where('lang_code', $lng)->first('id');
        $config = City::where('city_state_id', $id)->get();
        foreach ($config as $key => $value) {
            $city_lang =  CityLanguage::where([['citylang_city_id', $value->city_id], ['citylang_lang_id', $lang->id]])->get();
            if ($city_lang->count() > 0) {
                $config[$key]->city_id = $city_lang[0]->citylang_city_id;
                $config[$key]->city_identifier = $city_lang[0]->city_name;
            } else {
                unset($config[$key]->city_id, $config[$key]->city_identifier);
            }
        }
        return response()->json(['data' => $config], 200);
    }

    // 
    protected function saved_add(Request $request, FavouriteTender $saved_tender)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'uft_tender_id'   => 'required|numeric',

        ])->validate();

        $saved_tender->uft_users_id     =  Auth::user()->id;
        $saved_tender->uft_tender_id     =  $data['uft_tender_id'];
        $saved_tender->save();

        return response()->json($saved_tender, 201);
    }

    protected function saved_remove($id)
    {
        //
        $whereArray = array('uft_tender_id' => $id, 'uft_users_id' => Auth::user()->id);
        $query = DB::table('pro_users_favourite_tender');
        foreach ($whereArray as $field => $value) {
            $query->where($field, $value);
        }
        if ($query->delete() === 0) {
            return response()->json(["message" => "Not found"], 404);
        }
        return response()->json(null, 204);
    }
}
