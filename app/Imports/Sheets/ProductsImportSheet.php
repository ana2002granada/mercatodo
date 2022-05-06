<?php

namespace App\Imports\Sheets;

use App\Actions\Products\RegisterImportAction;
use App\Actions\Products\StoreOrUpdateProductAction;
use App\Models\Import;
use App\Models\Product;
use App\Rules\ImportProductRule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductsImportSheet implements ToModel, WithHeadingRow, WithValidation, WithUpserts, WithEvents
{
    protected StoreOrUpdateProductAction $storeProductAction;
    protected RegisterImportAction $registerImport;
    protected Import $import;

    public function __construct(RegisterImportAction $registerImport, Import $import)
    {
        $this->storeProductAction = resolve(StoreOrUpdateProductAction::class);
        $this->registerImport = $registerImport;
        $this->import = $import;
    }

    public function model(array $row): void
    {
        $product = $row['id'] ? Product::find($row['id']) : null;
        $this->storeProductAction->execute(
            [
                'name' => $row['name'],
                'description' => $row['description'],
                'category_id' => $row['category_id'],
                'price' => $row['price'],
                'stock' => $row['stock'],
            ],
            $product
        );
    }

    public function rules(): array
    {
        return ImportProductRule::rules();
    }

    public function uniqueBy(): string
    {
        return 'name';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->registerImport->storeOrUpdate('successful', $this->import);
            },
            ];
    }
}
