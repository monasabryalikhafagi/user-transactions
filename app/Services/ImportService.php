<?php

namespace App\Services;

use App\Services\ImportInterface;

class ImportService 
{

    public function import(ImportInterface $importer ,$file)
    {
        return $importer->import($file);
        
    }
    
}
