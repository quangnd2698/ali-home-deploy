<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_phone',
        'total_prices',
        'point_used',
        'preferential',
        'order_status',
        'cost',
        // 'status',
    ];

    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }
}
