<?php

namespace App\Services\Import;

use App\Jobs\ImportUsers;
use App\Services\ImportInterface;
use Illuminate\Support\Facades\Storage;

class ImportUserService implements ImportInterface
{

    public function import($file)
    {
        $path = Storage::putFile('imports', $file);
        ImportUsers::dispatch($path);
        
        return true;
    }
}
