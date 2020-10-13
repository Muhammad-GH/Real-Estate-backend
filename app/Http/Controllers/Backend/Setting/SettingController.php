<?php

namespace App\Http\Controllers\Backend\Setting;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Property;
use App\Models\PropertyImage;
// use App\Models\Auth\User;
use App\Repositories\Backend\PropertyRepository;
use App\Repositories\Backend\PDFRepository;
use App\Models\ContactUs;
use App\Models\ContactForm;
use App\Models\City;
use App\Models\PDF;
use Illuminate\Validation\Rule;


/**
 * Class SettingController.
 */
class SettingController extends Controller
{
    /**
     * @var PropertyRepository
     */
    protected $pdfRepository;

    /**
     * SettingController constructor.
     *
     * @param PDFRepository $pdfRepository
     */
    public function __construct(PDFRepository $pdfRepository)
    {
        parent::__construct();
        $this->pdfRepository = $pdfRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeleted(Request $request)
    {
        
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
       
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
            'title'     => 'required|max:150',
            'name'      => 'required',
            'appartment_type'      => 'required',
            'details'   => 'required',
            'area'      => 'required',
            'address'   => 'required',
            'size'      => 'required',
            'rooms'     => 'required',
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
        $property->appartment_type      =  $data['appartment_type'];
        $property->details   =  $data['details'];
        $property->area   =  $data['area'];
        $property->address   =  $data['address'];
        $property->size   =  $data['size'];
        $property->rooms   =  $data['rooms'];
        $property->price   =  $data['price'];
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
            'title'     => 'required|max:150',
            'name'      => 'required',
            'appartment_type'      => 'required',
            'details'   => 'required',
            'area'      => 'required',
            'address'   => 'required',
            'size'      => 'required',
            'rooms'     => 'required',
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
        $property->appartment_type      =  $data['appartment_type'];
        $property->details   =  $data['details'];
        $property->area   =  $data['area'];
        $property->address   =  $data['address'];
        $property->size   =  $data['size'];
        $property->rooms   =  $data['rooms'];
        $property->price   =  $data['price'];
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

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_pdf(Request $request)
    {

        return view('backend.setting.index_pdf')
            ->withPdf($this->pdfRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeletedpdf(Request $request)
    {
        return view('backend.setting.deleted_pdf')
            ->withPdf($this->pdfRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create_pdf(Request $request)
    {
        return view('backend.setting.create_pdf');
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store_pdf(Request $request, PDF $pdf)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'      => ['required','max:150', Rule::unique('form_pdf')],
            'page'      => 'required',
            'document'  => 'required|mimes:pdf|max:2048',
        ])->validate();
        
        $pdf->name     =  $data['name'];
        $pdf->page   =  $data['page'];
      
        $proj = $pdf->save();
        $pdfID = $pdf->id;
        if($request->hasfile('document'))
        {
            $document = $request->file('document');
            $size = $document->getSize();;
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/pdf/'.$pdfID.'/', $imageName);  
            PDF::where('id',$pdfID)->update(['document' => $imageName]);
        }

        return redirect()->route('admin.setting.pdf.index')->withFlashSuccess('The PDF was successfully created.');
    }

  

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit_pdf(Request $request,$id)
    {
        $pdfData = PDF::where('id',$id)->first();
        return view('backend.setting.edit_pdf')
            ->withPdf($pdfData);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update_pdf(Request $request, $pdfID)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'     => ['required','max:150'],
            'page'   => 'required',
        ])->validate();
        
        $pdf = PDF::where('id',$pdfID)->first();
        $pdf->name      =  $data['name'];
        $pdf->page   =  $data['page'];
       
        $investProperty = $pdf->save();
        
        if($request->hasfile('document'))
        {
            $document = $request->file('document');
            $size = $document->getSize();;
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/pdf/'.$pdfID.'/', $imageName);  
            PDF::where('id',$pdfID)->update(['document' => $imageName]);
        }
        
        return redirect()->route('admin.setting.pdf.index')->withFlashSuccess('PDF has been updated successfully.');
    }


    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy_pdf($id)
    {
        $post = PDF::where('id',$id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.setting.pdf.index')->withFlashSuccess(__('PDF has been deleted successfully.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete_pdf($id)
    {
        $post = PDF::where('id',$id)->onlyTrashed()->first();
        if ($post != null) {
            $post->forceDelete();
            return redirect()->route('admin.setting.pdf.deleted')->withFlashSuccess(__('PDF has been permanently deleted successfully.'));
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
    public function restore_pdf($id)
    {
        $post = PDF::where('id',$id)->onlyTrashed()->first();
        if ($post != null) {
            $post->restore();
            return redirect()->route('admin.setting.pdf.deleted')->withFlashSuccess(__('PDF has been restored successfully.'));
        }
        return redirect()->back();

    }
    
}
