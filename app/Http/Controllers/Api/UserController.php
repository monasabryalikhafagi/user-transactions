<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use  App\Http\Resources\UserResource;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        list($users,$count) = $this->userService->index($request);
        $users = UserResource::collection($users) ;
  
          return response()->json([
              'data' => $users,
              'count' => $count,
              'status' => true,
          ], 200);
    }
}
