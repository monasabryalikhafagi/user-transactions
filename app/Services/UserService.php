<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ImportInterface;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
 
class UserService implements ImportInterface
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // public function index()
    // {
    //     $this->userRepository->getModel()->
    // }


    public function import($file)
    {
        $path = Storage::putFile('imports',$file );
          dd($path);
        // Automatically generate a unique ID for filename...
    }  
}
