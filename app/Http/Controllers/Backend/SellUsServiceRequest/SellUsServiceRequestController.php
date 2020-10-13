<?php

namespace App\Http\Controllers\Backend\SellUsServiceRequest;

use App\Http\Controllers\Controller;
use Session;
use App\Models\SellUsServiceSubmissions;
use App\Models\ContactForm;
use Illuminate\Http\Request;
/**
 * Class DashboardController.
 */
class SellUsServiceRequestController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$contactForm = contactForm::where('type','myymeille')->orderBy('id','desc')->paginate();
        $requests = SellUsServiceSubmissions::with('contactForm')->paginate(10);
        foreach($requests as $requestdata){
        	$requestdata->contact_form;
        }
        return view('backend.SellUsServiceRequest.sellus-service-request')->with(['contactForms' =>$contactForm]);
    }
    public function view(Request $request){
    	$contactForm = contactForm::where('id',$request->id)->first();
    	$services = SellUsServiceSubmissions::select('selected_services')->where('contactFormId',$request->id)->first();
    	if($services){
    		$services = json_decode($services->selected_services);
    	}
    	return view('backend.SellUsServiceRequest.sellus-service-request-view')->with(['contactForm' => $contactForm, 'services' => $services]);
    }
}
