<?php

namespace App\Http\Controllers\Api\Prouser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function sendResetResponse(Request $request, $response)
    {
        return response(['message' => $response]);
    }

    public function broker()
    {
        return Password::broker('prousers');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response(['error' => $response], 422);
    }
}
