<?php

namespace App\Http\Controllers\Backend\Marketplace;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Marketplace\MaterialPost;
use App\Repositories\Backend\MaterialRepository;
use App\Models\Marketplace\MaterialCategory;
use App\Models\Marketplace\MaterialBid;
/**
 * Class MaterialRequestController.
 */
class MaterialRequestController extends Controller
{
    /**
     * @var MaterialRequestController
     */
    protected $materialRepository;

    /**
     * MaterialRequestController constructor.
     *
     * @param MaterialRepository $materialRepository
     */
    public function __construct(MaterialRepository $materialRepository)
    {
        parent::__construct();
        $this->materialRepository = $materialRepository;
    }   

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.marketplace.material.requests-list')
            ->withRequests($this->materialRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeleted(Request $request)
    {
        return view('backend.property.deleted')
            ->withProperties($this->propertyRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $categories = MaterialCategory::pluck('name','mc_id');
        return view('backend.marketplace.material.request-create')->withCategories($categories);
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, MaterialPost $materialPost)
    {
        $data = $request->all();
        #echo '<pre>'; print_r($data); die;
        $validator = Validator::make($data, [
            'title'     => ['required','max:150'],
            'category' => 'required',
            'description'   => 'required',
            'volume_need'    => 'required|numeric',
            'unit'   => 'required',
            'city'      => 'required',
            'pincode'     => 'required',
            'post_expiry_days'  => 'required|numeric',
            'post_expiry_hour'  => 'numeric',
            'attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
            'featured_image' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image' => 'required',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ])->validate();
        
        $materialPost->title     =  $data['title'];
        $materialPost->categoryId =  $data['category'];
        // $property->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $materialPost->description  =  $data['description'];
        $materialPost->quantity   =  $data['volume_need'];
        $materialPost->unit   =  $data['unit'];
        $materialPost->city   =  $data['city'];
        $materialPost->pincode   =  $data['pincode'];
        $materialPost->post_type   =  'Request';
        $expDays = $data['post_expiry_days'];
        $expiry_hour = $data['post_expiry_hour']?$data['post_expiry_hour']:0;

        if(empty($data['post_expiry_hour']) || $data['post_expiry_hour'] == 0){
            $expDays = $data['post_expiry_days']-1;
        }
        
        $materialPost->post_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
       
        if($request->hasfile('attachment'))
        {
            // $name   = explode('.', ($data['attachment']->getClientOriginalName() ))[0];;
            // $ext    =  $data['attachment']->getClientOriginalExtension();
            // $imageName = $name.'_'.time().'.'.$ext;
            // $data['attachment']->move(public_path().'/images/marketplace/material/', $imageName);  

            $document = $request->file('attachment');
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $materialPost->attachment = $imageName;

        }

        if($request->hasfile('featured_image'))
        {
            // $name   = explode('.', ($data['featured_image']->getClientOriginalName() ))[0];;
            // $ext    =  $data['featured_image']->getClientOriginalExtension();
            // $imageName = $name.'_'.time().'.'.$ext;
            // $data['featured_image']->move(public_path().'/images/marketplace/material/', $imageName);  
            #$imgsizes = $request->file('featured_image')->getSize(); 

            $document = $request->file('featured_image');
            $size = $document->getSize();
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $materialPost->featured_image = $imageName;

        }
        if($request->hasfile('slider_image'))
         {
            $sliderImages = [];
            foreach($request->file('slider_image') as $image)
            {
                $size = $image->getSize();
                // $name   = explode('.', ($image->getClientOriginalName() ))[0];
                // $ext    =  $image->getClientOriginalExtension();
                 $imageName  = time()."_".$image->getClientOriginalName();
                $image->move(public_path().'/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }
            if(!empty($sliderImages)){
                $materialPost->slider_images = json_encode($sliderImages);
            }
            
         }

         $materialPost->save();

        return redirect()->route('admin.marketplace.MaterialRequests')->withFlashSuccess('The material request was successfully created.');
    }

    /**
     * @param Request $request
    * @param Property  $property
     *
     * @return mixed
     */
    public function show(Request $request,$materialId)
    {
        $materialData = $this->getMaterial($materialId);
        return view('backend.marketplace.material.show')
            ->withMaterial($materialData);
    }

    public function getMaterial($materialId)
    {
        return MaterialPost::where('id',$materialId)->with('category')->first();
    }

    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$materialId)
    {
        $materialData = $this->getMaterial($materialId);
        $categories = MaterialCategory::pluck('name','mc_id');
        return view('backend.marketplace.material.request-edit')
            ->withMaterial($materialData)->withCategories($categories);;
    }

    /**
     * @param Request $request
     * @param propertyId              $propertyId
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $materialId)
    {
        $data = $request->all();
        
         $validator = Validator::make($data, [
            'title'     => ['required','max:150'],
            'category' => 'required',
            'description'   => 'required',
            'quantity'    => 'required|numeric',
            'unit'   => 'required',
            'city'      => 'required',
            'pincode'     => 'required',
            'post_expiry_days'  => 'required|numeric',
            'post_expiry_hour'  => 'numeric',
            'attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ])->validate();
        
        $materialPost = $this->getMaterial($materialId);

        $materialPost->title     =  $data['title'];
        $materialPost->categoryId =  $data['category'];
        // $property->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $materialPost->description  =  $data['description'];
        $materialPost->quantity   =  $data['quantity'];
        $materialPost->unit   =  $data['unit'];
        $materialPost->city   =  $data['city'];
        $materialPost->pincode   =  $data['pincode'];
        $materialPost->post_type   =  'Request';
        $expDays = $data['post_expiry_days'];

        if(empty($data['post_expiry_hour']) || $data['post_expiry_hour'] == 0){
            $expDays = $data['post_expiry_days']-1;
        }
        $addtime = "+$expDays day";
        if(!empty($data['post_expiry_hour'])){
            $addtime .= '+'.$data['post_expiry_hour'].' hour';
        }
        $materialPost->post_expiry_date  =  date('Y-m-d H:i:s',strtotime($addtime));
        
        if($request->hasfile('attachment'))
        {
            $document = $request->file('attachment');
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $materialPost->attachment = $imageName;

        }

        if($request->hasfile('featured_image'))
        {

            $document = $request->file('featured_image');
            $size = $document->getSize();
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $materialPost->featured_image = $imageName;

        }
        if($request->hasfile('slider_image'))
         {
            $sliderImages = json_decode($materialPost->slider_images);
            foreach($request->file('slider_image') as $image)
            {
                $size = $image->getSize();
                $imageName  = time()."_".$image->getClientOriginalName();
                $image->move(public_path().'/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }

            if(!empty($sliderImages)){
                $materialPost->slider_images = json_encode($sliderImages);
            }
            
         }

         $materialPost->save();

        return redirect()->route('admin.marketplace.MaterialRequests')->withFlashSuccess('The material request was successfully updated.');
    }

    /**
     * @param Request $request
     * @param materialId $materialId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($materialId)
    {
        $post = MaterialPost::where('id',$materialId)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.marketplace.MaterialRequests')->withFlashSuccess(__('The material request has been deleted successfully.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Property              $property
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete($propertyId)
    {
        $post = Property::where('id',$propertyId)->onlyTrashed()->first();
        if ($post != null) {
            $propertyImages = PropertyImage::where('property_id',$propertyId)->forceDelete();
            $post->forceDelete();
            return redirect()->route('admin.property.deleted')->withFlashSuccess(__('The property has been permanently deleted successfully.'));
        }
        return redirect()->back();

    }

    public function deleteimage($materialId, $imgKey)
    {
        $materialPost = MaterialPost::where('id',$materialId)->first();
        if ($materialPost != null) {
            $images = json_decode($materialPost->slider_images);
            if(!empty($images)){
                unset($images[$imgKey]);
            }
            $images = array_values($images);
            $materialPost->slider_images = json_encode($images);
            $materialPost->save();
            return redirect()->back()->withFlashSuccess(__('The slider image has been deleted successfully.'));
        }
        return redirect()->back()->withFlashSuccess(__('The material request does not exist.'));

    }

	
	public function bidListing($id)
	{		
		$workBid = MaterialBid::Where('material_post_id',$id)->paginate(10);		
		$bid_type = 'request';	
		$materialData = MaterialPost::select('unit')->where('id',$id)->first();
		
		return view('backend.marketplace.material.bids')->with(['workBid'=>$workBid,'bid_type'=>$bid_type,'materialData'=>$materialData]);	
	}
	
	public function bidDetail($id,$bidId)
	{
		$workData = MaterialBid::where('id',$id)->first();
		$bid_type = 'request';	
		$materialData = MaterialPost::select('unit')->where('id',$bidId)->first();
		return view('backend.marketplace.material.bid-detail')->with(['workData'=>$workData,'materialData'=>$materialData,'bid_type'=>$bid_type]);	
	}

}
