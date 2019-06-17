<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Auth;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function sendEmail(ForgotPasswordRequest $request)
    {
    	$response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        return response()->json([
        	'success'		=>true,
        	'Message'		=>'Mail Sent SuccessFully',
        ]);
    }
    public function broker()
    {
        return Password::broker();
    }
}
