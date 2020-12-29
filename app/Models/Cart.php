<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',

    ];
    protected $appends = [
        'product_name',
        'price',
        'total_price',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id', 'id');
    }

    public function getProductNameAttribute()
    {
        return $this->product->product_name;
    }

    public function getPriceAttribute()
    {
        return $this->product->sale_price;
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }
}
