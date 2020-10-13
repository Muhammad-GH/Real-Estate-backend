<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Mail;
use Illuminate\Support\Facades\Hash;  // Import Hash facade
use App\Models\Bussiness\Resources;
use App\Models\Auth\ProUser;
use App\Models\Bussiness\ProResourcePermission;


/**
 * Class AuthController.
 */
class AuthController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        if (auth()->guard('proresource')->check()) {
            //return redirect()->route('frontend.pms.dashboard');
            return redirect()->route('frontend.pms.project');
        }
        if (auth()->guard('pro')->check()) {
            //return redirect()->route('frontend.pms.dashboard');
            return redirect()->route('frontend.pms.project');
        }
        return view('pms.auth.login');
    }

    /**
     * Login Function
     */
    public function login_submit(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
        ],
        [
            'password.required'  => __('pms.validaion.required.password'),
            'email.required'  => __('pms.validaion.required.email'),
            'email.email'     => __('pms.validaion.invalid.email'),
        ])->validate();

        if (Auth::guard('proresource')->attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>1])) {
            $perms = ProResourcePermission::where('id', '=', Auth::guard('proresource')->user()->permission_id)->first();
            //return redirect()->route('frontend.pms.dashboard');
            return redirect()->route('frontend.pms.project');
        }else{
            return back()->withInput($request->only('email', 'remember'))->withFlashDanger(__('pms.validaion.failed.login'));
        }

    }


    /**
     * SSO Login Function
     */
    public function sso_login(Request $request){
        $token = $request->query('token');
        $header = $request->header('referer');
        if($header){
            $tokenSplit = explode('-',$token);
            if( (time() - base64_decode($tokenSplit[1])) > 10000000000000  ){
                return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.token_expired'));
            }else{
                $resource = Resources::where('token', $token)->first();
                if($resource){
                    if(Auth::guard('proresource')->loginUsingId($resource->id)) {
                        //return redirect()->route('frontend.pms.dashboard');
                        return redirect()->route('frontend.pms.project');
                    }else{
                        return back()->withFlashDanger(__('pms.messages.token_invalid'));
                    }
                }else{
                    return back()->withFlashDanger(__('pms.messages.token_invalid'));
                }
            }
        }else{
            return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.token_expired'));
        }
       
    }

     /**
     * SSO Login Function
     */
    public function sso_user_login(Request $request){
        $token = $request->query('token');
        $header = $request->header('referer');
        if($header){
            $tokenSplit = explode('-',$token);
            if( (time() - base64_decode($tokenSplit[1])) > 10000000000000000  ){
                return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.token_expired'));
            }else{
                $resource = ProUser::where('token', $token)->first();
                if($resource){
                    if(Auth::guard('pro')->loginUsingId($resource->id)) {
                        //return redirect()->route('frontend.pms.dashboard');
                        return redirect()->route('frontend.pms.project');
                    }else{
                        return back()->withFlashDanger(__('pms.messages.token_invalid'));
                    }
                }else{
                    return back()->withFlashDanger(__('pms.messages.token_invalid'));
                }
            }
        }else{
            return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.token_expired'));
        }
       
    }

    /**
     * Reset Password View
     */
    public function reset_password(){
        return view('pms.auth.reset_password');
    }

    /**
     * Reset Function
     */
    public function reset_password_submit(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'email'     => 'required|email',
        ],
        [
            'email.required'  => __('pms.validaion.required.email'),
            'email.email'     => __('pms.validaion.invalid.email'),
        ])->validate();

        $resource = Resources::where('email', $request->email)->first();
        if($resource){
            $data = [
                'id' => $resource->id,
                'first_name' => $resource->first_name,
                'last_name' => $resource->last_name,
                'email' => $resource->email,
                'company' => $resource->company,
                'reset_token' => base64_encode(base64_encode($resource->id).':'.$resource->email.':'.time())
            ];
            
            Mail::send('pms.mail.reset_password', $data, function($message) use($resource) {
                $message->to($resource->email);
                $message->subject('New email!!!');
            });
            return redirect()->route('frontend.pms.login')->withFlashSuccess(__('pms.messages.reset_mail_sent'));
        } else {
            return back()->withInput($request->only('email'))->withFlashDanger(__('pms.reset.user_not_found'));
        }

    }

    /**
     * Logout Function
     */
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.logout_success'));
    }

    /**
     * Set Password Function
     */
    public function set_password($token = null){
        
        if($token){
            $data = explode(":",base64_decode($token));
            $data[0] = base64_decode($data[0]);
            $resource = Resources::where('id', $data[0])->first();
            if($resource){
                return view('pms.auth.set_password')->withData($data)->withToken($token);
            }else{
                return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.invalid_URL'));
            }
        }else{
            return redirect()->route('frontend.pms.login')->withFlashDanger(__('pms.messages.invalid_URL'));
        }
    }

     /**
     * Set Password Save Function
     */
    public function password_submit(Request $request){
        
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'token'     => 'required',
            'password'  => 'required|confirmed|min:5',
            'password_confirmation'=> 'min:5'
        ],
        [
            'password.required'  => __('pms.validaion.required.password'),
            'password.confirmed'     => __('pms.validaion.invalid.equalTo'),
            'password.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
            'password_confirmation.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
        ])->validate();

        $data = explode(":",base64_decode($request->token));
        $data[0] = base64_decode($data[0]);
        
        Resources::where( 'id' , $data[0] )->update(['password' => Hash::make($request->password) ]);
        return redirect()->route('frontend.pms.login')->withFlashSuccess(__('pms.messages.password_changed_success'));
    }
}
