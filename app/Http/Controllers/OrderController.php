<?php

namespace App\Http\Controllers;

use App\Models\AccumulatePoint;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\OrderServiceInterface;

class OrderController extends Controller
{
    // static $totalPrice;
    protected $totalPrice;
    public function __construct(OrderServiceInterface $orderService)
    {
        $carts = Cart::query()->get();
        foreach($carts as $cart) {
            $this->totalPrice += $cart->product->price * $cart->quantity; 
        }
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::query()->get();
        return view('admin/orders/index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = Cart::query()->get();
        return view('admin/orders/create', [
            'carts' => $carts,
            'totalPrice' => $this->totalPrice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paramOrder = $request->only([
            'customer_name',
            'customer_address',
            'customer_phone',
            'cost',
            'ward',
            'district',
            'province',
            'point_used',
            'preferential',
            'total_prices'
        ]);

        list($success, $errors) = $this->orderService->storeOrder($paramOrder);
        if (!$success) {
            return redirect()->route('client.checkouts')->withErrors($errors);
        }

        return view('client/checkout_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderDetail->each(function ($item, $key) {
            $item->delete();
        });
        $order->delete();
        alert()->success('xóa đơn hàng', 'thành công');
        return redirect()->route('orders.index');
    }

    public function getPrice($id)
    {
        $accumulatePoint = AccumulatePoint::where('customer_phone', $id)->first();
        $rank = '';
        switch ($accumulatePoint->rank) {
            case  'normal':
                $rank = 'bình thường';
            break;
            case  'potential':
                $rank = 'tiềm năng';
            break;
            case  'chummy':
                $rank = 'thân thiết';
            break;
            case  'excellent':
                $rank = 'ưu tú';
            break;
            case  'vip':
                $rank = 'vip';
            break;
            default:
        }
        // case 
        if ($accumulatePoint) {
            $lastCost = $this->totalPrice * (100 - $accumulatePoint->percent)/100;
            $lastCost = round($lastCost,0);
            return ['<div class="col-12">
            <div class="row"><p style="margin-left:5px" class="col-7"> Cấp: <span><b>'.$rank .'</b></span></p><p class="col-4">giảm:<b id="percent">'. $accumulatePoint->percent.'</b>%</p>
            </div>
            <div class="row"><p class="col-9">Số điểm đang có: <h5 id="point">'.$accumulatePoint->point.'</h5> </p>
            </div>
        </div>
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Sử dụng điểm
            </button>
        </p>
        <div class="collapse col-12" id="collapseExample" >
                <input style="padding:0px" class="form-control" value="0" type="number" min="0" max="'. $accumulatePoint->point .'" name="point_used" onchange="getPointUse(this)" >

        </div>', $lastCost, $accumulatePoint->percent];
        }
        return ['', $this->totalPrice, 0 ];
        
    }

    public function getLastMoney($data)
    {
        list($percent, $point) = explode(',', $data);
        $percent = isset($percent) ? (int) $percent : 0;
        $point = isset($point) ? (int) $point : 0;
        $lastCost = ($this->totalPrice * (100 - $percent) /100) - ($point*400);
        $lastCost = round($lastCost,0);
        return $lastCost;
    }
}
