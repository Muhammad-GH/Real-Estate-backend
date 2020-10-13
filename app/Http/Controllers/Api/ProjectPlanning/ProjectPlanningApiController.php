<?php

namespace App\Http\Controllers\Api\ProjectPlanning;

use View;
use Validator;
use App\Models\Auth\User;
use App\Models\Languages;
use Illuminate\Http\Request;
use App\Models\Bussiness\ProArea;
use App\Models\Bussiness\ProPhase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Bussiness\ProAreaLang;
use App\Models\Bussiness\ProjectPlan;
use App\Models\Bussiness\ProAreaWorkLang;

class ProjectPlanningApiController extends Controller
{
    protected function planGet($type)
    {
        if ($type == 'Work' || $type == 'Material') {
            return response()->json(['data' => ProjectPlan::where([['type', $type]])->get()], 200);
        }
        return response()->json(['data' => ProjectPlan::get()], 200);
    }

    protected function planGetByName($name)
    {
        $phase = ProjectPlan::where([['template_name', $name], ['user_id', auth()->user()->id]])->first();
        return response()->json($phase, 200);
    }

    protected function planDelete($id)
    {
        // Deleting specific record
        $fill =  ProjectPlan::find($id);

        $retVal = (is_null($fill)) ?
            response()->json(['data' => 'Record not found'], 404) : [$fill->delete()];

        return $retVal;
    }

    protected function GetNames($type)
    {
        if ($type == 'Work' || $type == 'Material') {
            return response()->json(['data' => ProjectPlan::select('template_name')->where([['type', $type], ['user_id', auth()->user()->id], ['seperate', 0]])->get()], 200);
        }
        return response()->json(['data' => ProjectPlan::select('template_name')->where([['user_id', auth()->user()->id], ['seperate', 0]])->get()], 200);
    }

    protected function planInsert(Request $request, ProjectPlan $plan)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'items'     => 'required',
            'est_time' => 'required',
            'sub_total'   => 'required',
            'tax'    => 'required',
            'profit'   => 'required',
            'tax_calc'    => 'required',
            'profit_calc'   => 'required',
            'items_cost'   => 'required',
            'template_name'   => 'required',
            'total'   => 'required',
            'type'   => 'required',
        ]);
        if ($data['template_name'] == '') {
            return response()->json(['error' => "Template name cannot be empty"], 406);
        }
        if ($data['type'] == '') {
            return response()->json(['error' => "Type cannot be empty"], 406);
        }
        if ($data['items'] == "[]") {
            return response()->json(['error' => "Items cannot be empty"], 406);
        }

        $plan->user_id =  auth()->user()->id;
        $plan->items     =  $data['items'];
        $plan->est_time  =  $data['est_time'];
        $plan->sub_total =  $data['sub_total'];
        $plan->tax       =  $data['tax'];
        $plan->profit    =  $data['profit'];
        $plan->tax_calc       =  $data['tax_calc'];
        $plan->profit_calc    =  $data['profit_calc'];
        $plan->items_cost =  $data['items_cost'];
        $plan->template_name   =  str_replace(' ', '-', $data['template_name']);;
        $plan->total     =  $data['total'];
        $plan->type     =  $data['type'];
        $plan->seperate     =  $data['seperate'];

        if (ProjectPlan::where('template_name', '=', $plan->template_name)->exists()) {
            return response()->json(['error' => "Template with same name exists"], 406);
        }
        $plan->save();
        return response()->json($plan->id, 201);
    }

    protected function planUpdate(Request $request, $name)
    {
        $total = preg_replace("/[^0-9]/", "", $request->all()["total"]);
        $data = [
            'items' => $request->all()["items"],
            'est_time' => $request->all()["est_time"],
            'sub_total' => $request->all()["sub_total"],
            "tax" => $request->all()["tax"],
            "profit" => $request->all()["profit"],
            "items_cost" => $request->all()["items_cost"],
            "total" => $total,
            "tax_calc" => $request->all()["tax_calc"],
            "profit_calc" => $request->all()["profit_calc"]
        ];
        $upd = ProjectPlan::where('template_name', $name)->update($data);
        if ($upd === 1) {
            return response()->json(['data' => "updated"], 200);
        }
        return response()->json(['data' => 'Not Found'], 404);
    }

    protected function getArea($lng)
    {
        $lang = Languages::where('lang_code', $lng)->first('id');
        $area = ProArea::select('area_id', 'area_identifier')->where('area_status', 1)->get();
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

    protected function getPhaseById($id, $lng)
    {
        $lang = Languages::where('lang_code', $lng)->first('id');
        $phase = ProPhase::where([['aw_status', 1], ['aw_area_id', $id]])->get();
        foreach ($phase as $key => $value) {
            $area_lang =  ProAreaWorkLang::where([['aw_lang_aw_id', $value->aw_id], ['aw_lang_lang_id', $lang->id]])->get();
            if ($area_lang->count() > 0) {
                $phase[$key]->aw_id = $area_lang[0]->aw_lang_aw_id;
                $phase[$key]->aw_identifier = $area_lang[0]->aw_lang_aw_name;
            } else {
                unset($phase[$key]->aw_id, $phase[$key]->aw_identifier);
            }
        }
        return response()->json($phase, 200);
    }
}
