<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Brand;
use App\Models\ProductModel;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductServiceInterface $productService, Product $product)
    {
        $this->productService = $productService;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::where('product_code', 'SP-001')->first();
        return view('admin/products/index', ['products' => $this->product->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::query()->get();
        $models = ProductModel::query()->get();
        return view('admin/products/create', ['brands' => $brands, 'models' => $models]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        list($success, $errors) = $this->productService->createProduct($request);
        if (!$success) {
            return redirect()->route('products.create')->withErrors($errors);
        }
        alert()->success('Thêm mới sản phẩm', 'thành công');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // dd($product->images);
        $brands = Brand::query()->get();
        return view('admin/products/edit', compact('product'), compact('brands'));
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
        list($success, $errors) = $this->productService->updateProduct($request, $id);
        if (!$success) {
            return redirect()->route('products.edit', $id)->withErrors($errors);
        }
        alert()->success('Sửa sản phẩm', 'thành công');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $images = Image::where('product_code', $product);
        try {
            $images->delete();
            $product->delete();
        } catch (Exception $e) {
            return redirect()->route('importInvoices.index')->withErrors($e->getMessage());
        }
        alert()->success('xóa sản phẩm', 'thành công');
        return redirect()->route('products.index');
    }

    public function deleteMore(Request $request)
    {
        // if (\Gate::allows('isAdmin')) {
            
        list($success, $errors) = $this->productService->deleteMoreProduct($request);
        if (!$success) {
            return redirect()->route('products.index')->withErrors($errors);
        }
        alert()->success('Xóa phiếu', 'thành công');
        return redirect()->route('products.index');
        // }
        // return redirect()->to('403');
    }

    public function searchByName(Request $request)
    {

        $params = $request->value;
        $searchParams = explode(' ',$params);
        $searchParam2 = array_map(function ($value){
            return ucwords($value);
        }, $searchParams);
        
        $searchParam3 = array_map(function ($value){
            return $this->product->convert_vi_to_en($value);
        }, $searchParams);

        $data = collect();

        foreach ($searchParams as $param) {
            $products =  Product::where('product_name', 'like', '%' . $param . '%')
                ->orWhere('product_code', 'like', '%' . $param . '%')
                ->orWhere('producer', 'like', '%' . $param . '%')->get();
            $data = $data->merge($products);
        }

        foreach ($searchParams as $param) {
            $products =  Product::where('product_name', 'like', '%' . $param . '%')
                ->orWhere('product_code', 'like', '%' . $param . '%')
                ->orWhere('producer', 'like', '%' . $param . '%')->get();
            $data = $data->merge($products);
        }

        foreach ($searchParam2 as $param) {
            $products =  Product::where('product_name', 'like', '%' . $param . '%')
                ->orWhere('product_code', 'like', '%' . $param . '%')
                ->orWhere('producer', 'like', '%' . $param . '%')->get();
            $data = $data->merge($products);
        }

        foreach ($searchParam3 as $param) {
            $products =  Product::where('product_name', 'like', '%' . $param . '%')
                ->orWhere('product_code', 'like', '%' . $param . '%')
                ->orWhere('producer', 'like', '%' . $param . '%')->get();
            $data = $data->merge($products);
        }

        return response()->json($data);
    }

    public function searchByProductCode(Request $request)
    {
        // dd(1);
        $products = Product::where('product_code', 'like', '%' . $request->value . '%')->get();

        return response()->json($products);
    }

}
