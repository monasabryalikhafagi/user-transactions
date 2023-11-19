<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImportRequest;
use App\Services\ImportService;
use App\Services\ImportFactory;
class ImportController extends Controller
{
    private ImportService $importService;

    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }
    public function import(ImportRequest $request)
    {
        $entity = $request->get('entity','user');
        $file =  $request->file;//file_get_contents( $request->get('file'));
        //dd($file, $entity);
        $importer = ImportFactory::instance($entity);
       
        $this->importService->import($importer,$file);
    }
}
