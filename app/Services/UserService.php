<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserService
{
    protected  UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
 


}
