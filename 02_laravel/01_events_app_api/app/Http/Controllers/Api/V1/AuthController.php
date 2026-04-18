<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse; 
    public function register(RegisterRequest $request) 
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // TODO: add event that the user register successfully to send email to the user

        return $this->successResponse($user, "User created successfully");
    }

    public function login(LoginRequest $request) 
    {
        // TODO: in the LoginRequest set the rate limiter
        $authInfo = $request->authenticate(); 

        return $this->successResponse($authInfo, "Login Successfully"); 
    }


    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(null, "Logout Successfully", 204); 
    }

    public function me(Request $request) 
    {
        $user = [
            'user' => $request->user(), 
            'token' => $request->user()->currentAccessToken()->plainTextToken,
        ];
        return $this->successResponse($user, "User info retrieved successfully");
    }


    public function refresh(Request $request) 
    {

            $request->user()->currentAccessToken()->delete();
    
            $authInfo = $request->user()->createToken('auth_token')->plainTextToken;
    
            return $this->successResponse(['token' => $authInfo], "Token refreshed successfully");
    }
}
