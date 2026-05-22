<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request) 
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // TODO: add event that the user register successfully to send email to the user

        return $this->success($user, "User created successfully");
    }

    public function login(LoginRequest $request) 
    {
        // TODO: in the LoginRequest set the rate limiter
        $authInfo = $request->authenticate(); 

        return $this->success($authInfo, "Login Successfully"); 
    }


    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, "Logout Successfully", 204); 
    }

    public function me(Request $request) 
    {
        $user = [
            'user' => $request->user(), 
            'token' => $request->user()->currentAccessToken()->plainTextToken,
        ];
        return $this->success($user, "User info retrieved successfully");
    }


    public function refresh(Request $request) 
    {

            $request->user()->currentAccessToken()->delete();
    
            $authInfo = $request->user()->createToken('auth_token')->plainTextToken;
    
            return $this->success(['token' => $authInfo], "Token refreshed successfully");
    }
}
