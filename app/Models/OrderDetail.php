<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table ='order_details';

    protected $fillable = [
        'order_id',
        'product_code',
        'product_name',
        'quantity_product',
        'price_product',
        'total_price'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'product_code', 'product_code');
    }
}
