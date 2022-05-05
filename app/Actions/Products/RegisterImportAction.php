<?php

namespace App\Actions\Products;

use App\Models\Import;

class RegisterImportAction
{
    public function storeOrUpdate(string $status, ?Import $import = null, ?array $errors = []): Import
    {

        if (!$import) {
            $import = new Import();
            $import->user_id = auth()->user()->id;
        }
        $import->status = $status;
        $import->errors = $errors;

        $import->save();

        return $import;
    }
}
