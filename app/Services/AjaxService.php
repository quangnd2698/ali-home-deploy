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

    public function addInvoice($order)
    {
        $data = $order->only([
            'customer_name',
            'customer_phone',
            'total_prices',
            'preferential',
            'order_status',
            'cost',
        ]);
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
        Invoice::create($data);
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
        // \Log::info($quantity);
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

}
