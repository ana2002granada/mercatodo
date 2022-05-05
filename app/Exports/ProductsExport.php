<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsExport implements FromCollection, WithHeadings, ShouldQueue
{
    use Exportable;

    private ?string $start_price;
    private ?string $end_price;
    private ?string $start_stock;
    private ?string $end_stock;
    private ?string $category_id;

    public function __construct(Request $request)
    {
        $this->start_price = $request->start_price;
        $this->end_price = $request->end_price;
        $this->start_stock = $request->start_stock;
        $this->end_stock = $request->end_stock;
        $this->category_id = $request->category_id;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Description',
            'Category_id',
            'Price',
            'Stock',
        ];
    }

    public function collection(): Collection
    {
        return Product::query()
            ->priceFilter($this->start_price, $this->end_price)
            ->stockFilter($this->start_stock, $this->end_stock)
            ->categoryFilter($this->category_id)->with('category:id,name')
            ->select('id', 'name', 'description', 'category_id', 'price', 'stock')
            ->get()
            ->makeHidden(['image_route','amount']);
    }
}
