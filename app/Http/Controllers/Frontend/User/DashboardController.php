<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Alert;

use App\Repositories\Frontend\Auth\UserRepository;
use App\Models\Auth\User;
use App\Models\Auth\UserDetail;
use App\Models\PDF;
use Illuminate\Validation\Rule;
use App\Models\City;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $cites = City::pluck('name','id');
        $userId = auth()->user()->id;
        if ($request->isMethod('post')) {
            $data = $request->all();
            
            $validator = Validator::make($data, [
                'type'      => 'required',
                'first_name'      => 'required',
                'last_name'      => 'required',
                'email'   => ['required','email',Rule::unique('users')->ignore($userId)],
                'address'      => 'required',
                'phone'      => 'required|numeric',
                'city'      => 'required',
                'personal_id'      => 'required',
                'citizen'      => 'required',
                'investment_size'      => 'required',
                'authentication'      => 'required',
                'card_id'      => 'required',
                'nomination_day'      => 'required',
                'nomination_authority'      => 'required',
                'checked_investment_case'      => 'required',
                'terms_use'      => 'required',
                'risks_investment'      => 'required',
                'agree_all'      => 'required',
            ])->validate();

            $output = $this->userRepository->update(
                auth()->user()->id,
                $request->only('first_name', 'last_name', 'email'),
                $request->has('avatar_location') ? $request->file('avatar_location') : false
            );

            
            if($output){

                $userData = $request->only('type', 'address', 'city','phone','personal_id','citizen','investment_size','authentication','card_id','nomination_day','nomination_authority','checked_investment_case','terms_use','risks_investment','agree_all');
                   
                $userDetails = UserDetail::where('user_id',$userId)->first();
                if(empty($userDetails)){
                    $userDetails = new UserDetail;
                }
                $userDetails->user_id = $userId;
                $userDetails->type = $userData['type'];
                $userDetails->address = $userData['address'];
                $userDetails->city = $userData['city'];
                $userDetails->phone = $userData['phone'];
                $userDetails->personal_id = $userData['personal_id'];
                $userDetails->citizen = $userData['citizen'];
                $userDetails->investment_size = $userData['investment_size'];
                $userDetails->authentication = $userData['authentication'];
                $userDetails->card_id = $userData['card_id'];
                $userDetails->nomination_day = $userData['nomination_day'];
                $userDetails->nomination_authority = $userData['nomination_authority'];
                $userDetails->checked_investment_case = $userData['checked_investment_case']?1:0;
                $userDetails->terms_use = $userData['terms_use']?1:0;
                $userDetails->risks_investment = $userData['risks_investment']?1:0;
                $userDetails->agree_all = $userData['agree_all']?1:0;
                
                $userDetails->save();
                
                Alert::success('Hienoa!', 'Käyttäjätietosi on tallennettu onnistuneesti!');

                if (is_array($output) && $output['email_changed']) {
                    auth()->logout();

                    return redirect()->route('frontend.auth.login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
                }
            }
            
        }
        
        $user = User::where('id',$userId)->with('userDetail')->with('userDetail.city_data')->first();
        $pdfData = PDF::where('page','Dashboard')->get();
        return view('frontend.user.dashboard')->withUser($user)->withPdf($pdfData)->withCities($cites);
    }
}
