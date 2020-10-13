<?php

namespace App\Http\Controllers\Api\Phase;

use Validator;
use App\Models\Languages;
use Illuminate\Http\Request;
use App\Models\Bussiness\Area;
use App\Models\Bussiness\AreaWork;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bussiness\ProAreaLang;
use App\Models\Bussiness\ProAreaWorkLang;

class PhaseApiController extends Controller
{
    protected function areaCreate(Request $request, Area $area)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'area_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $area->user_id = auth()->user()->id;
        $area->area_identifier     =  $data["area_name"];
        $area->area_status     =  1;

        $area->save();

        if ($area->id > 0) {
            $lang = Languages::get();
            foreach ($lang as $key => $value) {
                $proarealang = new ProAreaLang();

                $proarealang->area_lang_area_id = $area->id;
                $proarealang->area_lang_lang_id = $value->id;
                $proarealang->area_name     =  $area->area_identifier;
                $proarealang->save();
            }

            return response()->json(['data' => 'created'], 201);
        } else {
            return response()->json(['error' => 'Some error occured'], 406);
        }
    }

    protected function areaList($lng)
    {
        $lang = Languages::where('lang_code', $lng)->first('id');
        $area = Area::where([['user_id', auth()->user()->id], ['area_status', 1]])->get();
        foreach ($area as $key => $value) {
            $area_lang =  ProAreaLang::where([['area_lang_area_id', $value->area_id], ['area_lang_lang_id', $lang->id]])->get();
            if ($area_lang->count() > 0) {
                $area[$key]->area_id = $area_lang[0]->area_lang_area_id;
                $area[$key]->area_identifier = $area_lang[0]->area_name;
            } else {
                unset($area[$key]->area_id, $area[$key]->area_identifier);
            }
        }
        return response()->json(['data' => $area], 200);
    }

    protected function workList($lng)
    {
        $lang = Languages::where('lang_code', $lng)->first('id');
        $area = Area::where([['user_id', auth()->user()->id], ['area_status', 1]])->get();
        $data = [];
        foreach ($area as $key => $value) {
            $area_work =  AreaWork::where([['aw_area_id', $value->area_id], ['aw_status', 1]])->get();
            if ($area_work->count() > 0) {
                $data[$key]['area_identifier'] = $value->area_identifier;
                $data[$key]['aw_area_id'] = $area_work[0]->aw_area_id;
                $data[$key]['aw_id'] = $area_work[0]->aw_id;
                $data[$key]['aw_identifier'] = $area_work[0]->aw_identifier;
            }
        }
        return response()->json(['data' => $data], 200);
    }

    protected function workDelete($id)
    {
        $record = DB::delete('delete from pro_area where area_id = ?', [$id]);
        return response()->json($record, 200);
    }

    protected function workEdit($id)
    {
        $record = DB::table('pro_area_work')
            ->join('pro_area', 'pro_area_work.aw_area_id', '=', 'pro_area.area_id')
            ->select('pro_area_work.*', 'pro_area.*')
            ->where([['aw_id', $id]])
            ->get();
        return response()->json(['data' => $record], 200);
    }

    protected function areaUpdate(Request $request, $id)
    {
        ProAreaLang::where([['area_lang_area_id', $id]])->update(['area_name' => $request->all()["area_identifier"]]);
        $record = Area::where([['area_id', $id]])->update(['area_identifier' => $request->all()["area_identifier"]]);
        return response()->json(['data' => $record], 200);
    }

    protected function workUpdate(Request $request, $id)
    {
        ProAreaWorkLang::where([['aw_lang_aw_id', $id]])->update(['aw_lang_aw_name' => $request->all()["aw_identifier"]]);
        $record = AreaWork::where([['aw_id', $id]])->update(['aw_identifier' => $request->all()["aw_identifier"]]);
        return response()->json(['data' => $record], 200);
    }

    protected function workCreate(Request $request, AreaWork $areaWork)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'aw_area_id' => 'required',
            'aw_identifier' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $areaWork->aw_area_id     =  $data["aw_area_id"];
        $areaWork->aw_identifier     =  $data["aw_identifier"];
        $areaWork->aw_status     =  1;

        $areaWork->save();

        if ($areaWork->id > 0) {
            $lang = Languages::get();
            foreach ($lang as $key => $value) {
                $proareaworklang = new ProAreaWorkLang();

                $proareaworklang->aw_lang_aw_id = $areaWork->id;
                $proareaworklang->aw_lang_lang_id = $value->id;
                $proareaworklang->aw_lang_aw_name     =  $areaWork->aw_identifier;
                $proareaworklang->save();
            }

            return response()->json(['data' => 'created'], 201);
        } else {
            return response()->json(['error' => 'Some error occured'], 406);
        }
    }
}
