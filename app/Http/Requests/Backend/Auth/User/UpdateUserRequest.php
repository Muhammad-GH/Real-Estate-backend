<?php

namespace App\Http\Requests\Backend\Auth\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Auth\User;
use Illuminate\Validation\Rule;
/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $id = $this->request->get('user');
        $user = \Request::instance()->user;
        
        return [
            'email' => ['required', 'email',Rule::unique('users')->ignore($user->id)],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'roles' => ['required', 'array'],
        ];
    }
}
