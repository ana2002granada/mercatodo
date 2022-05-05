<?php

namespace App\Exports\Sheets;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CategoriesSheet implements FromCollection, WithTitle, WithHeadings
{


    public function collection(): Collection
    {
        return Category::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get()
            ->makeHidden(['show_route', 'image_route', 'products_count']);
    }

    public function title(): string
    {
        return 'Categories';
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name'
        ];
    }
}
