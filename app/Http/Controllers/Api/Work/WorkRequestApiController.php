<?php

namespace App\Http\Controllers\Api\Work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\Models\Marketplace\ProTender;
use Validator;

class WorkRequestApiController extends Controller
{

    protected function list()
    {
        dd('s');
    }

    public function forRequest(Request $request, ProTender $materialPost)
    {
        if(strpos($request->path(), 'request') !== false){
            return $this->store($request, $materialPost, 'Request');
        }
        if(strpos($request->path(), 'offers') !== false){
            return $this->store($request, $materialPost, 'Offer');
        }   
    }

    protected function store($request, $materialPost, $type)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title'     => ['required','max:150'],
            'categoryId' => 'required',
            'description'   => 'required',
            'budget'    => 'required',
            'available_from'   => 'required|date_format:Y-m-d',
            'available_to'   => 'required|date_format:Y-m-d',
            'city'      => 'required',
            'pincode'     => 'required',
            'post_expiry_date'  => 'required',
            'attachment'=>'mimes:doc,docx,pdf,zip|max:2048',
            'featured_image' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image' => 'required',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $materialPost->tender_user_id     =  Auth::user()->id;
        $materialPost->tender_title     =  $data['title'];
        $materialPost->tender_category_id =  $data['categoryId'];
        $materialPost->tender_description  =  $data['description'];
        // $materialPost->tender_quantity   =  $data['quantity'];
        // $materialPost->tender_unit   =  $data['unit'];
        $materialPost->tender_budget   =  $data['budget'];
        $rate = (!empty($data['rate'])) ? $data['rate'] : 0 ;
        $materialPost->tender_rate   =  $rate;
        $materialPost->tender_available_from   =  $data['available_from'];
        $materialPost->tender_available_to   =  $data['available_to'];
        $materialPost->tender_city   =  $data['city'];
        $materialPost->tender_pincode   =  $data['pincode'];
        $materialPost->extra   =  $data['extra'];
        $materialPost->tender_expiry_date   =  $data['post_expiry_date'];
        $materialPost->tender_type   =  $type;
        $materialPost->tender_category_type   =  'Work';

        if($request->hasfile('attachment'))
        {
            $document = $request->file('attachment');
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $materialPost->tender_attachment = $imageName;

        }
        if($request->hasfile('featured_image'))
        {
            $document = $request->file('featured_image');
            $size = $document->getSize();
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/marketplace/material/', $imageName);
            
            $materialPost->tender_featured_image = $imageName;

        }
        if($request->hasfile('slider_image'))
         {
            $sliderImages = [];
            foreach($request->file('slider_image') as $image)
            {
                $size = $image->getSize();
                 $imageName  = time()."_".$image->getClientOriginalName();
                $image->move(public_path().'/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }
            if(!empty($sliderImages)){
                
                $materialPost->tender_slider_images = json_encode($sliderImages);
            }
            
         }

         $materialPost->save();

         return response()->json($materialPost, 201);

    }

    protected function storeOffer(Request $request, ProTender $materialPost)
    {
        // dd('s');
        $this->store($request,$materialPost);
    }
}


?>