<?php

namespace App\Http\Controllers\Api\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\ProUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use App\Models\Marketplace\ProBid;
use App\Models\Marketplace\ProTender;
use App\Models\Marketplace\ProNotif;
use Validator;
use DB;

class ContractsApiController extends Controller
{

    protected function index()
    {
        $notif = ProNotif::select(
            'notification_sender_id',
            'notification_bid_id',
            'notification_user_id',
            'notification_message',
            'notification_table_name',
            'notification_status',
            'notification_type',
            'created_at'
        )
            ->where([['notification_user_id', auth()->user()->id], ['notification_table_name', 'pro_tender_bids'], ['notification_type', 'accept-bid']])
            ->orWhere([['notification_user_id', auth()->user()->id], ['notification_table_name', 'pro_tender_bids'], ['notification_type', 'decline-bid']])
            ->orWhere([['notification_sender_id', auth()->user()->id], ['notification_table_name', 'pro_tender_bids'], ['notification_type', 'accept-bid']])
            ->orWhere([['notification_sender_id', auth()->user()->id], ['notification_table_name', 'pro_tender_bids'], ['notification_type', 'decline-bid']])
            ->latest()->get();

        foreach ($notif as $key => $value) {
            if ($notif[$key]->notification_sender_id == auth()->user()->id) {
                $notif[$key]->sender_isLogged = 1;
            }

            $sender = ProUser::select('first_name')->where('id', $value->notification_sender_id)->get();
            $bid = ProBid::select('tb_tender_id', 'tb_status')->where('tb_id', $value->notification_bid_id)->get();
            $tender = ProTender::select('tender_category_type', 'tender_title', 'tender_type', 'tender_quantity', 'tender_budget', 'tender_cost_per_unit', 'tender_unit', 'tender_status', 'tender_rate', 'tender_available_from', 'tender_available_to')->where('tender_id', $bid[0]->tb_tender_id)->get();

            $notif[$key]->bid_status = $bid[0]->tb_status;
            $notif[$key]->sender = $sender[0]->first_name;
            $notif[$key]->tender_title = $tender[0]->tender_title;
            $notif[$key]->tender_category_type = $tender[0]->tender_category_type;
            $notif[$key]->tender_type = $tender[0]->tender_type;
            $notif[$key]->tender_quantity = $tender[0]->tender_quantity;
            $notif[$key]->tender_budget = $tender[0]->tender_budget;
            $notif[$key]->tender_rate = $tender[0]->tender_rate;
            $notif[$key]->tender_cost_per_unit = $tender[0]->tender_cost_per_unit;
            $notif[$key]->tender_unit = $tender[0]->tender_unit;
            $notif[$key]->tender_status = $tender[0]->tender_status;
            $notif[$key]->tender_available_from = $tender[0]->tender_available_from;
            $notif[$key]->tender_available_to = $tender[0]->tender_available_to;
        }
        return response()->json(['data' => $notif], 200);
    }

    public function status($id, $updStatus)
    {
        $notif = ProBid::where('tb_id', $id)->first();
        $tender = ProTender::where('tender_id', $notif->tb_tender_id)->first();
        $upd = ProBid::where('tb_id', $id)->update(['tb_status' => $updStatus]);

        if ($updStatus == 3) {
            $this->tender_status($tender->tender_id, 4);
        }
        if ($updStatus == 4) {
            $this->tender_status($tender->tender_id, 5);
        }
        if ($updStatus == 6) {
            $this->tender_status($tender->tender_id, 6);
        }
        return response()->json(['data' => $upd], 200);
    }


    public function tender_status($id, $status)
    {
        return ProTender::where('tender_id', $id)->update(['tender_status' => $status]);
    }
}
