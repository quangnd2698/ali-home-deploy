<?php

namespace App\Services;

// use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;
use App\Models\OrderDetail;

class OrderService implements OrderServiceInterface
{
    /**
     * validate store Admin request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreOrderRequest(array $params)
    {
        $validator = Validator::make($params, [
            'customer_name' => 'required|string|max:64',
            'customer_address' => 'required|string|max:124',
            'customer_phone' => 'required|numeric|between:10000000,99999999999|',
            'total_prices' => 'required|numeric',
            'point_used' => 'nullable|numeric',
            'preferential' => 'nullable|string',
            'cost' => 'required|numeric',
            'order_status' => 'nullable|numeric'
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    public function storeOrder($params)
    {
        // $param = $request->all();
        // dd($params);
        $address = $params['customer_address']. ' ' . $params['ward'] . ' ' . $params['district'] . ' ' . $params['province'];
        $params['customer_address'] = $address;
        $params['order_status'] = 1;
        list($success, $errors) = $this->validateStoreOrderRequest($params);
        if(!$success) {
            return [false, $errors];
        }
        \DB::beginTransaction();
        $order = Order::create($params);
        if(isset($_COOKIE['cart_product'])) {
            $data = explode(",", $_COOKIE['cart_product']);
            unset($data[0]);
            array_pop($data);
            $products = Product::whereIn('id', $data)->get();

            try {
                foreach ($products as $key => $product) {
                    $data['order_id'] = $order->id;
                    $data['product_code'] = $product->product_code;
                    $data['product_name'] = $product->product_name;
                    $data['quantity_product'] = $_COOKIE['count_product-' . $product->id];
                    $data['price_product'] = $product->sale_price;
                    $data['total_price'] = $product->sale_price *  $data['quantity_product'];
                    // dd(1);
                    OrderDetail::create($data);
                }
            } catch (Exception $e) {
                \DB::rollBack();
                return [false, $e->getMessage()];
            }
        }

        \DB::commit();        
        
        $notification['name'] = $params['customer_name'];
        $notification['created_at'] = date_format($order->created_at,"Y/m/d H:i:s");
        $notification['cost'] = number_format($order->cost, 0, ',', ' ');
        // dd($notification);
        // $notification['created_at'] = $order->created_at;
        event(new MessageSent($notification));
        // dd(1);
        return [true, ''];
    }
}
