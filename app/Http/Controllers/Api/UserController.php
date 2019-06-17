<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class UserController extends Controller
{
    public function login(LoginAuthRequest $request)
    	{
            $input = $request->only('email', 'password');
            $jwt_token = null;
			if (!$jwt_token = JWTAuth::attempt($input)){
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }
            return response()->json([
                'success' => true,
                'Message' => 'Login SuccessFully',
                'token' => $jwt_token,
            ]);
        }
    public function register(RegisterAuthRequest $request)
    	{
        	$user = User::create([
                'name'		=> $request->get('name'),
                'email' 	=> $request->get('email'),
                'password' 	=> bcrypt($request->get('password')),
                'mobile'    => $request->get('mobile'),
            ]);
            $token = JWTAuth::fromUser($user);
            return response()->json([
                    'success' => true,
                    'Message' => 'User Registered SuccessFully',
                    'token'   => $token,
            ]);
        }
    public function getAuthUser(Request $request)
        {
            $user = JWTAuth::authenticate($request->token);
            return response()->json(['user' => $user->only(['name','email','mobile'])]);
        }
    public function logout(Request $request)
        {
        	JWTAuth::invalidate($request->token);
        	return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        }
    public function updateProfile(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->update($request->all());
        return response()->json([
                'success' => true,
                'message' => 'Profile Updated successfully'
            ]);
    }
}
