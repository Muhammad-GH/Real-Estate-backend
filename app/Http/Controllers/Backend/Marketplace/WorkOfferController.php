<?php 
namespace App\Http\Controllers\Backend\Marketplace;
use App\Http\Controllers\Controller;
use App\Models\Marketplace\WorkBid;
use App\Models\Marketplace\WorkPost;
use App\Models\Marketplace\WorkCategories;
use App\Models\City;
use Illuminate\Http\Request;
use Validator;

Class WorkOfferController extends Controller{
	public function index(){
		$workoffer = WorkPost::Where('post_type','Offer')->whereDate('post_expiry_date', '>=', date('Y-m-d H:i:s'))->paginate(10);
		#print_r($workoffer); die;
		return view('backend.marketplace.work-offer')->with(['workoffer'=>$workoffer]);
	}
	
	public function addworkoffer(Request $request){
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

				'featured_image' => 'required',

				'slider_image' => 'required'

				

			])->validate();
			
			#print_r($request->all()); die;
			$workPost = new WorkPost();
			$workPost->title = $request->title;
			$workPost->categoryId = $request->categoryId;
			$workPost->description = $request->description;
			#$workPost->rate = $request->rate;
			$workPost->budget = $request->budget;
			$workPost->available_from = $request->available_from;
			$workPost->available_to = $request->available_to;
			$workPost->city = $request->city;
			$workPost->pincode = $request->pincode;
			#$workPost->post_expiry_date = $request->post_expiry_date;
			
			$expDays = $request->post_expiry_days;

			$expiry_hour = $request->post_expiry_hour?$request->post_expiry_hour:0;



			if(empty($request->post_expiry_hour) || $request->post_expiry_hour == 0){

				$expDays = $request->post_expiry_days-1;

			}

			

			$workPost->post_expiry_date  =  date('Y-m-d H:i:s',strtotime("+$expDays day +$expiry_hour hour"));
			
			$workPost->post_type = $request->post_type;
			if($request->hasfile('attachment'))
			{
				$file = $request->file('attachment');
				if(isset($file)){
					$name   = explode('.', ($file->getClientOriginalName() ))[0];;
					$ext    =  $file->getClientOriginalExtension();
					$imageName = $name.'_'.time().'.'.$ext;
					$file->move(public_path().'/images/marketplace/work/', $imageName); 
					$workPost->attachment = $imageName;
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
					$workPost->featured_image = $imageNameF;
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
				$workPost->slider_images = implode(",",$slideImage);
			}
			$workPost->save();
			return redirect()->route('admin.marketplace.index')->withFlashSuccess('The Work Office data has been successfully created.');
		}
		return view('backend.marketplace.add-work-offer')->with(['cities'=>$cities,'categories'=>$categories]);
	}
	
	function editworkoffer(Request $request){
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
			#$workDataU->rate = $request->rate;
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
			return redirect()->route('admin.marketplace.index')->withFlashSuccess('The Work Office data has been successfully updated.');
		}
		$workData = WorkPost::where('id',$request->id)->first();
		#print_r($workData); die;
		return view('backend.marketplace.edit-work-offer')->with(['cities'=>$cities,'categories'=>$categories,'workData'=>$workData]);
	}
	
	function viewworkoffer(Request $request){
		$workData = WorkPost::where('id',$request->id)->first();
		$workDataCat = WorkCategories::where('wc_id',$workData->categoryId)->first();
		#print_r($workDataCat);die;
		return view('backend.marketplace.view-work-offer')->with(['workData'=>$workData,'workDataCat'=>$workDataCat]);
	}
	
	public function deleteworkoffer($id)
    {
        $post = WorkPost::where('id',$id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.marketplace.index')->withFlashSuccess(__('The Office data has been deleted successfully.'));
        }
        return redirect()->back();
    }
	
	public function bidListing($id){
		$workBid = WorkBid::Where('work_post_id',$id)->paginate(10);
		$bid_type = 'offer';
		return view('backend.marketplace.work.bids')->with(['workBid'=>$workBid,'bid_type'=>$bid_type]);
	}
	
	function bidDetail($id,$bidId){
		$workBid = WorkBid::where('id',$id)->first();
		$bid_type = 'offer';
		return view('backend.marketplace.work.bid-detail')->with(['workBid'=>$workBid,'bid_type'=>$bid_type]);
	}
} 
?>