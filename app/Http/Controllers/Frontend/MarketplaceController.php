<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\Marketplace\MaterialPost;
use App\Repositories\Backend\MaterialRepository;
use App\Models\Marketplace\MaterialCategory;
use App\Models\Marketplace\MaterialBid;
use App\Models\Marketplace\WorkPost;
use App\Models\Marketplace\WorkCategories;
use App\Models\Marketplace\WorkBid;

/**
 * Class MarketplaceController.
 */
class MarketplaceController extends Controller
{
    
    /**
     * MarketplaceController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $material = $this->getMaterials();
        $work = $this->getWorks();

        return view('frontend.marketplace.index')->withMaterial($material)->withWork($work);
    }

    private function getMaterials()
    {
        $dtime = date('Y-m-d H:i:s');
        $materialRequest = MaterialPost::where(['post_type'=>'Request'])->where(['platform_display' => 0])
        ->whereDate('post_expiry_date', '>=', $dtime)
        ->limit(4)->with('category')->get();

        $reqcount = count($materialRequest);
        $offerLimit = 2;
        switch ($reqcount) {
            case '2':
                $offerLimit = 2;
                break;
            case '1':
                $offerLimit = 3;
                break;
            case '0':
                $offerLimit = 4;
                break;
            default:
                $offerLimit = 2;
                break;
        }
        
        $materialOffer = MaterialPost::where('post_type','Offer')->whereDate('post_expiry_date', '>=', $dtime)->limit($offerLimit)->with('category')->get(); 

        return ['request'=>$materialRequest, 'offer'=>$materialOffer];
    }

    private function getWorks()
    {
        $dtime = date('Y-m-d H:i:s');
        $workRequest = WorkPost::where('post_type','Request')->where(['platform_display' => 0])->whereDate('post_expiry_date', '>=', $dtime)->limit(4)->with('category')->get();
        $reqcount = count($workRequest);
        $offerLimit = 2;
        switch ($reqcount) {
            case '2':
                $offerLimit = 2;
                break;
            case '1':
                $offerLimit = 3;
                break;
            case '0':
                $offerLimit = 4;
                break;
            default:
                $offerLimit = 2;
                break;
        }
        
        $workOffer = WorkPost::where('post_type','Offer')->whereDate('post_expiry_date', '>=', $dtime)->limit($offerLimit)->with('category')->get(); 

        return ['request'=>$workRequest, 'offer'=>$workOffer];
    }

    /**
     * @param Request $request
     *  @param materialId $materialId
     * @throws \Throwable
     * @return mixed
     */
    public function materialDetail(Request $request, $materialId)
    { 
        $material = $this->getMaterialById($materialId);
        return view('frontend.marketplace.material_detail')->withMaterial($material);
    }

    private function getMaterialById($materialId)
    {
        return MaterialPost::where('id',$materialId)->with('category')->first();
    }
    
    /**
     * @param Request $request
     *  @param id $id
     * @throws \Throwable
     * @return mixed
     */
    public function workDetail(Request $request, $id)
    { 
        $work_detail = $this->getWorkById($id);
        return view('frontend.marketplace.work_detail')->withWork($work_detail);
    }

    private function getWorkById($id)
    {
        return WorkPost::where('id',$id)->with('category')->first();
    }

    public function storeWorkBid(Request $request, $id)
    { 

        $data = $request->all();
        #echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'quote'     => 'required|numeric',
            'name' => 'required',
            'email_address'   => 'required',
            'contact_number'   => 'required',
            'message'      => 'required',
            'terms'=> 'required'
            
        ])->validate();

        $workBid = new WorkBid();
        $workBid->work_post_id = $id;
        $workBid->quote = $data['quote'];
        $workBid->name = $data['name'];
        $workBid->email_address = $data['email_address'];
        $workBid->contact_number = $data['contact_number'];
        $workBid->message = $data['message'];
        
        $workBid->save();

        // return redirect()->back()->with(['msg'=>'Your bid has been submitted successfully.']);
        return redirect()->back()->withFlashSuccess('Tarjouksesi on lähetetty onnistuneesti.');
 
    }

    public function storeMaterialBid(Request $request, $id)
    { 
        $material = $this->getMaterialById($id);
        if(empty($material)){
            return redirect()->back()->withFlashError('Invalid request.');
        }

        $data = $request->all();
        $validationRules = [
            'quote'     => 'required|numeric',
            'quantity' => 'required|numeric',
            'contact_name' => 'required',
            'email_address'   => 'required',
            'contact_number'   => 'required',
            'shipping_location'   => 'required',
            'delivery_type'   => 'required',
            'message'      => 'required',
            'terms'=> 'required'
        ];
        if('Request' == $material->post_type){
            $validationRules['delivery_charges'] = 'required|numeric';
            $validationRules['warranty'] = 'required|numeric';
            $validationRules['warranty_type'] = 'required';
        }

        $validator = Validator::make($data, $validationRules)->validate();

        $materialBid = new MaterialBid();
        $materialBid->material_post_id  = $id;
        $materialBid->quote_per_unit = $data['quote'];
        $materialBid->quantity = $data['quantity'];
        $materialBid->contact_name = $data['contact_name'];
        $materialBid->company_name = $data['company_name'];
        $materialBid->email_address = $data['email_address'];
        $materialBid->contact_number = $data['contact_number'];
        $materialBid->message = $data['message'];
        $materialBid->shipping_location = $data['shipping_location'];
        $materialBid->delivery_type = $data['delivery_type'];
        
        if('Request' == $material->post_type){
           $materialBid->delivery_charges = $data['delivery_charges'];
           $materialBid->warranty = $data['warranty'];
           $materialBid->warranty_type = $data['warranty_type'];
        }
        $materialBid->save();

        return redirect()->back()->withFlashSuccess('Tarjouksesi on lähetetty onnistuneesti.');

    }
    

} /* END of class: MarketplaceController */
