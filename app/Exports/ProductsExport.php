<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category')->get()->map(function ($product) {
            return [
                'ID' => $product->id,
                'Name' => $product->name,
                'Category' => $product->category?->name,
                'Price' => $product->price,
                'Stock' => $product->stock,
                'Created At' => $product->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Category', 'Price', 'Stock', 'Created At'];
    }
}
