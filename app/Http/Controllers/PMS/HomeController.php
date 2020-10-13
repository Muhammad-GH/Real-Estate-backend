<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Hash;  // Import Hash facade
use App\Models\Bussiness\Resources;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pms.home.dashboard')->withPage('dashboard');
    }

    /**
     * My Account Function
     */
    public function my_account()
    {
        $breadcrumb = [
            ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
            ['name'=> __('pms.my_account.title') , 'route'=>'frontend.pms.my-account']
        ];
        $id = auth()->guard('proresource')->user()->id;
        $resource = Resources::where('id', $id)->first();

        // if($resource){
        //     $token = Str::random(10).'-'.base64_encode(time());
        //     print_r($token);
        //     Resources::where( 'id' , $id )->update(['token' => $token ]);
        //     die;

            
        // }
        return view('pms.home.my_account')->withPage('my_account')->withBreadcrumb($breadcrumb)->withResource($resource);
    }

    /**
     * My Account Submit Function
     */
    public function my_account_submit(Request $request)
    {
        $data = $request->all();
        $id = auth()->guard('proresource')->user()->id;
        
        $validator = Validator::make($data, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => ['required','max:150', Rule::unique('pro_resources','email')->ignore($id)],
            'image'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();

        Resources::where( 'id' , $id )->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email ]);

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $imageName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            
            try{
                $file->move(public_path().'/images/resources/'.$id.'/', $imageName);
                #move_uploaded_file(public_path().'/images/blog/'.$blogId.'/', $imageName);
            }catch(Exception $e){
                echo '<pre>'; print_r($e); die;
            }
            
            Resources::where('id',$id)->update(['photo' => $imageName]);
            
        }
        
        return redirect()->route('frontend.pms.my-account')->withFlashSuccess(__('pms.messages.profile_updated'));

    }

    

    /**
     * Change Password Function
     */
    public function change_password()
    {
        $breadcrumb = [
            ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
            ['name'=> __('pms.change_password.title') , 'route'=>'frontend.pms.change-password']
        ];
        return view('pms.home.change_password')->withPage('change_password')->withBreadcrumb($breadcrumb);
    }

    /**
     * Save Password Function
     */
    public function change_password_submit(Request $request)
    {
        $data = $request->all();
        $id = auth()->guard('proresource')->user()->id;
        
        $validator = Validator::make($data, [
            'old_password'  => 'required|min:5',
            'password'  => 'required|confirmed|min:5',
            'password_confirmation'=> 'min:5'
        ],
        [
            'old_password.required'  => __('pms.validaion.required.password'),
            'old_password.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
            'password.required'  => __('pms.validaion.required.password'),
            'password.confirmed'     => __('pms.validaion.invalid.equalTo'),
            'password.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
            'password_confirmation.min' => __('pms.validaion.invalid.min_length',['min_len'=>5]),
        ])->validate();

        if (Hash::check($request->old_password, auth()->guard('proresource')->user()->password)) { 
            Resources::where('id',$id)->update(['password' => Hash::make($request->password) ]);
            return redirect()->route('frontend.pms.change-password')->withFlashSuccess(__('pms.messages.password_updated_success'));
        }else{
            return redirect()->route('frontend.pms.change-password')->withFlashDanger(__('pms.messages.password_updated_error'));
        }

    }

}
