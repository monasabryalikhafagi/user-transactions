<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\UserRepository;
use App\Repositories\TransectionRepository;

class ImportTransection implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected string $path;

    public function __construct($path)
    {
          $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(TransectionRepository $transectionRepository, UserRepository $userRepository): void
    {
        $transactions = json_decode(file_get_contents(storage_path() .'/app/'. $this->path), true);
        if(array_key_exists('transactions',$transactions))
        {
        foreach($transactions['transactions'] as $transection)
        {
            $user = $userRepository->getByColumn($transection['parentEmail'], "email");

            if($user)
            {
                $transectionRepository->getModel()->firstOrCreate(
                    ['parent_Identification' => $transection['parentIdentification']],
                    [
                        'paid_amount' => $transection['paidAmount'],
                        'status_code' => $transection['statusCode'],
                        'currency' => $transection['Currency'],
                        'user_id' => $user->id,
                        'payment_date' => $transection['paymentDate'],
                        'parent_identification' => $transection['parentIdentification']
                    ]
                );
            }else{
             \Log::info("user not found");
            }
            
        }
     }
    }
}
