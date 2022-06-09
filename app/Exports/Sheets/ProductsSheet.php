<?php

namespace App\Exports\Sheets;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsSheet implements FromCollection, WithHeadings, WithTitle
{
    private ?string $start_price;
    private ?string $end_price;
    private ?string $start_stock;
    private ?string $end_stock;
    private ?string $category_id;

    public function __construct($start_price, $end_price, $start_stock, $end_stock, $category_id)
    {
        $this->start_price = $start_price;
        $this->end_price = $end_price;
        $this->start_stock = $start_stock;
        $this->end_stock = $end_stock;
        $this->category_id = $category_id;
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
            ->makeHidden(['image_route', 'amount']);
    }

    public function title(): string
    {
        return 'Products';
    }
}
