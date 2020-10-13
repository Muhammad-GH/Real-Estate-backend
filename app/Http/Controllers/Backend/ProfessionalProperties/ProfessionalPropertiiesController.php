<?php

namespace App\Http\Controllers\Backend\ProfessionalProperties;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfessionalsPropertyInfo;
use Illuminate\Validation\Rule;
use App\Models\Marketplace\MaterialPost;
use App\Repositories\Backend\MaterialRepository;
use App\Models\Marketplace\MaterialCategory;
use App\Models\Marketplace\MaterialBid;

/**
 * Class MaterialOfferController.
 */
class ProfessionalPropertiiesController extends Controller
{
     

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $professionalProperties= ProfessionalsPropertyInfo::orderBy('id', 'DESC')->paginate(5);
        return view('backend.professionalProperties.index')->with(['professionalProperties' => $professionalProperties]);
    }

    public function show(Request $request){
        $professionalProperties= ProfessionalsPropertyInfo::where('id',$request->id)->first();
        return view('backend.professionalProperties.show')->with(['professionalProperties' => $professionalProperties]); 
    }
}