<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImportRequest;
use App\Services\ImportFactory;
use App\Services\ImportService;

class ImportController extends Controller
{
    private ImportService $importService;

    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }
    public function import(ImportRequest $request)
    {
        $entity = $request->get('entity', 'user');
        $file = $request->file;
        $importer = ImportFactory::instance($entity);
        
        try {
            $this->importService->import($importer, $file);
            return $this->dataResponse(null, trans('messages.success'), 200);

        } catch (\Exception $e) {
            return $this->errorResponse($e, null, 500);

        }

    }
}
