<?php

namespace App\Services\Import;

use App\Services\ImportInterface;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportUsers;
class ImportUserService implements ImportInterface
{

    public function import($file)
    {
       $path = Storage::putFile('imports',$file );
 
        ImportUsers::dispatch($path);
      
    }
}
