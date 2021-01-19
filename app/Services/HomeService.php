<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use App\Models\Admin;


// use App\Models\Admin;

class HomeService implements HomeServiceInterface
{

    private function getMonthlyProfit()
    {
        $now = getdate();
        $total = [];
        // $a = ::query();
        $invoiceNows = Invoice::whereMonth('created_at', $now['mon']);
        // dd($invoiceNows->get());
        $priceNowCeramic = $invoiceNows->get()->map(function ($invoiceNow){
            return $invoiceNow->price_ceramic;
        });
        $priceNowTbvs = $invoiceNows->get()->map(function ($invoiceNow){
            return $invoiceNow->price_tbvs;
        });
        $priceNowAll = $invoiceNows->pluck('last_cost');

        $total['now']['ceramic'] = array_sum($priceNowCeramic->toArray());
        $total['now']['tbvs'] = array_sum($priceNowTbvs->toArray());
        $total['now']['all'] = array_sum($priceNowAll->toArray());

        $invoicePre1 = Invoice::whereMonth('created_at', $now['mon']-1);
        $pricePre1Ceramic = $invoicePre1->get()->map(function ($invoiceNow){
            return $invoiceNow->price_ceramic;
        });
        $pricePre1Tbvs = $invoicePre1->get()->map(function ($invoiceNow){
            return $invoiceNow->price_tbvs;
        });
        $pricePre1All = $invoicePre1->pluck('last_cost');

        $total['pre1']['ceramic'] = array_sum($pricePre1Ceramic->toArray());
        $total['pre1']['tbvs'] = array_sum($pricePre1Tbvs->toArray());
        $total['pre1']['all'] = array_sum($pricePre1All->toArray());


        $invoicePre2 = Invoice::whereMonth('created_at', $now['mon']-2);
        $pricePre2Ceramic = $invoicePre2->get()->map(function ($invoiceNow){
            return $invoiceNow->price_ceramic;
        });
        $pricePre2Tbvs = $invoicePre2->get()->map(function ($invoiceNow){
            return $invoiceNow->price_tbvs;
        });
        $pricePre2All = $invoicePre2->pluck('last_cost');

        $total['pre2']['ceramic'] = array_sum($pricePre2Ceramic->toArray());
        $total['pre2']['tbvs'] = array_sum($pricePre2Tbvs->toArray());
        $total['pre2']['all'] = array_sum($pricePre2All->toArray());

        $invoicePre3 = Invoice::whereMonth('created_at', $now['mon']-3);
        $pricePre3Ceramic = $invoicePre3->get()->map(function ($invoiceNow){
            return $invoiceNow->price_ceramic;
        });
        $pricePre3Tbvs = $invoicePre3->get()->map(function ($invoiceNow){
            return $invoiceNow->price_tbvs;
        });
        $pricePre3All = $invoicePre3->pluck('last_cost');

        $total['pre3']['ceramic'] = array_sum($pricePre3Ceramic->toArray());
        $total['pre3']['tbvs'] = array_sum($pricePre3Tbvs->toArray());
        $total['pre3']['all'] = array_sum($pricePre3All->toArray());
        return $total;
    }

    private function getPriceType($dataPriceType)
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

        foreach ($priceType as $key => $value) {
            $priceType[$key] = $dataPriceType->sum($key);
        }
        return $priceType;
    }
    
    public function getIndex()
    {
        $data = [];
        $products = Product::query();
        $data['count_product'] = $products->count();
        $invoices = Invoice::all();
        $data['count_invoice'] = $invoices->count();
        
        $users = User::query();
        $data['count_user'] = $users->count();
        $data['count_admin'] = Admin::query()->count();
        $data['sales'] = $this->getMonthlyProfit();
        
        $now = getdate();
        $data['month'] = [
            'now' => $now['mon'],
            'pre1' => $now['mon'] - 1,
            'pre2' => $now['mon'] - 2,
            'pre3' => $now['mon'] - 3
        ];

        $dataPriceType = $invoices->map(function ($invoice){
            return $invoice->price_type;
        });
        

        $data['price_type'] = $this->getPriceType($dataPriceType);
        
        $products = Product::all()->sortByDesc('count_buy')->take(10);
        $data['products'] = $products;
        // dd($data['products']);
        return $data;
    }

    
}
