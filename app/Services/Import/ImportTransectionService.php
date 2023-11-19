<?php

namespace App\Services\Import;

use App\Services\ImportInterface;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportTransection;
class ImportTransectionService implements ImportInterface
{

    public function import($file)
    {
      $path = Storage::putFile('imports',$file );
 
      ImportTransection::dispatch($path);
    }
}
