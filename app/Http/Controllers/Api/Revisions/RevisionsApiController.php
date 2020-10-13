<?php

namespace App\Http\Controllers\Api\Revisions;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bussiness\Revisions;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\ProNotif;
use App\Http\Controllers\Api\Bids\BidsApiController;
use App\Models\Auth\ProUser;

class RevisionsApiController extends Controller
{
    protected function revisionCreate(Request $request, Revisions $revisions)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required',
            "propID" => 'required',
            "client" => 'required',
            "table_name" => 'required',
            "status" => 'required',
            "notifID" => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $revisions->user_id = auth()->user()->id;
        $revisions->propID     =  $data["propID"];
        $revisions->client     =  $data["user_id"];
        $revisions->table_name     =  $data["table_name"];
        $revisions->message     =  $data["message"];
        $revisions->status     =  $data["status"];


        $this->updateStatues($data["notifID"], 'pro_notifications', 1);

        $bidNotif = new BidsApiController();
        $proNotif = new ProNotif();

        $replacedString = str_replace("pro_", "", $data["table_name"]);
        $message = (($data["status"] == 2 ? 'accepted' : ($data["status"] == 3 ? 'declined' : ($data["status"] == 4 ? 'revision' : null))));

        $concatMsg = ($message == 'revision') ? $message . ': ' . $revisions->message : $message;

        $bidNotif->send_notif($proNotif, $data["user_id"], 1, $concatMsg, $data["propID"], $data["client"], $data["table_name"], $replacedString . '_' . $message);

        $this->updateStatues($data["propID"], $data["table_name"], $data["status"]);

        $revisions->save();
        return response()->json($revisions->id, 201);
    }

    public function updateStatues(...$args)
    {
        $retVal = ($args[1] === 'pro_notifications') ? rtrim($args[1], "s ") : $args[1];

        $replacedString = str_replace("pro_", "", $retVal);
        return DB::table($args[1])
            ->where($replacedString . '_id', $args[0])
            ->update([$replacedString . '_status' => $args[2]]);
    }

    protected function revisionGetMsgs($id, $table)
    {
        $msgs = Revisions::select('user_id', 'propID', 'client', 'message', 'status', 'created_at')->where([['propID', $id], ['table_name', $table]])->get();
        foreach ($msgs as $key => $value) {
            $msgs[$key]->user_name = ProUser::where('id', $value->user_id)->first('first_name')->first_name;
        }
        return response()->json(['data' =>  $msgs], 200);
    }
}
