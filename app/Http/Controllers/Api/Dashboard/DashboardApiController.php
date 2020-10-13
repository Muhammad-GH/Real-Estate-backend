<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use App\Models\Bussiness\Agreement;
use App\Models\Bussiness\Invoice;
use App\Models\Bussiness\Proposal;
use App\Models\Bussiness\Resources;
use App\Models\Marketplace\ProTender;
use App\Models\Marketplace\ProBid;
use Validator;
use DB;
use Illuminate\Http\Resources\Json\Resource;

class DashboardApiController extends Controller
{
    protected function myRequest()
    {
        $data = ProTender::select('tender_type', 'tender_expiry_date')->where([['tender_user_id', Auth::user()->id], ['tender_type', 'Request']])->get();
        return response()->json(['data' => $data], 200);
    }
    protected function myOffer()
    {
        $data = ProTender::select('tender_type', 'tender_expiry_date')->where([['tender_user_id', Auth::user()->id], ['tender_type', 'Offer']])->get();
        return response()->json(['data' => $data], 200);
    }

    protected function myReqAcc()
    {
        $data = ProTender::select('tender_id', 'tender_type', 'tender_expiry_date')->where([['tender_user_id', Auth::user()->id], ['tender_type', 'Request']])->get();
        foreach ($data as $key => $value) {
            $bid = ProBid::select('tb_id', 'tb_status')->where([['tb_tender_id', $value->tender_id]])->get();
            if ($bid[0]->tb_status == 3 || $bid[0]->tb_status == 1) {
                $data[$key]->tb_id = $bid[0]->tb_id;
            } else {
                unset($data[$key]);
            }
        }
        return response()->json(["count" => count($data)], 200);
    }

    protected function myOffAcc()
    {
        $data = ProTender::select('tender_id', 'tender_type', 'tender_expiry_date')->where([['tender_user_id', Auth::user()->id], ['tender_type', 'Offer']])->get();
        foreach ($data as $key => $value) {
            $bid = ProBid::select('tb_id', 'tb_status')->where([['tb_tender_id', $value->tender_id]])->get();
            if ($bid[0]->tb_status === 3 || $bid[0]->tb_status === 1) {
                $data[$key]->tb_id = $bid[0]->tb_id;
            } else {
                unset($data[$key]);
            }
        }
        return response()->json(["count" => count($data)], 200);
    }

    protected function myReqDec()
    {
        $data = ProTender::select('tender_id', 'tender_type', 'tender_expiry_date')->where([['tender_user_id', Auth::user()->id], ['tender_type', 'Request']])->get();
        foreach ($data as $key => $value) {
            $bid = ProBid::select('tb_id', 'tb_status')->where([['tb_tender_id', $value->tender_id]])->get();
            if ($bid[0]->tb_status === 4 || $bid[0]->tb_status === 2) {
                $data[$key]->tb_id = $bid[0]->tb_id;
            } else {
                unset($data[$key]);
            }
        }
        return response()->json(["count" => count($data)], 200);
    }

    protected function myOffDec()
    {
        $data = ProTender::select('tender_id', 'tender_type', 'tender_expiry_date')->where([['tender_user_id', Auth::user()->id], ['tender_type', 'Offer']])->get();
        foreach ($data as $key => $value) {
            $bid = ProBid::select('tb_id', 'tb_status')->where([['tb_tender_id', $value->tender_id]])->get();
            if ($bid[0]->tb_status === 4 || $bid[0]->tb_status === 2) {
                $data[$key]->tb_id = $bid[0]->tb_id;
            } else {
                unset($data[$key]);
            }
        }
        return response()->json(["count" => count($data)], 200);
    }

    protected function myProposal()
    {
        $open = Proposal::where([['proposal_status', 1], ['proposal_user_id', auth()->user()->id]])->orWhere([['proposal_status', 4], ['proposal_user_id', auth()->user()->id]])->get()->count();
        $old = Proposal::where([['proposal_status', 2], ['proposal_user_id', auth()->user()->id]])->orWhere([['proposal_status', 3], ['proposal_user_id', auth()->user()->id]])->get()->count();
        $expired = Proposal::where([['proposal_status', 0], ['proposal_user_id', auth()->user()->id]])->orWhere([['proposal_end_date', '<=', date('d-m-Y')], ['proposal_user_id', auth()->user()->id]])->get()->count();
        $total = Proposal::where([['proposal_user_id', auth()->user()->id]])->get()->count();
        $new_array = [
            'open' => $open,
            'old' => $old,
            'expired' => $expired,
            'total' => $total,
        ];

        return response()->json(["data" => $new_array], 200);
    }

    protected function myAgreement()
    {
        $open = Agreement::where([['agreement_status', 1], ['agreement_user_id', auth()->user()->id]])->orWhere([['agreement_status', 4], ['agreement_user_id', auth()->user()->id]])->get()->count();
        $old = Agreement::where([['agreement_status', 2], ['agreement_user_id', auth()->user()->id]])->orWhere([['agreement_status', 3], ['agreement_user_id', auth()->user()->id]])->get()->count();
        $expired = Agreement::where([['agreement_status', 0], ['agreement_user_id', auth()->user()->id]])->orWhere([['agreement_due_date', '<=', date('d-m-Y')], ['agreement_user_id', auth()->user()->id]])->get()->count();
        $total = Agreement::where([['agreement_user_id', auth()->user()->id]])->get()->count();
        $new_array = [
            'open' => $open,
            'old' => $old,
            'expired' => $expired,
            'total' => $total,
        ];

        return response()->json(["data" => $new_array], 200);
    }

    protected function myInvoice()
    {
        $open = Invoice::where([['sent', 1], ['user_id', auth()->user()->id]])->orWhere([['sent', 4], ['user_id', auth()->user()->id]])->get()->count();
        $old = Invoice::where([['sent', 2], ['user_id', auth()->user()->id]])->orWhere([['sent', 3], ['user_id', auth()->user()->id]])->get()->count();
        $expired = Invoice::where([['sent', 0], ['user_id', auth()->user()->id]])->orWhere([['due_date', '<=', date('d-m-Y')], ['user_id', auth()->user()->id]])->get()->count();
        $total = Invoice::where([['user_id', auth()->user()->id]])->get()->count();
        $new_array = [
            'open' => $open,
            'old' => $old,
            'expired' => $expired,
            'total' => $total,
        ];

        return response()->json(["data" => $new_array], 200);
    }

    protected function myResources()
    {
        $customer = Resources::where([['type', 'Client'], ['user_id', auth()->user()->id]])->get()->count();
        $resource = Resources::where([['type', '!=', 'Client'], ['user_id', auth()->user()->id]])->get()->count();
        $expired = Resources::where([['status', 0], ['user_id', auth()->user()->id]])->get()->count();
        $total = Resources::where([['user_id', auth()->user()->id]])->get()->count();
        $new_array = [
            'customer' => $customer,
            'resource' => $resource,
            'expired' => $expired,
            'total' => $total,
        ];

        return response()->json(["data" => $new_array], 200);
    }

    protected function myRequests()
    {
        $tender_open = DB::table('pro_tender')
            ->join('pro_tender_bids', 'pro_tender.tender_id', '=', 'pro_tender_bids.tb_tender_id')
            ->select('pro_tender.tender_id', 'pro_tender.tender_title', 'pro_tender.tender_user_id', 'pro_tender_bids.*')
            ->where([['tender_user_id', auth()->user()->id], ['tb_status', 0]])
            ->orWhere([['tender_user_id', auth()->user()->id], ['tb_status', 1]])
            ->get()->count();
        $tender_old = DB::table('pro_tender')
            ->join('pro_tender_bids', 'pro_tender.tender_id', '=', 'pro_tender_bids.tb_tender_id')
            ->select('pro_tender.tender_id', 'pro_tender.tender_title', 'pro_tender.tender_user_id', 'pro_tender_bids.*')
            ->where([['tender_user_id', auth()->user()->id], ['tb_status', 3]])
            ->orWhere([['tender_user_id', auth()->user()->id], ['tb_status', 5]])
            ->orWhere([['tender_user_id', auth()->user()->id], ['tb_status', 6]])
            ->get()->count();
        $tender_expired = DB::table('pro_tender')
            ->join('pro_tender_bids', 'pro_tender.tender_id', '=', 'pro_tender_bids.tb_tender_id')
            ->select('pro_tender.tender_id', 'pro_tender.tender_title', 'pro_tender.tender_user_id', 'pro_tender_bids.*')
            ->where([['tender_user_id', auth()->user()->id], ['tb_status', 2]])
            ->orWhere([['tender_user_id', auth()->user()->id], ['tb_status', 4]])
            ->get()->count();
        $total = DB::table('pro_tender')
            ->join('pro_tender_bids', 'pro_tender.tender_id', '=', 'pro_tender_bids.tb_tender_id')
            ->select('pro_tender.tender_id', 'pro_tender.tender_title', 'pro_tender.tender_user_id', 'pro_tender_bids.*')
            ->get()->count();
        $new_array = [
            'open' => $tender_open,
            'old' => $tender_old,
            'expired' => $tender_expired,
            'total' => $total,
        ];

        return response()->json(["data" => $new_array], 200);
    }
}
