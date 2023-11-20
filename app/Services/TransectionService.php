<?php

namespace App\Services;

use App\Repositories\TransectionRepository;

class TransectionService
{
    protected TransectionRepository $transectionRepository;

    public function __construct(TransectionRepository $transectionRepository)
    {
        $this->transectionRepository = $transectionRepository;
    }
}
