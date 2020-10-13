<?php

namespace App\Http\Controllers\Backend\InvestProperty;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\InvestProperty;
use App\Models\Investpropertyimage;
// use App\Models\Auth\User;
use App\Repositories\Backend\InvestPropertyRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\UserInvest;



/**
 * Class InvestPropertyController.
 */
class InvestPropertyController extends Controller
{
    /**
     * @var InvestPropertyRepository
     */
    protected $InvestPropertyRepository;

    /**
     * InvestPropertyController constructor.
     *
     * @param InvestPropertyRepository $InvestPropertyRepository
     */
    public function __construct(InvestPropertyRepository $InvestPropertyRepository)
    {
        $this->InvestPropertyRepository = $InvestPropertyRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.investproperty.index')
            ->withInvestProperties($this->InvestPropertyRepository->getActivePaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeleted(Request $request)
    {
        return view('backend.investproperty.deleted')
            ->withInvestProperties($this->InvestPropertyRepository->getDeletedPaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('backend.investproperty.create');

            // ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            // ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, InvestProperty $investProperty)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'title'     => ['required','max:150'],
            // 'title'     => ['required','max:150', Rule::unique('invest_property')],
            'appartment_type'     => 'required',
            // 'name'      => 'required',
            'details'   => 'required',
            'location'   => 'required',
            'price'      => 'required|numeric',
            'selling_price'      => 'required|numeric',
            'target_price'      => 'required|numeric',
            'invest_price'      => 'required|numeric',
            'profit'      => 'required|numeric',
            'flooring'      => 'required|numeric',
            'net_return'      => 'required|numeric',
            'capital_growth'      => 'required|numeric',
            'liquidation'      => 'required|numeric',
            'bathroom'      => 'required|numeric',
            'kitchen'      => 'required|numeric',
            'painting'      => 'required|numeric',
            'interior_design'      => 'required|numeric',
            'broker_fee'      => 'required|numeric',
            'taxes'      => 'required|numeric',
            'monthly_cost'      => 'required|numeric',
            'document'     => 'required|mimes:pdf|max:2048',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'property_image' => 'required',
            'property_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();
        
        $investProperty->title     =  $data['title'];
        $investProperty->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $investProperty->appartment_type     =  $data['appartment_type'];
        $investProperty->name      =  $data['title'];
        $investProperty->details   =  $data['details'];
        $investProperty->location   =  $data['location'];
        $investProperty->invest_price   =  $data['invest_price'];
        $investProperty->target_price   =  $data['target_price'];
        $investProperty->price   =  $data['price'];
        $investProperty->selling_price   =  $data['selling_price'];
        $investProperty->profit   =  $data['profit'];
        $investProperty->flooring   =  $data['flooring'];
        $investProperty->net_return   =  $data['net_return'];
        $investProperty->capital_growth   =  $data['capital_growth'];
        $investProperty->liquidation   =  $data['liquidation'];
        $investProperty->bathroom   =  $data['bathroom'];
        $investProperty->kitchen   =  $data['kitchen'];
        $investProperty->painting   =  $data['painting'];
        $investProperty->interior_design   =  $data['interior_design'];
        $investProperty->broker_fee   =  $data['broker_fee'];
        $investProperty->taxes   =  $data['taxes'];
        $investProperty->monthly_cost   =  $data['monthly_cost'];
        
        $proj = $investProperty->save();
        $investPropertyId = $investProperty->id;
        
        if($request->hasfile('document'))
        {
            $document = $request->file('document');
            $size = $document->getSize();;
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/investProperty/'.$investPropertyId.'/', $imageName);  
            InvestProperty::where('id',$investPropertyId)->update(['document' => $imageName]);

        }

        if($request->hasfile('image'))
        {
            $ext    =  $data['image']->getClientOriginalExtension();
            $imageName  = time()."_".$document->getClientOriginalName();
            $data['image']->move(public_path().'/images/investProperty/'.$investPropertyId.'/', $imageName);  
            InvestProperty::where('id',$investPropertyId)->update(['image' => $imageName]);
        }

        if($request->hasfile('property_image'))
         {
            foreach($request->file('property_image') as $image)
            {
                $imageName  = time()."_".$image->getClientOriginalName();
                $ext    =  $image->getClientOriginalExtension();
                $image->move(public_path().'/images/investProperty/'.$investPropertyId.'/', $imageName);  
                
                $propertyImage= new Investpropertyimage();
                $propertyImage->invest_property_id	= $investPropertyId;
                $propertyImage->name    = $imageName;	
                $propertyImage->type    = $ext;
                $propertyImage->save();
            }
         }

        return redirect()->route('admin.investproperty.index')->withFlashSuccess('The Invest Property was successfully created.');
    }

    /**
     * @param Request $request
    * @param InvestProperty  $InvestProperty
     *
     * @return mixed
     */
    public function show(Request $request,$investPropertyId)
    {
        $investPropertyData = $this->getInvestProperty($investPropertyId);
        return view('backend.investproperty.show')
            ->withInvestProperty($investPropertyData);

    }
    public function getInvestProperty($investPropertyId)
    {
        return InvestProperty::where('id',$investPropertyId)->with('investmentImage')->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$InvestPropertyId)
    {
        $InvestPropertyData = $this->getInvestProperty($InvestPropertyId);
        return view('backend.investproperty.edit')
            ->withInvestProperty($InvestPropertyData);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $investpropertyId)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            // 'title'     => 'required|max:150',
            'title'     => ['required','max:150'],
            // 'title'     => ['required','max:150', Rule::unique('invest_property')->ignore($investpropertyId)],
            'appartment_type'     => 'required',
            // 'name'      => 'required',
            'details'   => 'required',
            'location'   => 'required',
            'price'      => 'required|numeric',
            'selling_price'      => 'required|numeric',
            'target_price'      => 'required|numeric',
            'invest_price'      => 'required|numeric',
            'profit'      => 'required|numeric',
            'flooring'      => 'required|numeric',
            'net_return'      => 'required|numeric',
            'capital_growth'      => 'required|numeric',
            'liquidation'      => 'required|numeric',
            'bathroom'      => 'required|numeric',
            'kitchen'      => 'required|numeric',
            'painting'      => 'required|numeric',
            'interior_design'      => 'required|numeric',
            'broker_fee'      => 'required|numeric',
            'taxes'      => 'required|numeric',
            'monthly_cost'      => 'required|numeric',
            'document'     => 'mimes:pdf|max:2048',
            // 'property_image' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'property_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();
        
        $investProperty = $this->getInvestProperty($investpropertyId);
        $investProperty->title     =  $data['title'];
        $investProperty->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",$data['title']));
        $investProperty->appartment_type     =  $data['appartment_type'];
        $investProperty->name      =  $data['title'];
        $investProperty->details   =  $data['details'];
        $investProperty->location   =  $data['location'];
        $investProperty->target_price   =  $data['target_price'];
        $investProperty->invest_price   =  $data['invest_price'];
        $investProperty->price   =  $data['price'];
        $investProperty->selling_price   =  $data['selling_price'];
        $investProperty->profit   =  $data['profit'];
        $investProperty->flooring   =  $data['flooring'];
        $investProperty->net_return   =  $data['net_return'];
        $investProperty->capital_growth   =  $data['capital_growth'];
        $investProperty->liquidation   =  $data['liquidation'];
        $investProperty->bathroom   =  $data['bathroom'];
        $investProperty->kitchen   =  $data['kitchen'];
        $investProperty->painting   =  $data['painting'];
        $investProperty->interior_design   =  $data['interior_design'];
        $investProperty->broker_fee   =  $data['broker_fee'];
        $investProperty->taxes   =  $data['taxes'];
        $investProperty->monthly_cost   =  $data['monthly_cost'];
        
        $investProperty = $investProperty->save();
        
        if($request->hasfile('document'))
        {
            $document = $request->file('document');
            $size = $document->getSize();;
            $imageName  = time()."_".$document->getClientOriginalName();
            $document->move(public_path().'/images/investProperty/'.$investpropertyId.'/', $imageName);  
            InvestProperty::where('id',$investpropertyId)->update(['document' => $imageName]);

        }

        if($request->hasfile('image'))
        {
            $name   = explode('.', ($data['image']->getClientOriginalName() ))[0];
            $ext    =  $data['image']->getClientOriginalExtension();
            $imageName = $name.'_'.time().'.'.$ext;
            $data['image']->move(public_path().'/images/investProperty/'.$investpropertyId.'/', $imageName);  
            InvestProperty::where('id',$investpropertyId)->update(['image' => $imageName]);

        }

        if($request->hasfile('property_image'))
         {
            foreach($request->file('property_image') as $image)
            {
                $imageName  = time()."_".$image->getClientOriginalName();
                $ext    =  $image->getClientOriginalExtension();
                $image->move(public_path().'/images/investProperty/'.$investpropertyId.'/', $imageName);  
                
                $propertyImage= new Investpropertyimage();
                $propertyImage->invest_property_id	= $investpropertyId;
                $propertyImage->name    = $imageName;	
                $propertyImage->type    = $ext;
                $propertyImage->save();
            }
         }

        return redirect()->route('admin.investproperty.index')->withFlashSuccess('The Invest Property has been updated successfully.');
    }


    public function deleteimage($propertyImgId)
    {
        $post = Investpropertyimage::where('id',$propertyImgId)->forceDelete();
        return redirect()->back()->withFlashSuccess(__('The invest property image has been deleted successfully.'));

    }

    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($InvestPropertyId)
    {
        $post = InvestProperty::where('id',$InvestPropertyId)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.investproperty.index')->withFlashSuccess(__('The Invest Property has been deleted successfully.'));
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
    public function delete($investPropertyId)
    {
        $post = InvestProperty::where('id',$investPropertyId)->onlyTrashed()->first();
        if ($post != null) {
            $investPropertyImages = Investpropertyimage::where('invest_property_id',$investPropertyId)->forceDelete();
            $post->forceDelete();
            return redirect()->route('admin.investproperty.deleted')->withFlashSuccess(__('The Invest Property has been permanently deleted successfully.'));
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
        $post = InvestProperty::where('id',$propertyId)->onlyTrashed()->first();
        if ($post != null) {
            $post->restore();
            return redirect()->route('admin.investproperty.deleted')->withFlashSuccess(__('Invest property has been restored successfully.'));
        }
        return redirect()->back();

    }


    public function invest_request(Request $request)
    {
        $propertyContact = UserInvest::with('investmentProperty')->with('user')->whereHas('user',function($query){
                $query->where('deleted_at',NULL);
        })->orderBy('id', 'desc')->paginate(10);
        return view('backend.investproperty.investrequest')
            ->withPropertyContacts($propertyContact);
    }

    public function invest_request_view(Request $request,$id){
        $propertyContact = UserInvest::where('id', $id)->with('investmentProperty')->with('user')->first();
        ContactForm::where('id',$id)->update(['viewed' => 1]);
        return view('backend.investproperty.investrequestview')
            ->withPropertyContact($propertyContact);
    }

}
