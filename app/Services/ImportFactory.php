<?php

namespace App\Services;

use App\Exceptions\InvalidExportFormat;

class ImportFactory
{
    public static function instance(string $entity): ImportInterface
    {
        $handler = config('import.importers')[$entity] ?? null;
       
        if (!$handler) {
            throw new InvalidImportEntity(sprintf("entity %s is not supported", $entity));
        }

        return new $handler;
    }
}
