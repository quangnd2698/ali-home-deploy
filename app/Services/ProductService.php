<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Comment;

class ProductService implements ProductServiceInterface
{
    /**
     * validate store Admin request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreProductRequest(array $params)
    {
        $validator = Validator::make($params, [
            'product_code' => 'required|unique:products|string|max:8',
            'product_name' => 'required|unique:products|string',
            'producer' => 'nullable|string|max:64',
            'size' => 'nullable|string|max:64',
            'material' => 'nullable|string|max:32',
            'color' => 'nullable|string|max:32',
            'surface' => 'nullable|string|max:32',
            'product_type' => 'required|string',
            'user_for' => 'nullable|string|max:255',
            'quantity_in_one_box' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'import_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'count_view' => 'nullable|numeric',
            'count_buy' => 'nullable|numeric',
            'number_error' => 'nullable|numeric',
            'status' => 'required|string|max:10',
            'point' => 'nullable|numeric',
            'description' => 'nullable|string|max:255',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    /**
     * validate update block request
     *
     * @param array $params
     * @param int $id
     * @return array
     */
    public function validateUpdateProductRequest(array $params, int $id)
    {
        $validator = Validator::make($params, [
            'product_code' => sprintf('sometimes|max:8|unique:products,product_code,%s|string', $id),
            'product_name' => sprintf('sometimes|unique:products,product_name,%s|string', $id),
            'producer' => 'nullable|string|max:64',
            'size' => 'nullable|string|max:64',
            'material' => 'nullable|string|max:32',
            'color' => 'nullable|string|max:32',
            'surface' => 'nullable|string|max:32',
            'user_for' => 'nullable|string|max:255',
            'quantity_in_one_box' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'import_price' => 'sometimes|numeric',
            'sale_price' => 'sometimes|numeric',
            'count_view' => 'nullable|numeric',
            'count_buy' => 'nullable|numeric',
            'number_error' => 'nullable|numeric',
            'status' => 'sometimes|string|max:10', 
            'point' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    function convert_vi_to_en($str) {
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "a", $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", "e", $str);
        $str = preg_replace("/(??|??|???|???|??)/", "i", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "o", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", "u", $str);
        $str = preg_replace("/(???|??|???|???|???)/", "y", $str);
        $str = preg_replace("/(??)/", "d", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "A", $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", "E", $str);
        $str = preg_replace("/(??|??|???|???|??)/", "I", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "O", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", "U", $str);
        $str = preg_replace("/(???|??|???|???|???)/", "Y", $str);
        $str = preg_replace("/(??)/", "D", $str);
        return $str;
    }

    public function createProduct(Request $request)
    {
        $data = $request->only([
            'product_code',
            'product_name',
            'producer',
            'product_type',
            'size',
            'material',
            'color',
            'surface',
            'type_code',
            'uses_for',
            'quantity_in_one_box',
            'quantity',
            'import_price',
            'sale_price',
            'status',
            'description',
        ]);

        $count =  Product::orderBy('id', 'DESC')->first()->id ?? 0;
        if (!$data['product_code']) {
            $data['product_code'] = 'SP-000' . ($count + 1);
        }
        $data['status'] = 'active';
        DB::beginTransaction();
        $images = $request->images;
        if (isset($images)) {
            foreach ($images as $image) {
                $paramImage['product_code'] = $data['product_code'];
    
                    $filename = time() . rand(1000, 99999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/products'), $filename);
                    $paramImage['name'] = $filename;
    
                try {
                    Image::create($paramImage);
                } catch (Exception $e) {
                    DB::rollBack();
                }
            }
        }

        list($success, $errors) = $this->validateStoreProductRequest($data);
        if (!$success) {
            \DB::rollBack();
            return [false , $errors];
        }
        try {
            Product::create($data);
        } catch (Exception $e) {
            \DB::rollBack();
        }

        DB::commit();

        return [true, ''];
    }


    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->only([
            'product_code',
            'product_name',
            'producer',
            'product_type',
            'size',
            'material',
            'color',
            'surface',
            'uses_for',
            'quantity_in_one_box',
            'quantity',
            'import_price',
            'sale_price',
            'status',
            'description',
        ]);

        list($success, $errors) = $this->validateUpdateProductRequest($data, $id);
        if (!$success) {
            \DB::rollBack();
            return [false , $errors];
        }
        $listId = explode(',', $request->remove_images) ?? null;

        \DB::beginTransaction();
        $images = $request->images ?? null;
        if (isset($images)) {
            foreach ($images as $image) {
                $paramImage['product_code'] = $data['product_code'];
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/products'), $filename);
                    $paramImage['name'] = $filename;
                try {
                    Image::create($paramImage);
                } catch (Exception $e) {
                    DB::rollBack();
                }
            }
        }

        $removeImages = $listId[0] ? Image::whereIn('id', $listId)->get() : null;
        if (isset($removeImages)) {
            foreach ($removeImages as $image) {
                $image_path = public_path('images/products/' . $image->name);
                if ($image->name && file_exists($image_path)) {
                    unlink($image_path);
                }
                $image->delete();
            }
            
        }

        try {
            $product->update($data);
        } catch (Exception $e) {
            \DB::rollBack();
        }

        DB::commit();
        return [true, ''];
    }

    public function deleteMoreProduct($request)
    {
        $param = $request->all();
        $listId = explode(',', $param['checkbox_selected']);

        $products = Product::whereIn('id', $listId);
        $imagesId = $products->pluck('id');
        $images = Image::whereIn('id', $imagesId);
        $cmtId = $products->pluck('id');
        $comments = Comment::whereIn('id', $cmtId);

        \DB::beginTransaction();

        try {
            $images->delete();
            $comments->delete();
            $products->delete();
        } catch (Exception  $e) {
            \DB::rollback();
            return [false, $e->getMessage()];
        }
        \DB::commit();
        return [true, ''];
    }
}
