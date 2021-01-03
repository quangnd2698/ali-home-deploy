<?php

namespace App\Services;

// use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
        $address = $params['customer_address']. ' ' . $params['ward'] . ' ' . $params['district'] . ' ' . $params['province'];
        $params['customer_address'] = $address;
        $params['order_status'] = 1;
        list($success, $errors) = $this->validateStoreOrderRequest($params);
        if(!$success) {
            return [false, $errors];
        }
        \DB::beginTransaction();
        $order = Order::create($params);
        if (Auth::guard('web')->check()) {
            $carts = Cart::with('product')->where('user_id', Auth::guard('web')->id());
            try {
                foreach ($carts as $key => $cart) {
                    $dataOrder['order_id'] = $order->id;
                    $dataOrder['product_code'] = $cart->product->product_code;
                    $dataOrder['product_name'] = $cart->product_name;
                    $dataOrder['quantity_product'] = $cart->quantity;
                    $dataOrder['price_product'] = $cart->price;
                    $dataOrder['total_price'] = $cart->total_price;
                    $orderDetail = OrderDetail::create($dataOrder);
                    $orderDetail->product->quantity = $orderDetail->product->quantity - $dataOrder['quantity_product'];
                    $orderDetail->product->save();
                }
            } catch (Exception $e) {
                \DB::rollBack();
                return [false, $e->getMessage()];
            }

            $carts->delete();
        } else if(isset($_COOKIE['cart_product'])) {
            $data = explode(",", $_COOKIE['cart_product']);
            unset($data[0]);
            array_pop($data);
            $products = Product::whereIn('id', $data)->get();

            try {
                foreach ($products as $key => $product) {
                    $dataOrder['order_id'] = $order->id;
                    $dataOrder['product_code'] = $product->product_code;
                    $dataOrder['product_name'] = $product->product_name;
                    $dataOrder['quantity_product'] = $_COOKIE['count_product-' . $product->id];
                    $dataOrder['price_product'] = $product->sale_price;
                    $dataOrder['total_price'] = $product->sale_price *  $dataOrder['quantity_product'];
                    $orderDetail = OrderDetail::create($dataOrder);
                    $product->quantity = $orderDetail->product->quantity - $dataOrder['quantity_product'];
                    $product->save();
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
        event(new MessageSent($notification));
        return [true, ''];
    }
}
