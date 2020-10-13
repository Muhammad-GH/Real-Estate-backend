<?php

namespace App\Http\Controllers\Api\Bids;

use Validator;
use App\Models\Auth\ProUser;
use Illuminate\Http\Request;
use App\Models\Marketplace\ProBid;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\ProNotif;
use Illuminate\Support\Facades\Auth;
use App\Models\Marketplace\ProTender;

class BidsApiController extends Controller
{
    public function index(Request $request, ProBid $bid)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'tb_tender_id' => 'required',
            'tb_description' => 'required',
            'tb_quote' => 'required',
            'tb_quantity' => 'required',
            'tb_city_id' => 'required',
            'tb_delivery_type' => 'required',
            'tb_delivery_charges' => 'required',
            'tb_warrenty' => 'required',
            'tb_warrenty_type' => 'required',
            'attachment' => 'mimes:doc,docx,pdf,zip,jpeg,png,jpg,gif,svg|max:2048',
            // 'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $bid->tb_user_id     =  Auth::user()->id;
        $bid->tb_tender_id     =  $data['tb_tender_id'];
        $bid->tb_description     =  $data['tb_description'];
        $bid->tb_quote =  $data['tb_quote'];
        $bid->tb_quantity  =  $data['tb_quantity'];
        $bid->tb_city_id   =  $data['tb_city_id'];
        $bid->tb_delivery_type   =  $data['tb_delivery_type'];
        $bid->tb_delivery_charges   =  $data['tb_delivery_charges'];
        $bid->tb_warrenty   =  $data['tb_warrenty'];
        $bid->tb_warrenty_type   =  $data['tb_warrenty_type'];

        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/material/', $imageName);

            $bid->tb_attachment = $imageName;
        }
        // if ($request->hasfile('featured_image')) {
        //     $document = $request->file('featured_image');
        //     $size = $document->getSize();
        //     $imageName  = time() . "_" . $document->getClientOriginalName();
        //     $document->move(public_path() . '/images/marketplace/material/', $imageName);

        //     $bid->tb_featured_image = $imageName;
        // }

        if (ProBid::where('tb_tender_id', '=', $bid->tb_tender_id)
            ->where('tb_user_id', '=', Auth::user()->id)->exists()
        ) {
            return response()->json(['data' => 'Cannot bid more than once'], 400);
        }
        $bid->save();

        $proNotif = new ProNotif();
        $tender_user = ProTender::select('tender_user_id')->where('tender_id', $bid["tb_tender_id"])->first();
        $this->send_notif($proNotif, $tender_user->tender_user_id, 1, 'Bid made', $data['tb_tender_id'], Auth::user()->id, 'pro_tender_bids', 'bid_made');

        return response()->json($bid, 201);
    }

    protected function list($id)
    {
        $bids = ProBid::select('tb_tender_id', 'tb_user_id', 'tb_quote', 'tb_status')->where([['tb_tender_id', $id], ['tb_status', 0]])->get();
        foreach ($bids as $key => $value) {
            $user = ProUser::where('id', $value->tb_user_id)->get();
            $bids[$key]->full_name = $user[0]->getFullNameAttribute();
        }
        return response()->json(['data' => $bids], 200);
    }

    protected function accept(Request $request, $id, $user_id, ProNotif $proNotif)
    {
        $validator = Validator::make($request->all(), [
            'tb_message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();

        $bidsId = ProBid::select('tb_id')->where([['tb_tender_id', $id], ['tb_user_id', $user_id]])->first();
        $tender_user = ProTender::select('tender_user_id')->where('tender_id', $id)->first();
        $bids = ProBid::where([['tb_tender_id', $id], ['tb_user_id', $user_id]])->update(['tb_message' => $input['tb_message'], 'tb_status' => 1]);

        $this->send_notif($proNotif, $user_id, $id, $input['tb_message'], $bidsId->tb_id, $tender_user->tender_user_id, 'pro_tender_bids', 'accept-bid');

        return response()->json(['data' => $bids], 200);
    }

    protected function decline(Request $request, $id, $user_id, ProNotif $proNotif)
    {
        $validator = Validator::make($request->all(), [
            'tb_message' => 'required',
            'tb_reason' => 'required',
            'tb_feedback' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();

        $bidsId = ProBid::select('tb_id')->where([['tb_tender_id', $id], ['tb_user_id', $user_id]])->first();
        $tender_user = ProTender::select('tender_user_id')->where('tender_id', $id)->first();
        ProTender::where('tender_id', $id)->update(['tender_status' => 5]);
        $bids = ProBid::where([['tb_tender_id', $id], ['tb_user_id', $user_id]])->update([
            'tb_message' => $input['tb_message'],
            'tb_reason' => $input['tb_reason'], 'tb_feedback' => $input['tb_feedback'], 'tb_status' => 2
        ]);

        $this->send_notif($proNotif, $user_id, $id, $input['tb_message'], $bidsId->tb_id, $tender_user->tender_user_id, 'pro_tender_bids', 'decline-bid');
        return response()->json(['data' => $bids], 200);
    }

    public function send_notif($proNotif, $user_id, $id, $tb_message, $tb_id, $tender_user_id, $table_name, $bid_type, $optional = 'user')
    {
        $proNotif->notification_user_id     =  $user_id;
        $proNotif->notification_message     =  $tb_message;
        $proNotif->notification_bid_id     =  $tb_id;
        $proNotif->notification_sender_id     =  $tender_user_id;
        $proNotif->notification_table_name     =  $table_name;
        $proNotif->notification_user_type     =  $optional;
        $proNotif->notification_type     =  $bid_type;
        $proNotif->save();
    }

    protected function get_notif()
    {
        $notif = ProNotif::select(
            'notification_id',
            'notification_sender_id',
            'notification_bid_id',
            'notification_user_id',
            'notification_user_type',
            'notification_message',
            'notification_status',
            'notification_type'
        )
            ->where([['notification_user_id', auth()->user()->id], ['notification_status', 0]])
            ->orWhere([['notification_sender_id', auth()->user()->id], ['notification_status', 0]])->latest()->get();

        foreach ($notif as $key => $value) {

            if ($value->notification_user_type == 'user') {
                if ($notif[$key]->notification_user_id == auth()->user()->id) {
                    $notif[$key]->sender_isLogged = 1;
                }
                // dump($value);
                $sender = ProUser::select('first_name')->where('id', $value->notification_sender_id)->get();
                $notif[$key]->sender = $sender[0]->first_name;
                $reciever = ProUser::select('first_name')->where('id', $value->notification_user_id)->get();
                $notif[$key]->reciever = $reciever[0]->first_name;
            } else {
            }
        }


        return response()->json(['data' => $notif, 'count' => count($notif)], 200);
    }

    public function read_notif($id)
    {
        $readNotif = ProNotif::where([['notification_id', $id]])->update(['notification_status' => 1]);
        return response()->json(['data' => $readNotif], 200);
    }
}
