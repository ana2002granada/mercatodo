<?php

namespace App\Imports;

use App\Actions\Products\RegisterImportAction;
use App\Actions\Products\StoreOrUpdateProductAction;
use App\Imports\Sheets\ProductsImportSheet;
use App\Models\Import;
use App\Models\Product;
use App\Rules\ImportProductRule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Validators\ValidationException;

class ProductsImport implements ShouldQueue, WithChunkReading, WithMultipleSheets, SkipsUnknownSheets
{
    protected Import $import;
    protected RegisterImportAction $registerImport;
    protected StoreOrUpdateProductAction $storeProductAction;

    public function __construct(Import $import, RegisterImportAction $registerImport)
    {
        $this->import = $import;
        $this->registerImport = $registerImport;
        $this->storeProductAction = resolve(StoreOrUpdateProductAction::class);
    }

    public function registerEvents(): array
    {
        $errors = [];
        return [
            ImportFailed::class => function (ImportFailed $event) {
                if ($event->getException() instanceof ValidationException) {
                    /** @var ValidationException $exception */
                    $exception = $event->getException();
                    $failures = $exception->failures();
                    foreach ($failures as $failure) {
                        $errors['row_' . $failure->row()] = array_merge($errors['row_' . $failure->row()] ?? [], $failure->errors());
                    }
                }
                $this->registerImport->storeOrUpdate('Validation error', $this->import, $errors ?? [trans('validation.import.general')]);
            },
        ];
    }

    public function sheets(): array
    {
        return [
            'Products' => new ProductsImportSheet(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
