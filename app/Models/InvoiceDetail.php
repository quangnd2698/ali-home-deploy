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
}
