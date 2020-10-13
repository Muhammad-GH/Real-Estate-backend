<?php

namespace App\Http\Controllers\Frontend\Buying;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Session;
use Validator;
use Alert;

/**
 * Class BuyingController.
 */
class BuyingController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Property::with('primaryImage','propertyImage');
        $searchData = [];
        if($request->isMethod("POST") ){
            $searchData = $request->all();
            unset($searchData['_token']);
            // Session::put('searchData', $searchData);
        }
        // if($request->get('page') && Session::has('searchData')){
        //     $searchData = Session::get('searchData');
        // }
        if(!empty($searchData)){  
            
            if(isset($searchData['keyword']) && !empty($searchData['keyword']) ){
                $term  = $searchData['keyword'];
                $query->where(function ($q) use($term) {
                    $q->where('title', 'LIKE', '%'.$term.'%');
                    $q->orWhere('name', 'LIKE', '%'.$term.'%');
                    $q->orWhere('details', 'LIKE', '%'.$term.'%');
                    $q->orWhere('area', 'LIKE', '%'.$term.'%');
                    $q->orWhere('address', 'LIKE', '%'.$term.'%');
                    // $q->orWhere('details', 'LIKE', '%'.$term.'%');
                });
            }
            // if($searchData['filter'] == 1){
                if(isset($searchData['city']) && !empty($searchData['city']) ){
                    $city = $searchData['city'];
                    $query->where(function ($q) use($city) {
                        $q->where('address', 'LIKE', '%'.$city.'%');
                        $q->orWhere('area', 'LIKE', '%'.$city.'%');
                    });
                }
                if(isset($searchData['appartment_type']) && !empty($searchData['appartment_type']) ){
                    $query->where('appartment_type', 'LIKE', '%'.$searchData['appartment_type'].'%');
                }
                if(isset($searchData['min']) && !empty($searchData['min']) ){
                    // print_r($searchData);
                    // die;
                    $query->where('price', '>=', $searchData['min']);
                    $query->where('price', '<=',  $searchData['max']);
                }
            // }
            // Session::put('searchData', $searchData);
        }
        $properties = $query->orderBy('id', 'asc')->paginate(6);
        
        return view('frontend.buying.index')
                ->withProperties($properties)
                ->withSearchData($searchData);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function view($id,Request $request)
    {
        $property = Property::with('primaryImage','propertyImage')->where('slug',$id)->first();
        
        return view('frontend.buying.view')
                ->withProperty($property);
                // ->withSearchData($searchData);
    }
    
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store_contact(Request $request, Property $property, ContactUs $contactus)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'      => 'required',
            'phone'   => 'required|numeric',
            'email'      => 'required|email',
            'subject'   => 'required',
            'message'      => 'required',
            'property_id'     => 'required',
        ])->validate();
        
        $contactus->name     =  $data['name'];
        $contactus->phone      =  $data['phone'];
        $contactus->email   =  $data['email'];
        $contactus->subject   =  $data['subject'];
        $contactus->message   =  $data['message'];
        $contactus->property_id   =  $data['property_id'];
        if(isset($data['user_id']) && !empty($data['user_id'])){
            $contactus->user_id   =  $data['user_id'];
        }
        
        $proj = $contactus->save();

        Alert::success('menestys', '
Kiitos yhteystietojen jakamisesta');
        return redirect()->back()->withFlashSuccess(__('
Kiitos yhteystietojen jakamisesta.'));

    }
}
