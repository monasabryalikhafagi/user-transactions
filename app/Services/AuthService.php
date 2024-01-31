<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ImportInterface;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
class AuthService extends BaseService 
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

  
    public function login($credentials)
    {      
        if(Auth::attempt($credentials))
        {
           return[ true ,Auth::user()];
        }
        return [ false ,null];
    }



}
