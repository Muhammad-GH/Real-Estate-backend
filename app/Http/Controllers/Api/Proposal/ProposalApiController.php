<?php

namespace App\Http\Controllers\Api\Proposal;

use Validator;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use App\Models\Bussiness\Proposal;
use App\Models\Marketplace\ProBid;
use Illuminate\Support\Facades\DB;
use App\Models\Bussiness\Resources;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\ProNotif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Bussiness\ProjectPlan;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use App\Http\Controllers\Api\Bids\BidsApiController;
use App\Http\Controllers\Api\Contracts\ContractsApiController;
use App\Http\Controllers\Api\Revisions\RevisionsApiController;
use App\Models\Auth\ProUser;

class ProposalApiController extends Controller
{


    protected function proposalInsert(Request $request, Proposal $plan)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'proposal_tender_id'     => 'required',
            'proposal_client_id' => 'required',
            'proposal_request_id'    => 'required',
            // 'proposal_pdf'   => 'required',
            // 'attachment'    => 'mimes:doc,docx,pdf,zip|max:2048',
            // 'emails'   => 'required',
            'date'   => 'required',
            'proposal_material_payment'   => 'required',
            'proposal_work_payment'   => 'required',
            'proposal_work_guarantee'   => 'required',
            'proposal_insurance'   => 'required',
            'proposal_due_date'   => 'required',
            'proposal_start_date'   => 'required',
            'proposal_end_date'   => 'required',
            'proposal_names'   => ['required', 'unique:pro_proposal,proposal_names,' . $data["proposal_request_id"] . ',proposal_request_id']
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $revision = new RevisionsApiController();
        $revision->updateStatues($data["proposal_tender_id"], 'pro_notifications', 1);



        // if ((int)$data['proposal_tender_id'] !== 0) {
        //     $bids = ProBid::select('tb_tender_id')->where([['tb_id', $data['proposal_tender_id']]])->first();
        //     $data['proposal_tender_id'] = $bids->tb_tender_id;
        // }

        $plan->proposal_client_type = ($data['proposal_tender_id'] == 0) ? 'resource' : 'user';

        $id = (is_numeric($data['proposal_client_id'])) ?
            (int)$data['proposal_client_id'] :
            Resources::where('email', $data['proposal_client_id'])->first('id')->id;

        $plan->proposal_client_id = $id;
        $plan->proposal_user_id     =  auth()->user()->id;
        $plan->proposal_tender_id     =  (int)$data['proposal_tender_id'];
        $plan->proposal_names     =  $data['proposal_names'];
        $plan->proposal_request_id =  $data['proposal_request_id'];
        // $plan->proposal_pdf  =  $data['proposal_pdf'];
        $plan->proposal_other   =  $data['proposal_other'];
        $plan->emails   =  $data['emails'];
        $plan->date   =  $data['date'];
        $plan->proposal_material_payment   =  $data['proposal_material_payment'];
        $plan->proposal_work_payment   =  $data['proposal_work_payment'];
        $plan->proposal_work_guarantee   =  $data['proposal_work_guarantee'];
        $plan->proposal_insurance   =  $data['proposal_insurance'];
        $plan->proposal_due_date   =  $data['proposal_due_date'];
        $plan->proposal_start_date   =  $data['proposal_start_date'];
        $plan->proposal_end_date   =  $data['proposal_end_date'];
        $plan->work_template_id   =  $data['work_template_id'];
        $plan->mat_template_id   =  $data['mat_template_id'];

        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/proposal/', $imageName);

            $plan->proposal_attachment  = $imageName;
        }

        $data["proposal_client_type"] = $plan->proposal_client_type;
        $data["left"] = config('global_configurations.admin.left_currency_symbol');
        $data["right"] = config('global_configurations.admin.right_currency_symbol');


        $bidNotif = new BidsApiController();
        $proNotif = new ProNotif();


        if ($data["sent"] == 1 || $data["sent"] == 2 || $data["sent"] == 3 || $data["sent"] == 4) {

            // if ($data['proposal_id'] > 0) {
            if (is_numeric($data['proposal_client_id'])) {
                $data['proposal_client_id'] = ($data['proposal_tender_id'] > 0) ?
                    ProUser::where('id', $data['proposal_client_id'])->first('email')->email :
                    Resources::where('id', $data['proposal_client_id'])->first('email')->email;
                // $data['proposal_client_id'] =  ProUser::where('id', $data['proposal_client_id'])->first('email')->email;
            } else {
                $data['proposal_client_id'] = ($data['proposal_tender_id'] > 0) ?
                    ProUser::where('email', $data['proposal_client_id'])->first('email')->email :
                    Resources::where('email', $data['proposal_client_id'])->first('email')->email;
                // $data['proposal_client_id'] = Resources::where('email', $data['proposal_client_id'])->first('email')->email;
            }
            // }

            if ($plan->proposal_client_type === 'user') {
                $status = new ContractsApiController();
                $status->status($plan->proposal_tender_id, 6);
            }

            if (Proposal::where('proposal_request_id', '=', $data["proposal_request_id"])->exists()) {
                $plan1 = Proposal::where('proposal_request_id', $data["proposal_request_id"])
                    ->update(
                        [
                            'proposal_status' => $data["sent"],
                            'proposal_pdf' => time() . "_proposal.pdf",
                            'emails' => $data["emails"],
                            'date' => $data["date"],
                            'proposal_material_payment' => $data["proposal_material_payment"],
                            'proposal_work_payment' => $data["proposal_work_payment"],
                            'proposal_work_guarantee' => $data["proposal_work_guarantee"],
                            'proposal_insurance' => $data["proposal_insurance"],
                            'proposal_due_date' => $data["proposal_due_date"],
                            'proposal_start_date' => $data["proposal_start_date"],
                            'proposal_end_date' => $data["proposal_end_date"],
                            'work_template_id' => $data["work_template_id"],
                            'mat_template_id' => $data["mat_template_id"],
                        ]
                    );
                $data["proposal_pdf"] = time() . "_proposal.pdf";
                $data["proposal_status"] = 1;

                $this->testpdf($data);

                $proposal_id = Proposal::where('proposal_request_id', $data["proposal_request_id"])->first('proposal_id');

                if ($plan->proposal_client_type === 'user') {
                    $bidNotif->send_notif($proNotif, $plan->proposal_client_id, 1, 'proposal revision sent', $proposal_id->proposal_id, auth()->user()->id, 'pro_proposal', 'proposal_sent');
                } else {
                    $bidNotif->send_notif($proNotif, $plan->proposal_client_id, 1, 'proposal revision sent', $proposal_id->proposal_id, auth()->user()->id, 'pro_proposal', 'proposal_sent', 'resource');
                }
                DB::table('pro_notifications')
                    ->where([['notification_type', 'proposal_revision'], ['notification_sender_id', auth()->user()->id]])
                    ->orWhere([['notification_type', 'proposal_revision'], ['notification_user_id', auth()->user()->id]])
                    ->update(['notification_status' => 1]);

                return response()->json($plan, 200);
            }

            $data["proposal_pdf"] = time() . "_proposal.pdf";
            $data["proposal_status"] = 1;
            $this->testpdf($data);

            $plan->proposal_status = $data["proposal_status"];
            $plan->proposal_pdf = $data["proposal_pdf"];
            $plan->save();

            if ($plan->proposal_client_type === 'user') {
                $bidNotif->send_notif($proNotif, $plan->proposal_client_id, 1, 'proposal sent', $plan->id, auth()->user()->id, 'pro_proposal', 'proposal_sent');
            } else {
                $bidNotif->send_notif($proNotif, $plan->proposal_client_id, 1, 'proposal sent', $plan->id, auth()->user()->id, 'pro_proposal', 'proposal_sent', 'resource');
            }

            return response()->json($plan->id, 201);
        } else {
            return response()->json($plan->save(), 201);
        }
    }

    protected function testpdf($variables)
    {

        try {
            ob_start();

            $view = View::make('pdfs/flipkoti_pro_pdf', ['variables' => $variables]);
            $content = $view->render();
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);

            $dest = "/images/marketplace/proposal/pdf/";
            $html2pdf->output(public_path() . $dest . $variables["proposal_pdf"], 'F');


            if ($variables["proposal_client_type"] === 'user') {
                $mails;
                if ($variables["emails"]) {
                    $mails = $variables["proposal_client_id"] . ',' . $variables['emails'];
                } else {
                    $mails = $variables["proposal_client_id"];
                }
                $this->sendEmailAttachment($variables["proposal_pdf"], $mails, $dest);
            } else {
                if ($variables["emails"]) {
                    $this->sendEmailAttachment($variables["proposal_pdf"], $variables["emails"], $dest);
                }
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }


    protected function updateProposal(Request $request)
    {
        $data = $request->all();
        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/proposal/', $imageName);

            $data["proposal_attachment"]  = $imageName;
        }
        unset($data["attachment"]);

        $gift = Proposal::where('proposal_request_id', $data["proposal_request_id"])->update($data);

        return response()->json($gift, 200);
    }

    protected function updateProposalStatus($id, $table, $status)
    {
        $updstatus = new RevisionsApiController();
        $return = $updstatus->updateStatues($id, $table, $status);

        return response()->json($return, 200);
    }

    public function sendEmailAttachment($name, $emails, $dest)
    {
        $data['send_to'] = explode(',', $emails);
        $data['send_from'] = 'guptanishantmca@gmail.com';
        $data['replace_var_subject'] = array('{{name}}' => 'Nishant1', '{{test}}' => 'Test MSG1');
        $data['replace_var_body'] = array('{{name}}' => 'Nishant2', '{{test}}' => 'Test MSG2');
        $data['email_id'] = 'template test fi';
        $data['langcode'] = 'en';
        $data['file_path'] = public_path() . $dest . $name;
        return send_pro_email($data);
    }

    protected function proposalGetLatestID()
    {
        $proposal = Proposal::latest('proposal_id')->first('proposal_id');
        return response()->json($proposal, 200);
    }

    protected function getById($id)
    {
        $proposal = Proposal::where('proposal_request_id', $id)->get();
        if ($proposal[0]->proposal_client_type == 'resource') {
            $proposal[0]->email = Resources::where('id', $proposal[0]->proposal_client_id)->first('email')->email;
        } else {
            $proposal[0]->email = ProUser::where('id', $proposal[0]->proposal_client_id)->first('email')->email;
        }
        $proposal[0]->work = ProjectPlan::where([['id', $proposal[0]->work_template_id]])->first();
        $proposal[0]->mat = ProjectPlan::where([['id', $proposal[0]->mat_template_id]])->first();
        return response()->json($proposal, 200);
    }

    protected function getByPId($id)
    {
        $proposal = Proposal::select('work_template_id', 'mat_template_id')->where('proposal_id', $id)->get();
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

    protected function getDrafts()
    {
        $proposal = Proposal::select('proposal_request_id', 'proposal_names', 'proposal_client_id', 'proposal_client_type')
            ->where([['proposal_status', 0], ['proposal_user_id', auth()->user()->id]])
            ->orWhere([['proposal_status', 4], ['proposal_user_id', auth()->user()->id]])
            ->orWhere([['proposal_status', 1], ['proposal_client_type', 'resource'], ['proposal_user_id', auth()->user()->id]])->get();
        foreach ($proposal as $key => $value) {

            $proposal[$key]->draft = 'update';
            if ($value->proposal_client_type == 'resource') {
                $proposal[$key]->proposal_client_type = Resources::where('id', $value->proposal_client_id)->first('email')->email;
            } else {
                $proposal[$key]->proposal_client_type = ProUser::where('id', $value->proposal_client_id)->first('email')->email;
            }
        }
        return response()->json($proposal, 200);
    }

    protected function getProposals()
    {
        $proposal = Proposal::select(
            'proposal_id',
            'proposal_tender_id',
            'proposal_request_id',
            'proposal_client_id',
            'proposal_user_id',
            'proposal_client_type',
            'proposal_pdf',
            'proposal_status',
            'proposal_names',
        )->where([['proposal_client_id', auth()->user()->id], ['proposal_status', '!=', 0]])->orWhere([['proposal_user_id', auth()->user()->id], ['proposal_status', '!=', 0]])->get();

        foreach ($proposal as $key => $value) {
            if ($value->proposal_client_type == 'resource') {
                $proposal[$key]->proposal_client_email = Resources::where('id', $value->proposal_client_id)->first('email')->email;
            } else {
                $proposal[$key]->proposal_client_email = ProUser::where('id', $value->proposal_client_id)->first('email')->email;
            }
            if ($value->proposal_user_id == auth()->user()->id) {
                $proposal[$key]->sender_isLogged = 1;
            }
            $proposal[$key]->proposal_notif = ProNotif::where([['notification_bid_id', $value->proposal_id], ['notification_table_name', 'pro_proposal']])->orderBy('created_at', 'desc')->first();
        }

        return response()->json($proposal, 200);
    }
}
