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

    protected $appends = [
        'price_ceramic',
        'price_tbvs',
        'price_type'
    ];

    public function invoiceDetail() {
        return $this->hasMany('App\Models\InvoiceDetail', 'invoice_code', 'invoice_code');
    }

    public function getPriceCeramicAttribute()
    {
        $priceCeramic = 0;
        $details = $this->invoiceDetail()->get();
        foreach ($details as $detail) {
            // dd($detail->product_type);
            $priceCeramic += $detail->product_type == 'ceramic' ? $detail->total_price : 0;
        }

        return $this->last_cost * ($priceCeramic / $this->total_cost);
    }

    public function getPriceTbvsAttribute()
    {
        $priceTbvs = 0;
        $details = $this->invoiceDetail()->get();
        foreach ($details as $detail) {
            $priceTbvs += $detail->product_type == 'TBVS' ? $detail->total_price : 0;
        }

        return $this->last_cost * ($priceTbvs / $this->total_cost);
    }

    public function getPriceTypeAttribute()
    {
        $priceType = [
            'gach_lat' => 0,
            'gach_op' => 0,
            'gach_bong' => 0,
            'gach_trang_tri' => 0,
            'gach_via_he' => 0,
            'gach_gia_go' => 0,
            'bon_cau' => 0,
            'PKNT' => 0,
            'TBNL' => 0,
        ];
        $details = $this->invoiceDetail()->get();
        foreach ($details as $detail) {
            switch ($detail->type_code) {
                case 'gach-lat':
                    $priceType['gach_lat'] += $detail->total_price;
                    break;
                case 'gach-op':
                    $priceType['gach_op'] += $detail->total_price;
                    break;
                case 'gach-bong':
                    $priceType['gach_bong'] += $detail->total_price;
                    break;
                case 'gach-trang-tri':
                    $priceType['gach_trang_tri'] += $detail->total_price;
                    break;
                case 'gach-gia-go':
                    $priceType['gach_gia_go'] += $detail->total_price;
                    break;
                case 'gach-via-he':
                    $priceType['gach_via_he'] += $detail->total_price;
                    break;
                case 'bon-cau':
                    $priceType['bon_cau'] += $detail->total_price;
                    break;
                case 'PKNT':
                    $priceType['PKNT'] += $detail->total_price;
                    break;
                case 'TBNL':
                    $priceType['TBNL'] += $detail->total_price;
                    break;
                default:
                    # code...
                    break;
            }
        }

        foreach ($priceType as $key => $value) {
            $priceType[$key] = $this->last_cost * ($value / $this->total_cost);
        }

        return $priceType;
    }
}
