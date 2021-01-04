<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Brand;
use App\Models\User;
use App\Services\ClientPageServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use Mail;

class ClientPageController extends Controller
{
    public function __construct(ClientPageServiceInterface $clientPageService)
    {
        $this->clientPageService = $clientPageService;
    }
    public function getHome() {
        $newProducts  = Product::query()->orderBy('created_at', 'desc')->get()->take(10);
        // $topBuyProducts  = Product::query()->orderBy('count_buy', 'desc')->get()->take(10);
        $saleProducts  = Product::query()->take(10)->get();
        return view('client/home', [
            'newProducts' => $newProducts,
            // 'topBuyProducts' => $topBuyProducts,
            'saleProducts' => $saleProducts,
        ]);
    }

    public function getProducts($params, Request $request) {
        list($products, $brands, $filter) = $this->clientPageService->getProducts($params, $request->all());
        return view('client/product', [
            'products' => $products,
            'brands' => $brands,
            'filter' => $filter,
        ]);
    }

    public function getProductDetail($id) {
        $product  = Product::findOrFail($id);
        $products = Product::where('status', 'active')->get();
        $data['ceramic_count'] = $products->where('product_type', 'ceramic')->count() ?? 0;
        $data['tbvs'] = $products->where('product_type', 'TBVS')->count() ?? 0;
        $similarProducts = Product::where('producer', $product->producter)
            ->orWhere('product_type', $product->product_type);
        $similarProducts = $similarProducts->where('sale_price', '<', $product->sale_price + 30000)
            ->Where('sale_price', '>', $product->sale_price - 30000)->take(10)->get();
        
        $product->count_view = $product->count_view + 1;
        $product->save();
        return view('client/product_detail', [
            'product' => $product,
            'similarProducts' => $similarProducts,
            'data' => $data
        ]);
    }

    public function AddToCart(Request $request) {
        $params = $request->all();
        $params['user_id'] = Auth::guard('web')->id();
        Cart::create($params);
        return 'ok';
    }

    public function updateCart(Request $request) {
        $cart = Cart::findOrFail($request->id);
        $action = $request->action;
        if ($action == 'update') {
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        
        if ($action == 'delete') {
            $cart->delete();
        }
        return 'ok';
    }

    public function getCart() {

        $params = null;
        $carts = [];
        if (Auth::guard('web')->check()) {
            $carts = Cart::where('user_id', Auth::guard('web')->id())->get();
        } elseif(isset($_COOKIE['cart_product'])) {
            $data = explode(",", $_COOKIE['cart_product']);
            unset($data[0]);
            array_pop($data);
            $products = Product::whereIn('id', $data)->get();
            // $productQuantity = $products->pluck('quantity');
            $params = $products->map(function ($product, $key) {
                return [
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'quantity' =>$_COOKIE['count_product-' . $product->id] ?? 1,
                    'price' => $product->sale_price,
                    'total_price' => $product->sale_price * ($_COOKIE['count_product-' . $product->id] ?? 1),
                    'max_quantity' => $product->quantity,
                ];
            });
            foreach ($params as $param) {
                $cart = (object) $param;
                array_push($carts, $cart);
            }
        }
        return view('client/cart', compact('carts'));
    }

    public function getCheckout()
    {
        $last_cost = 0;
        if (Auth::guard('web')->check()) {
            $carts = Cart::where('user_id', Auth::guard('web')->id())->get();
            $listTotalPrice = $carts->map(function($cart){
                return $cart->total_price;
            })->toArray();
            $last_cost = array_sum($listTotalPrice);
        } elseif(isset($_COOKIE['cart_product'])) {
            $data = explode(",", $_COOKIE['cart_product']);
            unset($data[0]);
            array_pop($data);
            $products = Product::whereIn('id', $data)->get();

            foreach ($products as $product) {
                $last_cost += $product->sale_price * ($_COOKIE['count_product-' . $product->id]);
            }
        }

        $provinces = Province::query()->get();
        $districts = District::where('province_id', 46)->get();
        $wards = Ward::where('district_id', 536)->get();

        return view('client/order', [
            'last_cost' => $last_cost,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards
        ]);
    }

    public function checkoutSuccess(Request $request)
    {
        return view('client/checkout_success');
    }

    public function getSignUp(Request $request)
    {
        $provinces = Province::query()->get();
        $districts = District::where('province_id', 46)->get();
        $wards = Ward::where('district_id', 536)->get();
        return view('client/sign_up', [
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards
        ]);
    }

    public function getPromotion()
    {
        return view('client/promotion');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMail()
    {
        return View('client/contact');
    }

    public function storeMail(Request $request)
    {
        $params = $request->only([
            'title',
            'message',
            'email',
            'name',
        ]);
        list($success, $errors) = $this->clientPageService->validateContactRequest($params);
        if (!$success) {
            return redirect()->route('users.contact.index')->withErrors($errors);
        }
        
        $contactMail = new SendEmail($params);
        // $sendEmailJob = new SendEmailJob($contactMail);
        Mail::to('alihomeht@gmail.com')->send($contactMail);
        // dispatch($sendEmailJob);
        alert()->success('gửi', 'thành công');
        return redirect()->route('users.contact.index');
    }

    public function getProfile($id)
    {
        $user = User::with('invoice')->findOrFail($id);
        return view('client/profile', ['user' => $user]);
    }
}