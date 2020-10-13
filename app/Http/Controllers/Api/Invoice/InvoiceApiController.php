<?php

namespace App\Http\Controllers\Api\Invoice;

use Validator;
use App\Models\Auth\User;
use App\Models\Auth\ProUser;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use App\Models\Bussiness\Invoice;
use App\Models\Bussiness\Project;
use App\Models\Marketplace\ProBid;
use Illuminate\Support\Facades\DB;
use App\Models\Bussiness\Agreement;
use App\Models\Bussiness\Resources;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\ProNotif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Bussiness\AgreementPaymentTerm;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use App\Http\Controllers\Api\Bids\BidsApiController;
use App\Http\Controllers\Api\Proposal\ProposalApiController;
use App\Models\Bussiness\ProjectTask;
use App\Models\Bussiness\ProjectTaskTime;

class InvoiceApiController extends Controller
{

    protected function invoiceCreate(Request $request, Invoice $invoice)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'tender_id' => 'required',
            'client_id' => 'required',
            "date" => 'required',
            "due_date" => 'required',
            "invoice_number" => 'required',
            "reference" => 'required',
            "acc_no" => 'required',
            "pay_term" => 'required',
            "interest" => 'required',
            // "cc" => 'required',
            "service" => 'required',
            "currency" => 'required',
            "items" => 'required',
            "tax" => 'required',
            "sub_total" => 'required',
            "tax_calc" => 'required',
            "total" => 'required',
            "invoice_names" => 'required|unique:pro_invoice,invoice_names',
            // "attachment" => 'required',
            // "note" => 'required',
            // "terms" => 'required',
            // "sent" => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        if ((int)$data['tender_id'] !== 0) {
            $bids = ProBid::select('tb_tender_id')->where([['tb_id', $data['tender_id']]])->first();
            $data['tender_id'] = $bids->tb_tender_id;
        }
        $id = ($data['type'] === 'user') ?
            ProUser::where('email', $data['client_id'])->first('id')->id :
            Resources::where('email', $data['client_id'])->first('id')->id;

        $invoice->client_id = $id;
        $invoice->user_id     =  auth()->user()->id;
        $invoice->client_type = $data['type'];
        $invoice->tender_id     =  (int)$data['tender_id'];
        $invoice->invoice_names   =  $data['invoice_names'];
        $invoice->date   =  $data['date'];
        $invoice->due_date   =  $data['due_date'];
        $invoice->invoice_number   =  $data['invoice_number'];
        $invoice->reference   =  $data['reference'];
        $invoice->acc_no   =  $data['acc_no'];
        $invoice->pay_term   =  $data['pay_term'];
        $invoice->interest   =  $data['interest'];
        $invoice->cc   =  $data['cc'];
        $invoice->service   =  $data['service'];
        $invoice->currency   =  $data['currency'];
        $invoice->items   =  $data['items'];
        $invoice->tax   =  $data['tax'];
        $invoice->sub_total   =  $data['sub_total'];
        $invoice->tax_calc   =  $data['tax_calc'];
        $invoice->total   =  $data['total'];
        $invoice->attachment   =  $data['attachment'];
        $invoice->note   =  $data['note'];
        $invoice->terms   =  $data['terms'];
        $invoice->sent   =  $data['sent'];

        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/invoice/', $imageName);
            $invoice->attachment  = $imageName;
        }

        // $invoice->agreement_id = (is_numeric($data["agreement"])) ? $data["agreement"] : 0;
        $data["client_type"] = $invoice->client_type;
        $data["left"] = config('global_configurations.admin.left_currency_symbol');
        $data["right"] = config('global_configurations.admin.right_currency_symbol');

        if ($data["sent"] == 1) {
            $bidNotif = new BidsApiController();
            $proNotif = new ProNotif();


            $data["invoice_pdf"] = time() . "_invoice.pdf";

            AgreementPaymentTerm::where([['id', $data["agree_id"]]])->update(['sent' => 1]);

            $this->testpdf($data);

            $invoice->invoice_pdf = $data["invoice_pdf"];
            $invoice->save();


            if ($invoice->client_type === 'user') {
                $bidNotif->send_notif(
                    $proNotif,
                    $invoice->client_id,
                    1,
                    'Invoice sent',
                    $invoice->id,
                    auth()->user()->id,
                    'pro_invoice',
                    'invoice_sent'
                );
            }

            return response()->json($invoice->id, 201);
        } else {
            return response()->json($invoice->save(), 201);
        }
    }

    protected function testpdf($variables)
    {
        try {

            $template = 'flipkoti_invoice_pdf';

            $globalEmail = new ProposalApiController();
            ob_start();

            $view = View::make('pdfs/' . $template, ['variables' => $variables]);
            $content = $view->render();
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);

            $dest = "/images/marketplace/invoice/pdf/";
            $html2pdf->output(public_path() . $dest . $variables["invoice_pdf"], 'F');

            if ($variables["client_type"] === 'user') {
                $email = ProUser::where('email', $variables["client_id"])->first('email')->email;
                $globalEmail->sendEmailAttachment($variables["invoice_pdf"], $email, $dest);
            } else {
                if ($variables["cc"]) {
                    $globalEmail->sendEmailAttachment($variables["invoice_pdf"], $variables["cc"], $dest);
                }
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    protected function sendPDF(Request $request)
    {
        $data = $request->all();
        $dest = "/images/marketplace/invoice/pdf/";
        $globalEmail = new ProposalApiController();
        $globalEmail->sendEmailAttachment($data["invoice"], $data["email"], $dest);
        return response()->json(1, 200);
    }

    protected function downloadPdf($id)
    {
        $variables = Invoice::find($id);
        return response()->json($variables["invoice_pdf"], 200);
    }

    protected function invoiceGet()
    {
        $invoice = Invoice::select('id', 'invoice_number', 'invoice_names', 'client_type', 'acc_no', 'client_id', 'date', 'total')->where([['user_id', auth()->user()->id]])
            ->orWhere([['client_id', auth()->user()->id]])->get();
        foreach ($invoice as $key => $value) {
            if ($value->client_type == 'resource') {
                $invoice[$key]->email = Resources::where('id', $value->client_id)->first('email')->email;
            } else {
                $invoice[$key]->email = ProUser::where('id', $value->client_id)->first('email')->email;
            }
        }
        return response()->json(['data' => $invoice], 200);
    }

    protected function getPaymentTerms($id, $agr_id)
    {
        $agreement = Agreement::where([['agreement_id', $agr_id]])->first();
        // dd($agreement);
        if ($agreement) {
            $terms = null;
            if ($agreement->agreement_terms == 'hourly') {
                $terms = ProjectTask::where([['project_id', $id], ['status', 'Done']])->get();
                foreach ($terms as $key => $value) {
                    $terms[$key]->agreement_id = (int)$agr_id;
                    $terms[$key]->type = 'hourly';
                }
            } else {
                $terms = AgreementPaymentTerm::where([['user_id', auth()->user()->id], ['sent', '!=', 1], ['agreement_id', $agr_id]])->get();
            }
            return response()->json(['data' => $terms], 200);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    protected function getTasks($id)
    {
        $terms = ProjectTask::where([['project_id', $id]])->get();
        foreach ($terms as $key => $value) {
            $terms[$key]->type = 'hourly';
        }
        return response()->json(['data' => $terms], 200);
    }

    protected function getTasksById($id)
    {
        $terms =  DB::table('pro_project_task')
            ->join('pro_project_task_time', 'pro_project_task.id', '=', 'pro_project_task_time.project_task_id')
            ->where([['pro_project_task_time.project_task_id', $id], ['pro_project_task.status', 'Done']])
            ->get();
        foreach ($terms as $key => $value) {
            $terms[$key]->items = "[{\"des\":\"" . $value->description . "\",\"due_date\":\"23-09-2020\",\"amount\":\"" . $value->duration . "\"}]";
            $terms[$key]->type = 'hourly';
        }
        return response()->json(['data' => $terms], 200);
    }


    protected function getProjects()
    {
        $project = Project::where([['pro_user_id', auth()->user()->id]])->get();
        return response()->json(['data' => $project], 200);
    }

    protected function agreementTermsById($id)
    {
        $term = AgreementPaymentTerm::find($id);
        if ($term === null) {
            return response()->json(['error' => 'record not found'], 401);
        }
        return response()->json(['data' => $term], 200);
    }

    protected function agreementUsersID()
    {
        $term = Agreement::select('agreement_client_id')->where([['agreement_client_type', 'user'], ['agreement_status', 2]])->get();
        foreach ($term as $key => $value) {
            if ($value->agreement_client_id !== auth()->user()->id) {
                $term[$key]->email = ProUser::select('email')->where([['id', $value->agreement_client_id]])->first('email')->email;
            }
        }
        return response()->json(['data' => $term], 200);
    }
}
