<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportInvoice extends Model
{
    use HasFactory;

    protected $tables = 'import_invoices';

    protected $fillable = [
        'invoice_code',
        'staff_make',
        'total_cost',
        'unit_of_delivery'
    ];

    public function importinvoiceDetail() {
        return $this->hasMany('App\Models\ImportInvoiceDetail', 'invoice_code', 'invoice_code');
    }
}
