<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Events\Frontend\Auth\ProUserLoggedIn;
use App\Events\Frontend\Auth\ProUserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use App\Models\Auth\ProUser;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController.
 */
class ProLoginController extends Controller
{
    use AuthenticatesUsers;

    // public function __construct()
    // {
    //     $this->middleware('pro');
    // }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        
        if(auth()->check()){
            if (auth()->user()->can('view backend')) {
                session()->put('locale', 'en');
                return route('admin.dashboard');
            }else{
                $userId = auth()->user()->id;
                $user = User::where('id',$userId)->with('userDetail')->first();
                if($user->userDetail && $user->userDetail->address && $user->userDetail->city && $user->userDetail->phone && $user->userDetail->personal_id){
                    return route('frontend.user.account');
                }else{
                    return route('frontend.user.dashboard');
                }   
            }
        }else{
            return route(home_route());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProLoginForm()
    {
        return view('frontend.auth.prologin');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        
        $request->validate([
            $this->username() => 'required|string',
            'password' => PasswordRules::login(),
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ], [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @throws GeneralException
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
         // dd(auth());
        // Check to see if the users account is confirmed and active
        if (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail

            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]));
        }

        if (! $user->isActive()) {
            auth()->logout();

            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new ProUserLoggedIn($user));

        if (config('access.users.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }

        return redirect()->intended($this->redirectPath());
    }


    // protected function guard()
    // {
    //     return Auth::guard('pro');
    // }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Remove the socialite session variable if exists
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        // Fire event, Log out user, Redirect
        event(new ProUserLoggedOut($request->user()));

        // Laravel specific logic
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }
}
