<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $tables = 'invoice_details';

    protected $fillable = [
        'invoice_code',
        'product_code',
        'product_name',
        'unit',
        'quantity_product',
        'price_product',
        'total_price'
    ];

    protected $appends = [
        'product_type',
        'type_code'
    ];

    public function getProductTypeAttribute()
    {
        return Product::where('product_code', $this->product_code)->first()->product_type ?? null;
    }

    public function getTypeCodeAttribute()
    {
        return Product::where('product_code', $this->product_code)->first()->type_code ?? null;
    }

}
