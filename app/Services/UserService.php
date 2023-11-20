<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ImportInterface;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserService extends BaseService 
{
    //protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

  
    public function index(Request $request) :array
    {      
        $query = $this->repository->getModel()->when($request->status_code, 
        fn($q) => $q->whereHas('transections', function  ($query) use ($request) {
            $query->where('transections.status_code', $request->status_code);
        }))->when($request->currency , fn($q) => $q->where('currency',$request->currency))
        ->when($request->amount_range, fn($q) => $q->whereHas('transections', function  ($query) use ($request) {
            $query->whereBetween('transections.paid_amount', [$request->amount_range['from'],$request->amount_range['to']]);
        }) );
   
        

        $users = isset($request->skip) ? $query->skip($request->skip )->take($request->take)->get() : $query->get();

        return [ $users , $query->count()];
    }



}
