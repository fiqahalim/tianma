<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name'          => $row['product_name'],
            'product_id_number'     => $row['product_id_number'],
            'product_code'          => $row['product_code'],
            'description'           => $row['description'] ?? $row['product_description'] ?? null,
            'price'                 => $row['price'],
            'selling_price'         => $row['selling_price'],
            'maintenance_price'     => $row['maintenance_price'],
            'list_price'            => $row['list_price'],
            'promotion_price'       => $row['promotion_price'],
            'point_value'           => $row['point_value'],
            'quantity_per_unit'     => $row['quantity_per_unit'],
            'total_cost'            => $row['total_cost'],
        ]);
    }
}
