<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        if(Auth::attempt([
            'username' => $request->input('username'), 
            'password' => $request->input('password'), 
        ])) 
        {
            $user = $request->user();
            $tokenResult = $user->createToken('Api Token');
            $token = $tokenResult->token;

            if($token->save())
                return response()->json([
                    'state' => true,
                    'message' => __('auth.loggedIn'), 
                    'data' => [
                        'avatar' => $user->avatar,
                        'firstName' => $user->first_name,
                        'lastName' => $user->last_name,
                        'email' => $user->email,
                        'token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer', 
                        'userName' => $user->username,
                    ]
                ], 200);
        }
        return response()->json([
            'state' => true,
            'message' => __('auth.incorrect'),
            'data' => null
        ], 403);
    }
    
    public function register(AuthRequest $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->postal_code = $request->input('postal_code');
        $user->home_address = $request->input('home_address');
        $user->work_address = $request->input('work_address');
        $user->password = Hash::make($request->input('password'));
        if ($user->save())
            return response()->json([
                'state' => true,
                'message' => __('auth.register'),
                'data' => null,
            ], 200);

        return response()->json([
            'state' => false,
            'message' => __('general.againLater'),
            'data' => null,
        ], 500);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'state' => true,
            'message' => __('auth.loggedOut'),
            'data' => null,
        ], 200);
    }

}
