<?php

namespace App\Http\Controllers\Backend\Request;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\ContactUs;
use App\Models\ContactForm;




/**
 * Class RequestController.
 */
class RequestController extends Controller
{
    
    /**
     * RequestController constructor.
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
        $requestData = ContactForm::where('type','contact')->orderBy('id', 'desc')->paginate(10);
        return view('backend.request.contact')
            ->withRequestData($requestData);
    }


    public function contact_view(Request $request,$id){
        $requestData = ContactForm::where('id', $id)->first();
        ContactForm::where('id',$id)->update(['viewed' => 1]);
        return view('backend.request.contactview')
            ->withRequestData($requestData);
    }

    public function classified(Request $request)
    {
        $requestData = ContactForm::where('type','potential')->orderBy('id', 'desc')->paginate(10);
        return view('backend.request.classified')
            ->withRequestData($requestData);
    }


    public function classified_view(Request $request,$id){
        $requestData = ContactForm::where('id', $id)->first();
        ContactForm::where('id',$id)->update(['viewed' => 1]);
        return view('backend.request.classifiedview')
            ->withRequestData($requestData);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeleted(Request $request)
    {
        return view('backend.property.deleted')
            ->withProperties($this->propertyRepository->getDeletedPaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $cites = City::pluck('name','id');
        return view('backend.property.create')
            ->withCites($cites);

            // ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            // ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Property $property)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'title'     => ['required','max:150', Rule::unique('property')],
            'name'      => ['required'],
            'appartment_type'      => 'required',
            'details'   => 'required',
            'area'      => 'required',
            'address'   => 'required',
            'size'      => 'required',
            'rooms'     => 'required',
            'debt_free_price'     => 'required|numeric',
            'price'     => 'required|numeric',
            'manager_name'  => 'required',
            'address'       => 'required',
            'built_year'        => 'required|numeric',
            'apartment_no'      => 'required|numeric',
            'planned_renovation'    => 'required|numeric',
            'done_renovation'           => 'required|numeric',
            'land_ownership'            => 'required',
            'land_area'                 => 'required',
            'heating_method'            => 'required',
            'month_appartment_cost'     => 'required|numeric',
            'month_appartment_capital'  => 'required|numeric',
            'water_cost'                => 'required|numeric',
            'other_appartment_cost'     => 'required|numeric',
            'property_primary_image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'property_image' => 'required',
            'property_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();
        
        $property->title     =  $data['title'];
        $property->name      =  $data['name'];
        $property->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $property->appartment_type      =  $data['appartment_type'];
        $property->details   =  $data['details'];
        $property->area   =  $data['area'];
        $property->address   =  $data['address'];
        $property->size   =  $data['size'];
        $property->rooms   =  $data['rooms'];
        $property->price   =  $data['price'];
        $property->debt_free_price   =  $data['debt_free_price'];
        $property->manager_name   =  $data['manager_name'];
        $property->address   =  $data['address'];
        $property->built_year   =  $data['built_year'];
        $property->apartment_no   =  $data['apartment_no'];
        $property->planned_renovation   =  200;
        $property->done_renovation   =  200;
        $property->land_ownership   =  $data['land_ownership'];
        $property->land_area   =  $data['land_area'];
        $property->heating_method   =  $data['heating_method'];
        $property->month_appartment_cost   =  $data['month_appartment_cost'];
        $property->month_appartment_capital   =  $data['month_appartment_capital'];
        $property->water_cost   =  $data['water_cost'];
        $property->other_appartment_cost   =  $data['other_appartment_cost'];
            
        $proj = $property->save();
        $propertyId = $property->id;
        if($request->hasfile('property_primary_image'))
        {
            $name   = explode('.', ($data['property_primary_image']->getClientOriginalName() ))[0];;
            $ext    =  $data['property_primary_image']->getClientOriginalExtension();
            $imageName = $name.'_'.time().'.'.$ext;
            $data['property_primary_image']->move(public_path().'/images/property/'.$propertyId.'/', $imageName);  
            
            $propertyImage= new PropertyImage();
            $propertyImage->property_id	= $propertyId;
            $propertyImage->name    = $imageName;	
            $propertyImage->type    = $ext;
            $propertyImage->primary = 1;
            $propertyImage->save();
        }
        if($request->hasfile('property_image'))
         {

            foreach($request->file('property_image') as $image)
            {
                $name   = explode('.', ($image->getClientOriginalName() ))[0];;
                $ext    =  $image->getClientOriginalExtension();
                $imageName = $name.'_'.time().'.'.$ext;
                $image->move(public_path().'/images/property/'.$propertyId.'/', $imageName);  
                
                $propertyImage= new PropertyImage();
                $propertyImage->property_id	= $propertyId;
                $propertyImage->name    = $imageName;	
                $propertyImage->type    = $ext;
                $propertyImage->primary = 0;
                $propertyImage->save();
            }
         }

        return redirect()->route('admin.property.index')->withFlashSuccess('The property was successfully created.');
    }

    /**
     * @param Request $request
    * @param Property  $property
     *
     * @return mixed
     */
    public function show(Request $request,$propertyId)
    {
        $propertyData = $this->getProperty($propertyId);
        return view('backend.property.show')
            ->withProperty($propertyData);
    }

    public function getProperty($propertyId)
    {
        return Property::where('id',$propertyId)->with('primaryImage','propertyImage')->first();
    }

    /**
     * @param Request    $request
     *
     * @return mixed
     */
    public function edit(Request $request,$propertyId)
    {
        $propertyData = $this->getProperty($propertyId);
        return view('backend.property.edit')
            ->withProperty($propertyData);
    }

    /**
     * @param Request $request
     * @param propertyId              $propertyId
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $propertyId)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'title'     => ['required','max:150',Rule::unique('property')->ignore($propertyId)],
            'name'      => ['required'],
            'appartment_type'      => 'required',
            'details'   => 'required',
            'area'      => 'required',
            'address'   => 'required',
            'size'      => 'required',
            'rooms'     => 'required',
            'debt_free_price'     => 'required|numeric',
            'price'     => 'required|numeric',
            'manager_name'  => 'required',
            'address'       => 'required',
            'built_year'        => 'required|numeric',
            'apartment_no'      => 'required|numeric',
            'planned_renovation'    => 'required|numeric',
            'done_renovation'           => 'required|numeric',
            'land_ownership'            => 'required',
            'land_area'                 => 'required',
            'heating_method'            => 'required',
            'month_appartment_cost'     => 'required|numeric',
            'month_appartment_capital'  => 'required|numeric',
            'water_cost'                => 'required|numeric',
            'other_appartment_cost'     => 'required|numeric',
            'property_primary_image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'property_image' => 'required',
            'property_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();
        
        $property = $this->getProperty($propertyId);
        $property->title     =  $data['title'];
        $property->name      =  $data['name'];
        $property->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $property->appartment_type      =  $data['appartment_type'];
        $property->details   =  $data['details'];
        $property->area   =  $data['area'];
        $property->address   =  $data['address'];
        $property->size   =  $data['size'];
        $property->rooms   =  $data['rooms'];
        $property->price   =  $data['price'];
        $property->debt_free_price   =  $data['debt_free_price'];
        $property->manager_name   =  $data['manager_name'];
        $property->address   =  $data['address'];
        $property->built_year   =  $data['built_year'];
        $property->apartment_no   =  $data['apartment_no'];
        $property->planned_renovation   =  200;
        $property->done_renovation   =  200;
        $property->land_ownership   =  $data['land_ownership'];
        $property->land_area   =  $data['land_area'];
        $property->heating_method   =  $data['heating_method'];
        $property->month_appartment_cost   =  $data['month_appartment_cost'];
        $property->month_appartment_capital   =  $data['month_appartment_capital'];
        $property->water_cost   =  $data['water_cost'];
        $property->other_appartment_cost   =  $data['other_appartment_cost'];
            
        $proj = $property->save();
        $propertyId = $property->id;

        if($request->hasfile('property_primary_image'))
        {
            $name   = explode('.', ($data['property_primary_image']->getClientOriginalName() ))[0];;
            $ext    =  $data['property_primary_image']->getClientOriginalExtension();
            $imageName = $name.'_'.time().'.'.$ext;
            $data['property_primary_image']->move(public_path().'/images/property/'.$propertyId.'/', $imageName);  
            
            PropertyImage::where('property_id',$property->id)->where('primary',1)->forceDelete();

            $propertyImage= new PropertyImage();
            $propertyImage->property_id	= $propertyId;
            $propertyImage->name    = $imageName;	
            $propertyImage->type    = $ext;
            $propertyImage->primary = 1;
            $propertyImage->save();
        }
        if($request->hasfile('property_image'))
         {

            foreach($request->file('property_image') as $image)
            {
                $name   = explode('.', ($image->getClientOriginalName() ))[0];;
                $ext    =  $image->getClientOriginalExtension();
                $imageName = $name.'_'.time().'.'.$ext;
                $image->move(public_path().'/images/property/'.$propertyId.'/', $imageName);  
                
                $propertyImage= new PropertyImage();
                $propertyImage->property_id	= $propertyId;
                $propertyImage->name    = $imageName;	
                $propertyImage->type    = $ext;
                $propertyImage->primary = 0;
                $propertyImage->save();
            }
         }

        return redirect()->route('admin.property.index')->withFlashSuccess('The property has been successfully created.');
    }

    /**
     * @param Request $request
     * @param Property              $property
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($propertyId)
    {
        $post = Property::where('id',$propertyId)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.property.index')->withFlashSuccess(__('The property has been deleted successfully.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
    * @param Property              $property
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore($propertyId)
    {
        $post = Property::where('id',$propertyId)->onlyTrashed()->first();
        if ($post != null) {
            $post->restore();
            return redirect()->route('admin.property.deleted')->withFlashSuccess(__('The property has been restored successfully.'));
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

    public function deleteimage($propertyImgId)
    {
        $post = PropertyImage::where('id',$propertyImgId)->forceDelete();
        // if ($post != null) {
        //     $propertyImages = PropertyImage::where('property_id',$propertyId)->forceDelete();
        //     $post->forceDelete();
        //     return redirect()->route('admin.property.deleted')->withFlashSuccess(__('The property has been permanently deleted successfully.'));
        // }
        return redirect()->back()->withFlashSuccess(__('The property image has been deleted successfully.'));

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact(Request $request)
    {
        $propertyContact = ContactUs::with('property')->orderBy('id', 'desc')->paginate(6);
        return view('backend.property.contact')
            ->withPropertyContacts($propertyContact);
    }

    public function contactshow(Request $request,$id){
        $propertyContact = ContactUs::with('property')->where('id', $id)->first();
        ContactUs::where('id',$id)->update(['viewed' => 1]);
        return view('backend.property.contactview')
            ->withPropertyContact($propertyContact);
    }

    public function ostamassa_apartment_edit (Request $request,$id){
        $propertyContact = ContactForm::where('id', $id)->first();
        ContactForm::where('id',$id)->update(['viewed' => 1]);
        return view('backend.property.ostamassaedit')
            ->withPropertyContact($propertyContact);
    }

    public function ostamassa_approve (Request $request,$id){
        ContactForm::where('id',$id)->update(['approved' => 1, 'approved_by' => auth()->user()->id]);
        return  redirect()->back()->withFlashSuccess(__('The property has been approved successfully.'));
    }
    public function ostamassa_disapprove(Request $request,$id){
        ContactForm::where('id',$id)->update(['approved' => 0, 'approved_by' => auth()->user()->id]);
        return  redirect()->back()->withFlashSuccess(__('The property has been disapproved successfully.'));
    }


    public function ostamassa_update(Request $request, $propertyId)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'appartment_min_size'   => 'required|numeric',
            'appartment_max_size'   => 'required|numeric',
            'rooms_min'   => 'required|numeric',
            'rooms_max'   => 'required|numeric',
            'construction_year_min'   => 'required|numeric',
            'construction_year_max'   => 'required|numeric',
            'appartment_min_price'   => 'required|numeric',
            'appartment_max_price'   => 'required|numeric',
            'property_type'     => 'required|max:150',
            'condition'     => 'required|max:150',
            'additional_requests'      => 'required',
            'appartment_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();
        
        $ostamassaData = ContactForm::where('id',$propertyId)->first();
        $ostamassaData->appartment_min_size     =  $data['appartment_min_size'];
        $ostamassaData->appartment_max_size      =  $data['appartment_max_size'];
        $ostamassaData->rooms_min   =  $data['rooms_min'];
        $ostamassaData->rooms_max   =  $data['rooms_max'];
        $ostamassaData->construction_year_min   =  $data['construction_year_min'];
        $ostamassaData->construction_year_max   =  $data['construction_year_max'];
        $ostamassaData->appartment_min_price   =  $data['appartment_min_price'];
        $ostamassaData->appartment_max_price   =  $data['appartment_max_price'];
        $ostamassaData->property_type   =  $data['property_type'];
        $ostamassaData->condition   =  $data['condition'];
        $ostamassaData->additional_requests   =  $data['additional_requests'];
            
        $proj = $ostamassaData->save();
        
        if($request->hasfile('appartment_photo'))
        {
            $document = $request->file('appartment_photo');
            $size = $document->getSize();;
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/contactform/', $imageName);  
            ContactForm::where('id',$propertyId)->update(['appartment_photo' => $imageName]);
        }

        return redirect()->route('admin.property.ostamassa')->withFlashSuccess('The Ostamassa property has been successfully created.');
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function uploadImage(Request $request)
    {
        $funcNum = $request->get('CKEditorFuncNum');
        if($request->hasfile('upload'))
        {
            $document = $request->file('upload');
            $size = $document->getSize();;
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/ckimages/', $imageName);

            $url = url('/images/ckimages').'/'.$imageName;
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', 'The file has been uploaded successfully.');</script>";
        }
        die;
    }
    
}
