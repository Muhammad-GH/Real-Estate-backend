<?php

namespace App\Http\Controllers\Api\Material;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Marketplace\ProTender;
use App\Models\Marketplace\ProBid;
use Validator;
use DB;

class MaterialRequestApiController extends Controller
{

    protected function list(Request $request)
    {
        if (strpos($request->path(), 'material') !== false) {
            $data = ProTender::where([['tender_user_id', Auth::user()->id], ['tender_category_type', 'Material']])->get();
            foreach ($data as $key => $value) {
                $bid = ProBid::where('tb_tender_id', $value->tender_id)->get();
                $data[$key]->quote = $bid->max('tb_quote');
            }
            return response()->json(["role" => auth()->user()->roles_label, "data" => $data], 200);
        }
        if (strpos($request->path(), 'work') !== false) {
            $data = ProTender::where([['tender_user_id', Auth::user()->id], ['tender_category_type', 'Work']])->get();
            foreach ($data as $key => $value) {
                $bid = ProBid::where('tb_tender_id', $value->tender_id)->get();
                $data[$key]->quote = $bid->max('tb_quote');
            }
            return response()->json(["role" => auth()->user()->roles_label, "data" => $data], 200);
        }
    }

    protected function store(Request $request, ProTender $materialPost)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title'     => ['required', 'max:150'],
            'categoryId' => 'required',
            'description'   => 'required',
            'quantity'    => 'required|numeric',
            'unit'   => 'required',
            'city'      => 'required',
            'pincode'     => 'required',
            'post_expiry_date'  => 'required',
            'attachment' => 'mimes:doc,docx,pdf,zip|max:2048',
            'featured_image' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image' => 'required',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $materialPost->tender_user_id     =  Auth::user()->id;
        $materialPost->tender_title     =  $data['title'];
        $materialPost->tender_category_id =  $data['categoryId'];
        $materialPost->tender_description  =  $data['description'];
        $materialPost->tender_quantity   =  $data['quantity'];
        $materialPost->tender_unit   =  $data['unit'];
        $materialPost->tender_city   =  $data['city'];
        $materialPost->tender_pincode   =  $data['pincode'];
        $materialPost->extra   =  $data['extra'];
        $materialPost->tender_expiry_date   =  $data['post_expiry_date'];
        $materialPost->tender_type   =  'Request';
        $materialPost->tender_category_type   =  'Material';

        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/material/', $imageName);

            $materialPost->tender_attachment = $imageName;
        }
        if ($request->hasfile('featured_image')) {
            $document = $request->file('featured_image');
            $size = $document->getSize();
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/material/', $imageName);

            $materialPost->tender_featured_image = $imageName;
        }
        if ($request->hasfile('slider_image')) {
            $sliderImages = [];
            foreach ($request->file('slider_image') as $image) {
                $size = $image->getSize();
                $imageName  = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path() . '/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }
            if (!empty($sliderImages)) {

                $materialPost->tender_slider_images = json_encode($sliderImages);
            }
        }

        $materialPost->save();

        return response()->json($materialPost, 201);
    }

    protected function storeOffer(Request $request, ProTender $materialPost)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title'     => ['required', 'max:150'],
            'categoryId' => 'required',
            'description'   => 'required',
            'quantity'    => 'required|numeric',
            'cost_per_unit'    => 'required|numeric',
            'unit'   => 'required',
            'city'      => 'required',
            'pincode'     => 'required',
            'warranty'    => 'required|numeric',
            // 'warranty_type'     => 'required',
            'delivery_type'    => 'required',
            'delivery_cost*'    => 'required|numeric',
            'post_expiry_date'  => 'required',
            'attachment' => 'mimes:doc,docx,pdf,zip|max:2048',
            'featured_image' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image' => 'required',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $materialPost->tender_user_id     =  Auth::user()->id;
        $materialPost->tender_title     =  $data['title'];
        $materialPost->tender_category_id =  $data['categoryId'];
        $materialPost->tender_description  =  $data['description'];
        $materialPost->tender_quantity   =  $data['quantity'];
        $materialPost->tender_cost_per_unit   =  $data['cost_per_unit'];
        $materialPost->tender_unit   =  $data['unit'];
        $materialPost->tender_city   =  $data['city'];
        $materialPost->tender_pincode   =  $data['pincode'];
        $materialPost->extra   =  $data['extra'];
        $materialPost->tender_warranty   =  $data['warranty'];
        // $materialPost->tender_warranty_type   =  $data['warranty_type'];
        $materialPost->tender_expiry_date   =  $data['post_expiry_date'];
        $materialPost->tender_type   =  'Offer';
        $materialPost->tender_category_type   =  'Material';

        $deliverytype_cost = [];
        foreach ($data['delivery_type'] as $key => $value) {
            $deliverytype_cost[$value] = $data['delivery_cost'][$key];
        }
        if (!empty($deliverytype_cost)) {
            $materialPost->tender_delivery_type_cost = json_encode($deliverytype_cost);
        }

        if ($request->hasfile('attachment')) {
            $document = $request->file('attachment');
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/material/', $imageName);

            $materialPost->tender_attachment = $imageName;
        }
        if ($request->hasfile('featured_image')) {
            $document = $request->file('featured_image');
            $size = $document->getSize();
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/material/', $imageName);

            $materialPost->tender_featured_image = $imageName;
        }
        if ($request->hasfile('slider_image')) {
            $sliderImages = [];
            foreach ($request->file('slider_image') as $image) {
                $size = $image->getSize();
                $imageName  = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path() . '/images/marketplace/material/', $imageName);

                $sliderImages[] = $imageName;
            }
            if (!empty($sliderImages)) {

                $materialPost->tender_slider_images = json_encode($sliderImages);
            }
        }

        $materialPost->save();

        return response()->json($materialPost, 201);
    }


    protected function offerDetails($id)
    {
        // Show a specific record
        $tender = DB::select('select * from pro_tender where tender_id = :tender_id', ['tender_id' => $id]);
        $city = DB::table('pro_cities')->where('city_id', $tender[0]->tender_city)->first();
        $tender[0]->tender_city = $city->city_identifier;
        $tender[0]->tender_delivery_type_cost = json_decode($tender[0]->tender_delivery_type_cost);
        $tender[0]->tender_slider_images = str_replace(array('[', ']'), '',  $tender[0]->tender_slider_images);
        $tender[0]->tender_slider_images = explode('"', $tender[0]->tender_slider_images);
        unset($tender[0]->tender_slider_images[0], $tender[0]->tender_slider_images[2], $tender[0]->tender_slider_images[4], $tender[0]->tender_slider_images[6], $tender[0]->tender_slider_images[8]);
        $tender[0]->tender_expiry_date = mb_substr($tender[0]->tender_expiry_date, 0, 24);
        $category = DB::table('pro_category')->where('category_id', $tender[0]->tender_category_id)->first();
        $tender[0]->category = $category->category_name;
        $retVal = (empty($tender)) ?
            response()->json(['Record Not Found'], 404) :
            response()->json($tender, 200);

        return $retVal;
    }

    protected function offerRemove($id)
    {
        // Deleting specific record
        $fill =  ProTender::where('tender_id', $id);

        $retVal = (is_null($fill)) ?
            response()->json('Record not found', 404) : [$fill->delete()];

        return $retVal;
    }
}
