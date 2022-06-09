<?php

namespace App\Exports;

use App\Exports\Sheets\CategoriesSheet;
use App\Exports\Sheets\ProductsSheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsExport implements ShouldQueue, WithMultipleSheets
{
    use Exportable;

    protected ?string $start_price;
    protected ?string $end_price;
    protected ?string $start_stock;
    protected ?string $end_stock;
    protected ?string $category_id;

    public function __construct(Request $request)
    {
        $this->start_price = $request->start_price;
        $this->end_price = $request->end_price;
        $this->start_stock = $request->start_stock;
        $this->end_stock = $request->end_stock;
        $this->category_id = $request->category_id;
    }

    public function sheets(): array
    {
        return [new ProductsSheet(
            $this->start_price,
            $this->end_price,
            $this->start_stock,
            $this->end_stock,
            $this->category_id
        ), new CategoriesSheet()];
    }
}
