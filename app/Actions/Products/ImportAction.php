<?php

namespace App\Actions\Products;

use App\Events\UploadFile;
use App\Imports\ProductsImport;
use App\Models\Import;
use Maatwebsite\Excel\Facades\Excel;

class ImportAction
{
    public function execute(RegisterImportAction $registerImport, $file): array
    {
        /** @var Import $import */
        $import = $registerImport->storeOrUpdate('processing');
        try {
            Excel::import(new ProductsImport($import, $registerImport), $file);
            $response = [
                'type' => 'successful',
                'message' => 'upload successful',
            ];
            UploadFile::dispatch($response['message'], auth()->user());

            $registerImport->storeOrUpdate('successful', $import);
        } catch (\Throwable $exception) {
            $response = [
                'type' => 'error',
                'message' => 'Import filed',
            ];
            if (!$import->errors) {
                $registerImport->storeOrUpdate('general error', $import, ['prueba error general']);
                UploadFile::dispatch($response['message'], auth()->user(), $import);
            }
        }
        return $response;
    }
}
