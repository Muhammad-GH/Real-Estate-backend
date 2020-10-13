<?php

namespace App\Http\Controllers\Backend\professionalEnquiries;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfessionalEnquiry;
use Illuminate\Validation\Rule;
use App\Models\Marketplace\MaterialPost;
use App\Repositories\Backend\MaterialRepository;
use App\Models\Marketplace\MaterialCategory;
use App\Models\Marketplace\MaterialBid;

/**
 * Class MaterialOfferController.
 */
class ProfessionalEnquiriesController extends Controller
{
     

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serviceProvidersRequests()
    {
        $professionalEnquiries = ProfessionalEnquiry::orderBy('id', 'DESC')->where('type','service provider')->paginate(5);
        return view('backend.professionalEnquiries.serviceProviders')->with(['professionalEnquiries' => $professionalEnquiries]);
    }

    public function investorsRequests(){
     $professionalEnquiries = ProfessionalEnquiry::orderBy('id', 'DESC')->where('type','Investor')->paginate(5);
        return view('backend.professionalEnquiries.serviceProviders')->with(['professionalEnquiries' => $professionalEnquiries]);
    }

    public function realEstateRequests(){
        $professionalEnquiries = ProfessionalEnquiry::orderBy('id', 'DESC')->where('type','real estate and housing')->paginate(5);
        return view('backend.professionalEnquiries.serviceProviders')->with(['professionalEnquiries' => $professionalEnquiries]);
    }
    public function marketplaceRequests(){
        $professionalEnquiries = ProfessionalEnquiry::orderBy('id', 'DESC')->where('type','marketplace')->paginate(5);
        return view('backend.professionalEnquiries.serviceProviders')->with(['professionalEnquiries' => $professionalEnquiries]);
    }
    public function show(Request $request){
        $professionalEnquiries = ProfessionalEnquiry::where('id',$request->id)->first();
        return view('backend.professionalEnquiries.show')->with(['professionalEnquiry' => $professionalEnquiries]);    
    }
}