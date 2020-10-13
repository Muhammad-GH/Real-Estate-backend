<?php 
namespace App\Http\Controllers\Backend\Marketplace;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\WorkOffer;
use App\Models\Marketplace\WorkBid;
use App\Models\City;
use App\Models\Marketplace\WorkCategories;
use App\Models\Marketplace\WorkPost;
use Illuminate\Http\Request;
use Validator;
Class WorkRequestController extends Controller{
	public function index(){
		$workRequest = WorkPost::Where('post_type','Request')->whereDate('post_expiry_date', '>=', date('Y-m-d H:i:s'))->paginate(10);
		return view('backend.marketplace.work-requests')->with(['workRequests'=>$workRequest]);
	}
	
	public function addWorkRequest(Request $request){
		$cities = City::all();
		$categories = WorkCategories::all(['wc_id','name']);
		if($request->isMethod('post')){
			$data = $request->all();
			
			$validator = Validator::make($data, [

				'title'     => ['required','max:150'],

				'description'   => 'required',

				'budget'    => 'required',

				'available_from'   => 'required',
				
				'available_to'   => 'required',

				'city'      => 'required',

				'pincode'     => 'required',

				'post_expiry_days'  => 'required|numeric',

				'post_expiry_hour'  => 'required|numeric',

				'attachment' =>  'required',

				'featured_image' => 'required',

				'slider_image' => 'required'

				

			])->validate();
			
			$workRequest = new WorkPost();
			$workRequest->title = $request->title;
			$workRequest->categoryId = $request->categoryId;
			$workRequest->description = $request->description;
			$workRequest->rate = $request->rate;
			$workRequest->budget = $request->budget;
			$workRequest->available_from = $request->available_from;
			$workRequest->available_to = $request->available_to;
			$workRequest->city = $request->city;
			$workRequest->pincode = $request->pincode;
			#$workRequest->post_expiry_date = $request->post_expiry_date;
			
			$expDays = $request->post_expiry_days;

			$expiry_hour = $request->post_expiry_hour?$request->post_expiry_hour:0;



			if(empty($request->post_expiry_hour) || $request->post_expiry_hour == 0){

				$expDays = $request->post_expiry_days-1;

			}

			

			$workRequest->post_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
			
			$workRequest->post_type = $request->post_type;
			if($request->hasfile('attachment'))
			{
				$file = $request->file('attachment');
				if(isset($file)){
					$name   = explode('.', ($file->getClientOriginalName() ))[0];;
					$ext    =  $file->getClientOriginalExtension();
					$imageName = $name.'_'.time().'.'.$ext;
					$file->move(public_path().'/images/marketplace/work/', $imageName); 
					$workRequest->attachment = $imageName;
				}
			}
			if($request->hasfile('featured_image'))
			{
				$fileF = $request->file('featured_image');
				if(isset($fileF)){
					$nameF   = explode('.', ($fileF->getClientOriginalName() ))[0];;
					$extF    =  $fileF->getClientOriginalExtension();
					$imageNameF = $nameF.'_'.time().'.'.$extF;
					$fileF->move(public_path().'/images/marketplace/work/', $imageNameF); 
					$workRequest->featured_image = $imageNameF;
				}
			}
			
			if($request->hasfile('slider_image'))
			{
				$slideImage = [];
				foreach($request->file('slider_image') as $key => $image)
				{
					$nameS   = explode('.', ($image->getClientOriginalName() ))[0];;
					$extS    =  $image->getClientOriginalExtension();
					$imageNameS = $nameS.'_'.time().'.'.$extS;
					$image->move(public_path().'/images/marketplace/work/', $imageNameS); 
					$slideImage[$key] = $imageNameS;
				}
				$workRequest->slider_images = implode(",",$slideImage);
			}
			$workRequest->save();
			return redirect()->route('admin.marketplace.WorkRequests')->withFlashSuccess('Work request has been successfully created.');
			
		}
		return view('backend.marketplace.add-work-request')->with(['cities'=>$cities, 'categories'=>$categories]);
	}
	
	function editWorkRequest(Request $request){
		$cities = City::all();
		$categories = WorkCategories::all(['wc_id','name']);
		if($request->isMethod('post')){
			$data = $request->all();
			
			$validator = Validator::make($data, [

				'title'     => ['required','max:150'],

				'description'   => 'required',

				'budget'    => 'required',

				'available_from'   => 'required',
				
				'available_to'   => 'required',

				'city'      => 'required',

				'pincode'     => 'required',

				'post_expiry_days'  => 'required|numeric',

				'post_expiry_hour'  => 'required|numeric'

				

			])->validate();
			
			$workDataU = WorkPost::where('id',$request->offcId)->first();
			#print_r($workDataU); die;
			$workDataU->title = $request->title;
			$workDataU->categoryId = $request->categoryId;
			$workDataU->description = $request->description;
			$workDataU->rate = $request->rate;
			$workDataU->budget = $request->budget;
			$workDataU->available_from = $request->available_from;
			$workDataU->available_to = $request->available_to;
			$workDataU->city = $request->city;
			$workDataU->pincode = $request->pincode;
			#$workDataU->post_expiry_date = $request->post_expiry_date;
			$expDays = $request->post_expiry_days;

			$expiry_hour = $request->post_expiry_hour?$request->post_expiry_hour:0;



			if(empty($request->post_expiry_hour) || $request->post_expiry_hour == 0){

				$expDays = $request->post_expiry_days-1;

			}

			

			$workDataU->post_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
			
			$workDataU->post_type = $request->post_type;
			if($request->hasfile('attachment'))
			{
				$file = $request->file('attachment');
				if(isset($file)){
					$name   = explode('.', ($file->getClientOriginalName() ))[0];;
					$ext    =  $file->getClientOriginalExtension();
					$imageName = $name.'_'.time().'.'.$ext;
					$file->move(public_path().'/images/marketplace/work/', $imageName); 
					$workDataU->attachment = $imageName;
				}
			}
			if($request->hasfile('featured_image'))
			{
				$fileF = $request->file('featured_image');
				if(isset($fileF)){
					$nameF   = explode('.', ($fileF->getClientOriginalName() ))[0];;
					$extF    =  $fileF->getClientOriginalExtension();
					$imageNameF = $nameF.'_'.time().'.'.$extF;
					$fileF->move(public_path().'/images/marketplace/work/', $imageNameF); 
					$workDataU->featured_image = $imageNameF;
				}
			}
			if($request->hasfile('slider_image'))
			{
				$slideImage = [];
				foreach($request->file('slider_image') as $key => $image)
				{
					$nameS   = explode('.', ($image->getClientOriginalName() ))[0];;
					$extS    =  $image->getClientOriginalExtension();
					$imageNameS = $nameS.'_'.time().'.'.$extS;
					$image->move(public_path().'/images/marketplace/work/', $imageNameS); 
					$slideImage[$key] = $imageNameS;
				}
				$newArryComb = array_merge($request->old_slider_images,$slideImage);
				$workDataU->slider_images = implode(",",$newArryComb);
			}else{
				$workDataU->slider_images = implode(",",$request->old_slider_images);
			}
			$workDataU->save();
			return redirect()->route('admin.marketplace.WorkRequests')->withFlashSuccess('The Work Request data has been successfully updated.');
		}
		$workData = WorkPost::where('id',$request->id)->first();
		#print_r($workData); die;
		return view('backend.marketplace.edit-work-request')->with(['cities'=>$cities,'categories'=>$categories,'workData'=>$workData]);
	}
	
	function viewWorkRequest(Request $request){
		$workData = WorkPost::where('id',$request->id)->first();
		$workDataCat = WorkCategories::where('wc_id',$workData->categoryId)->first();
		#print_r($workDataCat);die;
		return view('backend.marketplace.view-work-request')->with(['workData'=>$workData,'workDataCat'=>$workDataCat]);
	}
	
	public function deleteWorkRequest($id)
    {
        $post = WorkPost::where('id',$id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.marketplace.WorkRequests')->withFlashSuccess(__('The Office Request has been deleted successfully.'));
        }
        return redirect()->back();
    }
	
	public function bidListing($id){
		$workBid = WorkBid::Where('work_post_id',$id)->paginate(10);
		$bid_type = 'request';
		#print_r($workBid); die;
		return view('backend.marketplace.work.bids')->with(['workBid'=>$workBid,'bid_type'=>$bid_type]);
	}
	
	function bidDetail($id,$bidId){
		$workBid = WorkBid::where('id',$id)->first();
		$bid_type = 'request';
		return view('backend.marketplace.work.bid-detail')->with(['workBid'=>$workBid,'bid_type'=>$bid_type]);
	}
} 
?>