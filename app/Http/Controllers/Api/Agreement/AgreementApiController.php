<?php

namespace App\Http\Controllers\Api\Agreement;

use Validator;
use App\Models\Auth\User;
use App\Models\Auth\ProUser;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use App\Models\Bussiness\Proposal;
use App\Models\Marketplace\ProBid;
use Illuminate\Support\Facades\DB;
use App\Models\Bussiness\Agreement;
use App\Models\Bussiness\Resources;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\ProNotif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Bussiness\ProjectPlan;
use App\Models\Marketplace\ProTender;
use App\Models\Bussiness\ContractRating;
use App\Models\Bussiness\AgreementPaymentTerm;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use App\Http\Controllers\Api\Bids\BidsApiController;
use App\Http\Controllers\Api\Proposal\ProposalApiController;
use App\Http\Controllers\Api\Contracts\ContractsApiController;
use App\Http\Controllers\Api\Revisions\RevisionsApiController;

class AgreementApiController extends Controller
{

    protected function agreementGetLatestID()
    {
        $agreement_id = Agreement::latest('agreement_id')->first('agreement_id');
        return response()->json($agreement_id, 200);
    }

    protected function agreementInsert(Request $request, Agreement $plan)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'agreement_tender_id'     => 'required',
            'agreement_client_id' => 'required',
            'agreement_request_id'    => 'required',
            // 'agreement_proposal_id'    => 'required',
            'agreement_terms'    => 'required',
            // 'proposal_pdf'   => 'required',
            // 'attachment'    => 'mimes:doc,docx,pdf,zip|max:2048',
            // 'emails'   => 'required',
            'date'   => 'required',
            'agreement_material_payment'   => 'required',
            'agreement_work_payment'   => 'required',
            'agreement_insurance'   => 'required',
            'agreement_work_guarantee'   => 'required',
            // 'agreement_legal_category'   => 'required',
            // 'agreement_client_res'   => 'required',
            // 'agreement_contractor_res'   => 'required',
            'agreement_material_guarantee'   => 'required',
            'agreement_transport_payment'   => 'required',
            'agreement_due_date'   => 'required',
            'agreement_panelty'   => 'required',
            'agreement_rate'   => 'required',
            'agreement_service_fee'   => 'required',
            'agreement_estimated_payment'   => 'required',
            'agreement_names'   =>  ['required', 'unique:pro_agreement,agreement_names,' . $data["agreement_request_id"] . ',agreement_request_id']

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $revision = new RevisionsApiController();
        $revision->updateStatues($data["agreement_client_id"], 'pro_notifications', 1);

        // if ((int)$data['agreement_tender_id'] !== 0) {
        //     $bids = ProBid::select('tb_tender_id')->where([['tb_id', $data['agreement_tender_id']]])->first();
        //     $data['agreement_tender_id'] = $bids->tb_tender_id;
        // }

        $plan->agreement_client_type = ($data['agreement_proposal_id'] == 0) ? 'resource' : 'user';

        $id = null;
        if (is_numeric($data['agreement_client_id'])) {
            $id = ($data['agreement_proposal_id'] > 0) ?
                ProUser::where('id', $data['agreement_client_id'])->first('id')->id :
                Resources::where('id', $data['agreement_client_id'])->first('id')->id;
        } else {
            $id = ($data['agreement_proposal_id'] > 0) ?
                ProUser::where('email', $data['agreement_client_id'])->first('id')->id :
                Resources::where('email', $data['agreement_client_id'])->first('id')->id;
        }

        $plan->agreement_client_id = $id;
        $plan->agreement_user_id     =  auth()->user()->id;
        $plan->agreement_tender_id     =  (int)$data['agreement_tender_id'];

        $plan->agreement_request_id =  $data['agreement_request_id'];
        $plan->agreement_proposal_id =  $data['agreement_proposal_id'];
        // $plan->agreement_pdf  =  $data['agreement_pdf'];
        $plan->agreement_names   =  $data['agreement_names'];
        $plan->agreement_terms   =  $data['agreement_terms'];
        $plan->agreement_type   =  $data['agreement_type'];
        $plan->agreement_other   =  $data['agreement_other'];
        $plan->agreement_insurance   =  $data['agreement_insurance'];
        $plan->agreement_milestones   =  $data['agreement_milestones'];
        $plan->emails   =  $data['emails'];
        $plan->date   =  $data['date'];
        $plan->agreement_material_payment   =  $data['agreement_material_payment'];
        $plan->agreement_work_payment   =  $data['agreement_work_payment'];
        $plan->agreement_work_guarantee   =  $data['agreement_work_guarantee'];
        $plan->agreement_legal_category   =  $data['agreement_legal_category'];
        $plan->agreement_client_res   =  $data['agreement_client_res'];
        $plan->agreement_contractor_res   =  $data['agreement_contractor_res'];
        $plan->agreement_additional_work_price   =  $data['agreement_additional_work_price'];
        $plan->agreement_material_guarantee   =  $data['agreement_material_guarantee'];
        $plan->agreement_transport_payment   =  $data['agreement_transport_payment'];
        $plan->agreement_due_date   =  $data['agreement_due_date'];
        $plan->agreement_panelty   =  $data['agreement_panelty'];
        $plan->agreement_rate   =  $data['agreement_rate'];
        $plan->agreement_service_fee   =  $data['agreement_service_fee'];
        $plan->agreement_estimated_payment   =  $data['agreement_estimated_payment'];

        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/agreement/', $imageName);
            $plan->agreement_attachment  = $imageName;
        }


        $data["agreement_client_type"] = $plan->agreement_client_type;
        $data["left"] = config('global_configurations.admin.left_currency_symbol');
        $data["right"] = config('global_configurations.admin.right_currency_symbol');

        $bidNotif = new BidsApiController();
        $proNotif = new ProNotif();


        if ($data["sent"] == 1 || $data["sent"] == 2 || $data["sent"] == 3 || $data["sent"] == 4) {


            if (is_numeric($data['agreement_client_id'])) {
                $data['agreement_client_id'] = ($data['agreement_proposal_id'] > 0) ?
                    ProUser::where('id', $data['agreement_client_id'])->first('email')->email :
                    Resources::where('id', $data['agreement_client_id'])->first('email')->email;
            } else {
                $data['agreement_client_id'] = ($data['agreement_proposal_id'] > 0) ?
                    ProUser::where('email', $data['agreement_client_id'])->first('email')->email :
                    Resources::where('email', $data['agreement_client_id'])->first('email')->email;
            }

            $status = new ContractsApiController();
            $status->tender_status($plan->proposal_tender_id, 6);

            if (Agreement::where('agreement_request_id', '=', $data["agreement_request_id"])->exists()) {
                Agreement::where('agreement_request_id', $data["agreement_request_id"])
                    ->update(
                        [
                            'agreement_status' => $data["sent"],
                            'agreement_pdf' => time() . "_agreement.pdf",
                            'agreement_terms' => $data['agreement_terms'],
                            'agreement_type' => $data['agreement_type'],
                            'agreement_other' => $data['agreement_other'],
                            'agreement_insurance' => $data['agreement_insurance'],
                            'agreement_milestones' => $data['agreement_milestones'],
                            'emails' => $data['emails'],
                            'date' => $data['date'],
                            'agreement_material_payment' => $data['agreement_material_payment'],
                            'agreement_work_payment' => $data['agreement_work_payment'],
                            'agreement_work_guarantee' => $data['agreement_work_guarantee'],
                            'agreement_legal_category' => $data['agreement_legal_category'],
                            'agreement_client_res' => $data['agreement_client_res'],
                            'agreement_contractor_res' => $data['agreement_contractor_res'],
                            'agreement_additional_work_price' => $data['agreement_additional_work_price'],
                            'agreement_material_guarantee' => $data['agreement_material_guarantee'],
                            'agreement_transport_payment' => $data['agreement_transport_payment'],
                            'agreement_due_date' => $data['agreement_due_date'],
                            'agreement_panelty' => $data['agreement_panelty'],
                            'agreement_rate' => $data['agreement_rate'],
                            'agreement_service_fee' => $data['agreement_service_fee'],
                            'agreement_estimated_payment' => $data['agreement_estimated_payment'],
                        ]
                    );

                $data["agreement_pdf"] = time() . "_agreement.pdf";
                $data["agreement_status"] = 1;

                $this->testpdf($data);
                $agreement_id = Agreement::where('agreement_request_id', $data["agreement_request_id"])->first('agreement_id');

                if ($plan->agreement_client_type === 'user') {
                    $bidNotif->send_notif($proNotif, $plan->agreement_client_id, 1, 'agreement revision sent', $agreement_id->agreement_id, auth()->user()->id, 'pro_agreement', 'agreement_sent');
                } else {
                    $bidNotif->send_notif($proNotif, $plan->agreement_client_id, 1, 'agreement revision sent', $agreement_id->agreement_id, auth()->user()->id, 'pro_agreement', 'agreement_sent', 'resource');
                }

                DB::table('pro_notifications')
                    ->where([['notification_type', 'agreement_revision'], ['notification_sender_id', auth()->user()->id]])
                    ->orWhere([['notification_type', 'agreement_revision'], ['notification_user_id', auth()->user()->id]])
                    ->update(['notification_status' => 1]);

                return response()->json($plan, 200);
            }

            $data["agreement_pdf"] = time() . "_agreement.pdf";
            $data["agreement_status"] = 1;
            $this->testpdf($data);

            $plan->agreement_status = $data["agreement_status"];
            $plan->agreement_pdf = $data["agreement_pdf"];
            $plan->save();

            if ($plan->agreement_client_type === 'user') {
                $bidNotif->send_notif($proNotif, $plan->agreement_client_id, 1, 'agreement sent', $plan->id, auth()->user()->id, 'pro_agreement', 'agreement_sent');
            } else {
                $bidNotif->send_notif($proNotif, $plan->agreement_client_id, 1, 'agreement sent', $plan->id, auth()->user()->id, 'pro_agreement', 'agreement_sent', 'resource');
            }

            $this->paymentTerm($plan->id, $plan->agreement_milestones, $plan->agreement_type);
            return response()->json($plan->id, 201);
        } else {
            $plan->save();
            $this->paymentTerm($plan->id, $plan->agreement_milestones, $plan->agreement_type);

            return response()->json($plan->id, 201);
        }
    }


    protected function testpdf($variables)
    {
        try {

            $template = ($variables["agreement_type"] == 'milestone') ? 'flipkoti_pro_agreement_milestone' : 'flipkoti_pro_agreement_pdf';

            $globalEmail = new ProposalApiController();
            ob_start();

            $view = View::make('pdfs/' . $template, ['variables' => $variables]);
            $content = $view->render();
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);

            $dest = "/images/marketplace/agreement/pdf/";
            $html2pdf->output(public_path() . $dest . $variables["agreement_pdf"], 'F');

            if ($variables["agreement_client_type"] === 'user') {
                $mails;
                if ($variables["emails"]) {
                    $mails = $variables["agreement_client_id"] . ',' . $variables['emails'];
                } else {
                    $mails = $variables["agreement_client_id"];
                }
                $globalEmail->sendEmailAttachment($variables["agreement_pdf"], $mails, $dest);
            } else {
                if ($variables["emails"]) {
                    $globalEmail->sendEmailAttachment($variables["agreement_pdf"], $variables["emails"], $dest);
                }
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }


    protected function updateAgreement(Request $request)
    {
        $data = $request->all();
        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/agreement/', $imageName);

            $data["agreement_attachment"]  = $imageName;
        }
        unset($data["attachment"]);


        $gift = Agreement::where('agreement_request_id', $data["agreement_request_id"])->update($data);

        return response()->json($gift, 200);
    }


    protected function getById($id)
    {
        $proposal = Agreement::where('agreement_request_id', $id)->get();
        if ($proposal[0]->agreement_client_type == 'resource') {
            $proposal[0]->email = Resources::where('id', $proposal[0]->agreement_client_id)->first('email')->email;
        } else {
            $proposal[0]->email = ProUser::where('id', $proposal[0]->agreement_client_id)->first('email')->email;
        }
        return response()->json($proposal, 200);
    }

    protected function getDrafts()
    {
        $proposal = Agreement::select('agreement_request_id', 'agreement_names', 'agreement_client_id', 'agreement_client_type')
            ->where([['agreement_status', 0], ["agreement_user_id", auth()->user()->id]])
            ->orWhere([['agreement_status', 4], ["agreement_user_id", auth()->user()->id]])
            ->orWhere([['agreement_status', 1], ['agreement_client_type', 'resource'], ['agreement_user_id', auth()->user()->id]])->get();

        foreach ($proposal as $key => $value) {
            $proposal[$key]->draft = 'update';
            if ($value->agreement_client_type == 'resource') {
                $proposal[$key]->agreement_client_type = Resources::where('id', $value->agreement_client_id)->first('email')->email;
            } else {
                $proposal[$key]->agreement_client_type = ProUser::where('id', $value->agreement_client_id)->first('email')->email;
            }
        }
        return response()->json($proposal, 200);
    }
    protected function updateAgreementStatus($id, $table, $status)
    {
        $updstatus = new RevisionsApiController();
        $return = $updstatus->updateStatues($id, $table, $status);

        return response()->json($return, 200);
    }
    protected function getByRId($id)
    {
        $agreement = Agreement::select('agreement_request_id', 'agreement_id', 'agreement_proposal_id')->where([['agreement_request_id', $id]])->get();
        $proposal = Proposal::select('work_template_id', 'mat_template_id')->where('proposal_id', $agreement[0]->agreement_proposal_id)->get();
        $plan = [];
        foreach ($proposal as $key => $value) {
            if ($value->work_template_id) {
                $plan[$key]["work_template"] = ProjectPlan::select('type', 'items', 'total')->where('id', $value->work_template_id)->first();
            }
            if ($value->mat_template_id) {
                $plan[$key]["mat_template"] = ProjectPlan::select('type', 'items', 'total')->where('id', $value->mat_template_id)->first();
            }
        }
        return response()->json(["data" => $plan], 200);
    }

    protected function getProposals()
    {
        $proposal = Proposal::select('proposal_id', 'proposal_tender_id', 'proposal_client_id', 'proposal_client_type')
            ->where([["proposal_user_id", auth()->user()->id], ["proposal_client_type", 'user'], ["proposal_status", 2]])->get();
        foreach ($proposal as $key => $value) {
            if ($value->proposal_client_type == 'resource') {
                $proposal[$key]->proposal_client_type = Resources::where('id', $value->proposal_client_id)->first('email')->email;
            } else {
                $tender = ProTender::select('tender_title')->where('tender_id', $value->proposal_tender_id)->get();
                $proposal[$key]->tender_title = $tender[0]->tender_title;
                $proposal[$key]->proposal_client_type = ProUser::where('id', $value->proposal_client_id)->first('email')->email;
            }
        }
        return response()->json($proposal, 200);
    }


    protected function getAgreements()
    {
        $agreement = Agreement::select(
            'agreement_id',
            'agreement_tender_id',
            'agreement_request_id',
            'agreement_client_id',
            'agreement_user_id',
            'agreement_client_type',
            'agreement_pdf',
            'agreement_status',
            'agreement_names'
        )->where('agreement_client_id', auth()->user()->id)->orWhere('agreement_user_id', auth()->user()->id)->get();

        foreach ($agreement as $key => $value) {
            if ($value->agreement_client_type == 'resource') {
                $agreement[$key]->agreement_client_email = Resources::where('id', $value->agreement_client_id)->first('email')->email;
            } else {
                $agreement[$key]->agreement_client_email = ProUser::where('id', $value->agreement_client_id)->first('email')->email;
            }
            if ($value->agreement_user_id == auth()->user()->id) {
                $agreement[$key]->sender_isLogged = 1;
            }
            $agreement[$key]->agreement_notif = ProNotif::where([['notification_bid_id', $value->agreement_id], ['notification_table_name', 'pro_agreement']])->orderBy('created_at', 'desc')->first();
        }

        return response()->json($agreement, 200);
    }

    protected function paymentTerm(...$data)
    {
        if ($data[2] !== 'hourly') {
            foreach (json_decode($data[1], true) as $key => $value) {
                $agreementPaymentTerm = new AgreementPaymentTerm;
                $agreementPaymentTerm->agreement_id =  $data[0];
                $agreementPaymentTerm->user_id =  auth()->user()->id;
                $agreementPaymentTerm->items =  "[" . json_encode($value) . "]";
                $agreementPaymentTerm->type  =  $data[2];
                $agreementPaymentTerm->save();
            }
        }
    }

    protected function ratingCreate(Request $request, ContractRating $rating)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'reason'     => 'required',
            'message' => 'required',
            'feedback'    => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $rating->user_id     =  auth()->user()->id;
        $rating->reason = $data['reason'];
        $rating->message     =  $data['message'];
        $rating->feedback     =  $data['feedback'];
        $rating->rating     =  (int)$data['rating'];

        $rating->save();
        return response()->json($rating->id, 201);
    }
}
