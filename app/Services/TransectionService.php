<?php

namespace App\Services;

use App\Repositories\TransectionRepository;
use App\Services\ImportInterface;

class TransectionService implements ImportInterface
{
    protected TransectionRepository $transectionRepository;

    public function __construct(TransectionRepository $transectionRepository)
    {
        $this->transectionRepository = $transectionRepository;
    }

    public function import($data)
    {

    }
}
