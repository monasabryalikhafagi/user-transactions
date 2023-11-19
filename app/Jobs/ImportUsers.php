<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ImportUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    /**
     * Create a new job instance.
     */

    public function __construct($path)
    {
      $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(UserRepository $userRepository): void
    {  
        $users = json_decode(file_get_contents(storage_path() .'/app/'. $this->path), true);
       if(array_key_exists('users',$users))
       {
        foreach($users['users'] as $user)
        {
            $userRepository->getModel()->firstOrCreate(
                ['email' => $user['email']],
                [
                    'email' =>$user['email'],
                    'password' => Hash::make('123456789'),
                    'balance' => $user['balance'],
                    'currency' => $user['currency'],
                ]
            );
        }
       }
 
       

    }
}
