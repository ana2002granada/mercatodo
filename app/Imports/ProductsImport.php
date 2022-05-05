<?php

namespace App\Imports;

use App\Actions\Products\ImportAction;
use App\Actions\Products\RegisterImportAction;
use App\Actions\Products\StoreOrUpdateProductAction;
use App\Models\Import;
use App\Models\Product;
use App\Rules\ImportProductRule;
use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Jobs\ReadChunk;
use Maatwebsite\Excel\Validators\ValidationException;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, WithUpserts, WithEvents, ShouldQueue, WithChunkReading
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

    public function model(array $row): void
    {
        $this->storeProductAction->execute(
            [
                'name' => $row['name'],
                'description' => $row['description'],
                'category' => $row['category_id'],
                'price' => $row['price'],
                'stock' => $row['stock'],
                ],
            $row['id'] ? Product::find($row['id']) : null
        );
        $this->registerImport->storeOrUpdate('successful', $this->import);
    }


    public function rules(): array
    {
        return ImportProductRule::rules();
    }

    public function uniqueBy()
    {
        return 'name';
    }

    public function registerEvents(): array
    {
        $errors = [];

        return [
            ImportFailed::class => function (ImportFailed $event) {
                dd($event->getException());
                if ($event->getException() instanceof ValidationException) {
                    dd('ahoooooo');
                    /** @var ValidationException $exception */
                    $exception = $event->getException();
                    $failures = $exception->failures();
                    foreach ($failures as $failure) {
                        $errors['row_' . $failure->row()] = array_merge($errors['row_' . $failure->row()] ?? [], $failure->errors());
                    }
                }
                $this->registerImport->storeOrUpdate('Validation error', $this->import, $errors ?? [trans('validation.import.general')]);
            }
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
