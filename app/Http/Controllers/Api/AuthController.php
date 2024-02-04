<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use  App\Http\Resources\UserResource;
use App\Http\Requests\Api\LoginRequest;
class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        list($logined,$user) = $this->authService->login($request->all());
        
        if(!$logined)
        {
             return $this->errorResponse("user name or password is rong",null,401);
        }
  
       return $this->fullDataResponse($user->createToken('manage-tokens')->accessToken,new UserResource($user) ,"logined", 200 );
    }
}
