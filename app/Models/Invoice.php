<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $tables = 'invoices';

    protected $fillable = [
        'invoice_code',
        'staff_sale',
        'introduce_staff',
        'customer_name',
        'customer_phone',
        'total_cost',
        'preferential',
        'last_cost',
        'sales_channel',
    ];

    public function invoiceDetail() {
        return $this->hasMany('App\Models\InvoiceDetail', 'invoice_code', 'invoice_code');
    }
}
