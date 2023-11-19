<?php

namespace  App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transection;
class TransectionRepository extends Repository
{
    public function __construct(Transection $transection)
    {
        $this->setModel($transection);
    }

}
