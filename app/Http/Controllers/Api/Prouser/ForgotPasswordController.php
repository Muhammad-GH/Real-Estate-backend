<?php

namespace App\Http\Controllers\Api\Prouser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response(['message' => $response]);
    }

    public function broker()
    {
        return Password::broker('prousers');
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response(['error' => $response], 422);
    }
}
