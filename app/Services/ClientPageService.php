<?php

namespace App\Services;

// use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class ClientPageService implements ClientPageServiceInterface
{

    public function getProducts($params, $request)
    {   
        $products  = Product::where('status', 'active');
        $data = explode(',', $params);
        $brands = Brand::query();

        $filter = [];
        $filter['typeProduct'] = $data[0] ?? null;
        $filter['type'] = $request['type'] ?? null;
        if ($filter['typeProduct'] == 'ceramic') {
            $products  = $products->where('product_type', 'ceramic');
            $filter['size'] = array_unique($products->pluck('size')->toArray());
            $brands = $brands->where('type_product', 'gạch')->get();
            $products = ($filter['type'] == 'all')
                ? $products->orderBy('created_at', 'desc')
                : $products->where('type_code', 'like' ,'%' . $filter['type'] . '%');
        }

        if ($filter['typeProduct'] == 'TBVS') {
            $products  = $products->where('product_type', 'TBVS');
            $brands = $brands->where('type_product', 'TBVS')->get();
            $products = ($filter['type'] == 'all')
                ? $products->orderBy('created_at', 'desc')
                : $products->where('type_code', 'like' ,'%' . $filter['type'] . '%');
        }
        
        if (isset($request['brand_selected']) && $request['brand_selected'] !== 'all') {
            $brandNames = explode('-', $request['brand_selected']);
            $products = $products->whereIn('producer', $brandNames);
        }

        if (isset($request['size_selected']) && $request['size_selected'] !== 'all') {
            $sizes = explode('-', $request['size_selected']);
            $products = $products->whereIn('size', $sizes);
        }

        if (isset($request['price'])) {
            $price = explode(';', $request['price']);
            $products = $products->where('sale_price', '>', $price[0])
                                ->where('sale_price', '<', $price[1]);
        }

        // if (isset($request['color_selected']) && $request['color_selected'] !== 'all') {
        //     $colors = explode('-', $request['color_selected']);
        //     $products->where('color', 'like', '%'.$colors[0].'%')
        //         ->orWhere('color', 'like', '%'.$colors[1].'%');
        //         // ->orWhere('color', 'like', '%'.$colors[2].'%');
        //         // ->orWhere('color', 'like', '%'.$colors[3].'%')
        //         // ->orWhere('color', 'like', '%'.$colors[4].'%')
        //         // ->orWhere('color', 'like', '%'.$colors[5].'%')
        //         // ->orWhere('color', 'like', '%'.$colors[6].'%');

        //     // $products = $products->whereIn('size', 'like', '%'.$sizes.'%');
        // }

        $orderBy = $request['order_by'] ?? null;

        switch ($orderBy) {
            case 'thap-cao':
                // dump(14);
                $products = $products->orderBy('sale_price', 'ASC');
                break;
            case 'cao-thap':
                $products = $products->orderBy('sale_price', 'desc');
                break;
            // case 'ban-chay-nhat':
            //     $products = $products->orderBy('count_buy', 'desc');
            //     break;
            default:
                $products = $products->orderBy('created_at', 'desc');
                break;
        }

        $filter['count'] = $products->count();
        $products = $products->paginate(16);
        
        return [$products, $brands, $filter];
    }

    public function validateContactRequest(array $params)
    {
        $validator = Validator::make($params, [
            'title' => 'required|max:255',
            'message' => 'required',
            'email' => 'required|email',
            'name' => 'required|string|max:255'
        ]);
        return [$validator->passes(), $validator->errors()];
    }

}
