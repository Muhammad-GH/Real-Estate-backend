<?php

namespace App\Http\Controllers\Api\Prouser;

use DB;
use Validator;
use App\Models\Auth\User;
use Illuminate\Support\Str;
use App\Models\Auth\ProUser;
use Illuminate\Http\Request;
use App\Models\Auth\ProUserDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\ProUserRepository;

class ProUserApiController extends Controller
{
    /**
     * @var ProUserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param ProUserRepository $userRepository
     */
    public function __construct(ProUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        return response()->json(ProUser::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->usersRepository->create($request->only(
            'first_name',
            'last_name',
            'email',
            'phone',
            'password',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'rights',
            'permissions'
        ));
        return response()->json($this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'email',
            'phone',
            'password',
            'type',
            'subtype',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'rights',
            'permissions'
        )), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $country = DB::select('select * from pro_users where id = :id', ['id' => $id]);
        $retCountry = (is_null($country)) ?
            ["message" => "Record not found", "status" => 404] :
            response()->json($country, 200);
        return $retCountry;
    }

    public function getEmail($id)
    {
        //
        $country = DB::select('select email from pro_users where id = :id', ['id' => $id]);
        $retCountry = (is_null($country)) ?
            ["message" => "Record not found", "status" => 404] :
            response()->json($country, 200);
        return $retCountry;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = ProUser::find($id);
        $retVal = (is_null($user)) ?
            ["message" => "Not found", "status" => 404] :
            $this->userRepository->update($user, $request->only(
                'first_name',
                'last_name',
                'email',
                'roles',
                'permissions'
            ));

        return response()->json($retVal, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $val = DB::delete('delete from pro_users where id = ?', [$id]);
        if (is_null($val)) {
            return response()->json(["message" => "Not found"], 404);
        }
        return response()->json(null, 204);
    }

    protected function account()
    {
        if (!Auth::check()) {
            return response()->json(["message" => "Unauthorized"], 404);
        }
        $userData = ProUserDetail::where('user_id', auth()->user()->id)->first();
        if (is_null($userData)) {
            return response()->json(["message" => "Record not found"], 404);
        } else {
            $userData->email = Auth::user()->email;
            $user = ProUser::where('id', Auth::user()->id)->first();
            $userData->first_name = $user->first_name;
            $userData->last_name = $user->last_name;
            return response()->json($userData, 200);
        }
    }

    protected function storePropDetails(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'insurance'     => 'required',
            'work' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }
        $data = ProUserDetail::where('user_id', auth()->user()->id)
            ->update(
                [
                    'insurance' => $data["insurance"],
                    'work' => $data["work"],
                ]
            );

        return response()->json($data, 200);
    }


    protected function storeAgreeDetails(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'agreement_work_guarantee'     => 'required',
            'agreement_material_guarantee' => 'required',
            'agreement_insurances' => 'required',
            'agreement_panelty' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }
        $data = ProUserDetail::where('user_id', auth()->user()->id)
            ->update(
                [
                    'agreement_work_guarantee' => $data["agreement_work_guarantee"],
                    'agreement_material_guarantee' => $data["agreement_material_guarantee"],
                    'agreement_insurances' => $data["agreement_insurances"],
                    'agreement_panelty' => $data["agreement_panelty"],
                ]
            );

        return response()->json($data, 200);
    }

    protected function storeDetails(Request $request,  ProUserDetail $userDetail, UserRepository $usersRepository, ProUserRepository $prouserRepository)
    {

        $data = $request->all();

        $userDetail->user_id     =  Auth::user()->id;
        $userDetail->address     =  $data['address'];
        $userDetail->zip     =  $data['zip'];
        $userDetail->phone =  $data['phone'];
        $userDetail->company_id  =  $data['company_id'];
        $userDetail->company_website   =  $data['company_website'];
        if ($request->hasfile('company_logo')) {
            $document = $request->file('company_logo');
            $size = $document->getSize();
            $imageName  = time() . "_" . $document->getClientOriginalName();
            $document->move(public_path() . '/images/marketplace/company_logo/', $imageName);

            $userDetail->company_logo = $imageName;
        }

        $fill = ProUserDetail::updateOrInsert(
            ['user_id' => Auth::user()->id],
            [
                'user_id' =>  $userDetail->user_id, 'address' => $userDetail->address, 'zip' => $userDetail->zip,
                'phone' => $userDetail->phone, 'insurance' => $userDetail->insurance, 'work' => $userDetail->work,
                'company_id' => $userDetail->company_id,
                'company_website' => $userDetail->company_website,
                'company_logo' => $userDetail->company_logo
            ]
        );
        if ($data['old_password'] == null || $data['password'] === null) {
            return response()->json(["error" => "passwords cannot be null"], 400);
        }
        $pro_user = ProUser::where('email', auth()->user()->email)->first();
        if (Hash::check($data['old_password'], auth()->user()->password)) {
            $prouserRepository->updateEmail($pro_user, $request->only(
                'first_name',
                'last_name',
                'email',
            ));
            $prouserRepository->updatePassword($pro_user, $request->only('password'));
            return response()->json($userDetail, 200);
        } else {
            return response()->json(["error" => "Passwords don't match"], 404);
        }
    }

    protected function token()
    {
        $resource = ProUser::findOrFail(auth()->user()->id);
        if ($resource) {
            $token = Str::random(10) . '-' . base64_encode(time());
            ProUser::where('id', auth()->user()->id)->update(['token' => $token]);
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['data' => 'error'], 404);
        }
    }


    // public function logoutApi()
    // { 
    //     if (Auth::check()) {
    //     Auth::user()->AauthAcessToken()->delete();
    //     }
    // }

}
