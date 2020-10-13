<?php

namespace App\Http\Controllers\Api\Prouser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Auth\ProUser;
use App\Models\Auth\User;
use Mail;
use Illuminate\Support\Facades\Storage;

class Login_ApiController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::guard('pro')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('pro')->user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'subtype' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['confirmed'] = 1;
        $user = ProUser::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $this->send_mail($user->first_name, $user->email, $user);
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function send_mail($name, $email, $user)
    {

        $content = json_decode(Storage::get('email_for. json'));
        $data = array("name" => $name, "user" => $user, 'intro' => $content->intro, 'subject' => $content->subject);

        Mail::send('mails.request', $data, function ($message) use ($name, $email, $content) {
            $message->to($email, $name)
                ->subject($content->subject);
            $message->from('sherwinlukes@gmail.com', 'sherwin');
        });
    }
}
