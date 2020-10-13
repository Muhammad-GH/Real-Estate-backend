<?php

namespace App\Http\Controllers\Api\Resources;

use DB;
use Validator;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\Bussiness\Resources;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Bussiness\ProResourcePermission;

class ResourcesApiController extends Controller
{

    protected function list($type = null)
    {
        if ($type === 'Client') {
            return response()->json(['data' => Resources::where([['user_id', auth()->user()->id], ['type', $type]])->get()], 200);
        }
        return response()->json(['data' => Resources::where([['user_id', auth()->user()->id], ['type', '!=',  'Client']])->get()], 200);
    }

    protected function resourceById($id)
    {
        $resource = Resources::findOrFail($id);
        return response()->json(['data' => $resource], 200);
    }

    protected function resourceInsert(Request $request, Resources $resource)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'first_name'     => ['required', 'max:150'],
            'last_name' => ['required', 'max:150'],
            'phone' => 'required',
            'email'   => 'required|email',
            'company'    => 'required',
            'type'   => 'required',
            'permission'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $resource->user_id     =  auth()->user()->id;
        $resource->first_name     =  $data['first_name'];
        $resource->last_name =  $data['last_name'];
        $resource->phone =  $data['phone'];
        $resource->email  =  $data['email'];
        $resource->company   =  $data['company'];
        $resource->type   =  $data['type'];
        $resource->permission_id   =  $data['permission'];
        $resource->status   =  1;
        $data["passwordString"]  =  $this->makePassword();
        $resource->password   = Hash::make($data["passwordString"]);

        $resource->save();

        $this->sendEmailAttachment($resource->email, $resource->first_name, $data["passwordString"]);

        return response()->json($resource, 201);
    }

    protected function makePassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = random_int(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function sendEmailAttachment($emails, $name, $password)
    {
        $data['send_to'] = explode(',', $emails);
        $data['send_from'] = 'guptanishantmca@gmail.com';
        $data['replace_var_subject'] = array('{{name}}' => $name, '{{test}}' => $password);
        $data['replace_var_body'] = array('{{name}}' => $name, '{{test}}' => $password);
        $data['email_id'] = 'template test fi';
        $data['langcode'] = 'en';
        $data['file_path'] = '';
        return send_pro_email($data);
    }

    protected function resourceDelete($id)
    {
        $resource = Resources::find($id);
        if ($resource)
            $resource->delete();
        else
            return response()->json(['data' => 'error'], 404);
        return response()->json(null);
    }

    protected function resourceUpdate(Request $request, $id)
    {
        $article = Resources::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    protected function resourcePermission(Request $request)
    {
        $article = ProResourcePermission::get();
        return response()->json(['data' => $article], 200);
        return $article;
    }


    protected function resourceToken($id)
    {
        $resource = Resources::findOrFail($id);
        if ($resource) {
            $token = Str::random(10) . '-' . base64_encode(time());
            Resources::where('id', $id)->update(['token' => $token]);
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['data' => 'error'], 404);
        }
    }
}
