<?php

namespace App\Services;

// use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;
use App\Models\OrderDetail;
use App\Models\ProductModel;
use App\Models\Brand;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\AccumulatePoint;

class AjaxService implements AjaxServiceInterface
{
    /**
     * validate store Admin request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreProductModelRequest(array $params)
    {
        $validator = Validator::make($params, [
            'product_model' => 'required|string|max:64',
            'type_code' => 'required|string|max:124',
            'product_type' => 'required|string|max:124',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    public function storeProductModel($params)
    {
        list($success, $errors) = $this->validateStoreProductModelRequest($params);
        if(!$success) {
            return [false];
        }
        ProductModel::create($params);
        return [true];
    }

    /**
     * validate store Admin request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreBrandRequest(array $params)
    {
        $validator = Validator::make($params, [
            'brand_name' => 'required|string|max:64',
            'type_product' => 'required|string|max:124',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    public function storeBrand($params)
    {
        list($success, $errors) = $this->validateStoreBrandRequest($params);
        \Log::info($params);
        if(!$success) {
            return [false];
        }
        Brand::create($params);
        return [true];
    }

    public function setAccumulatePoint($customerPhone, int $totalCost, int $pointUsed, $customerName)
    {
        $accumulatePoint = AccumulatePoint::where('customer_phone', $customerPhone)->first();
        if ($accumulatePoint) {
            $accumulatePoint->point += (ROUND(($totalCost / 10000),0) - $pointUsed);
            switch (true) {
                case ($accumulatePoint->point <= 1000):
                    $accumulatePoint->rank = 'normal';
                break;
                case ($accumulatePoint->point > 1000 && $accumulatePoint->point <= 2500):
                    $accumulatePoint->rank = 'potential';
                break;
                case ($accumulatePoint->point > 2500 && $accumulatePoint->point <= 7000):
                    $accumulatePoint->rank = 'chummy';
                break;
                case ($accumulatePoint->point > 7000 && $accumulatePoint->point <= 15000):
                    $accumulatePoint->rank = 'excellent';
                break;
                case ($accumulatePoint->point > 15000): 
                    $accumulatePoint->rank = 'vip';
                break;
                default:
            }
            $accumulatePoint->save();
        } else {
            $paramAcc['customer_phone'] = $customerPhone;
            $paramAcc['name'] = $customerName;
            $paramAcc['point'] = ROUND(($totalCost / 10000),0);
            switch (true) {
                case ($paramAcc['point'] <= 1000):
                    $paramAcc['rank'] = 'normal';
                break;
                case ($paramAcc['point'] > 1000 && $paramAcc['point'] <= 2500):
                    $paramAcc['rank'] = 'potential';
                break;
                case ($paramAcc['point'] > 2500 && $paramAcc['point'] <= 7000):
                    $paramAcc['rank'] = 'chummy';
                break;
                case ($paramAcc['point'] > 7000 && $paramAcc['point'] <= 15000):
                    $paramAcc['rank'] = 'excellent';
                break;
                case ($paramAcc['point'] > 15000): 
                    $paramAcc['rank'] = 'vip';
                break;
                default:
            }
            AccumulatePoint::create($paramAcc);
        }
    }

    public function addInvoice($order)
    {
        $data = $order->only([
            'customer_name',
            'customer_phone',
            'total_prices',
            'preferential',
            'order_status',
            'cost'
        ]);
        $pointUsed = $order->point_used;
        $count =  Invoice::orderBy('id', 'DESC')->first()->id ?? 0;
        $data['invoice_code'] = 'EIV-000'. ($count + 1);
        $data['total_cost'] = $order->total_prices;
        $data['last_cost'] = $order->cost;
        $data['sales_channel'] = 'web';
        $data['staff_sale'] = 'web';
        \DB::beginTransaction();
        foreach ($order->orderDetail as $key => $orderDetail) {
            $dataDetail = $orderDetail->only([
                'product_code',
                'product_name',
                'quantity_product',
                'price_product',
                'total_price'
            ]);

            $dataDetail['invoice_code'] = $data['invoice_code'];
            InvoiceDetail::create($dataDetail);
        }
        $invoice = Invoice::create($data);
        \Log::info($invoice->customer_phone);
        $this->setAccumulatePoint( $invoice->customer_phone,
            $invoice->last_cost ?? 0,
            $pointUsed ?? 0,
            $invoice->customer_name,
        );
        $order->orderDetail()->delete();
        $order->delete();
        \DB::commit();
    }

    public function changeOrderStatus(array $params)
    {
        $order = Order::findOrFail($params['id']);
        switch ($params['status']) {
            case 1:
                $order->order_status = 2;
                $order->save();
                break;
            case 2:
                $order->order_status = 3;
                $order->save();
                break;
            case 3:
                $this->addInvoice($order);
                break;
            default:
                break;
        }

        return true;
    }

    public function checkQuantity($id, $quantity)
    {
        $product = Product::findOrFail($id);

        if ($product->quantity < $quantity) {
            return [
                'result' => false,
                'count' => $product->quantity
            ];
        }

        return [
            'result' => true,
            'count' => $quantity
        ];
    }

    public function userLogin($credentials)
    {

        if (\Auth::guard('web')->attempt($credentials)) {
            return "true";
        }
        return "false";
    }

}
