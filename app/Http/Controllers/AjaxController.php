<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Comment;
use App\Models\Point;
use App\Services\AjaxServiceInterface;
use App\Models\Product;

class AjaxController extends Controller
{
    public function __construct(AjaxServiceInterface $ajaxService)
    {
        $this->ajaxService =$ajaxService;
    }

    public function getDistricts($id)
    {
        $province_id = Province::where('name', $id)->value('id');
        $districts = District::where('province_id', $province_id)->get();
        $wards = Ward::where('district_id', $districts->first()->id)->get();

        $districts_form = '';
        $wards_form = '';
        foreach ($districts as $district) {
            $districts_form .= '<option value="' . $district->name . '">' . $district->name . '</option>';
        }
        foreach ($wards as $ward) {
            $wards_form .= '<option value="' . $ward->name . '">' . $ward->name . '</option>';
        }

        return [$districts_form, $wards_form];
    }

    public function getWards($id)
    {
        $districts_id = District::where('name', $id)->value('id');

        $wards = Ward::where('district_id', $districts_id)->get();
        $wards_form = '';
        foreach ($wards as $ward) {
            $wards_form .= '<option value="' . $ward->name . '">' . $ward->name . '</option>';
        }
        return $wards_form;
    }

    public function storeComment(Request $request)
    {
        $paramComment = $request->only([
            'user_id',
            'user_name',
            'product_id',
            'comment',
            'point'
        ]);

        // \DB::beginTransaction();
        $comment = Comment::create($paramComment);
        // \DB::commit();
        
        $text = '';
        for ($i = 1; $i <= $paramComment['point']; $i++) { 
            $text .= '<i class="fa fa-star"></i>';
        }

        for ($i = 5; $i > $paramComment['point']; $i--) { 
            $text .= '<i class="icon-copy fa fa-star-o"></i>';
        }

        return '<div>
                    <p style="color: #FF9900; font-size: 14px; margin-bottom: 5px">'. $text. '</p>
                    <small>Bởi: <b style="margin-right: 30px">'. $request->user_name .' </b> vào ngày:'. $comment->created_at->format('d-m-Y').'</small>
                    <p>'. $comment->comment .'</p>
                </div>
                <hr>';
    }

    public function storeProductModel(Request $request)
    {
        list($success) = $this->ajaxService->storeProductModel($request->all());
        
        if (!$success) {
            return false;
        }
        return true;
    }

    public function storeBrand(Request $request)
    {
        list($success) = $this->ajaxService->storeBrand($request->all());
        if (!$success) {
            return false;
        }
        return true;
    }
    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $result = '';
        // $status = '';
        if ($product->status === 'active') {
            $product->status = 'off';
            $result = 'Kinh Doanh';
            // $status = 'off';
        } else {
            $product->status = 'active';
            $result = 'Ngừng Kinh Doanh';
        }
        $product->save();
        $data = [
            'result' => $result,
            'status' => $product->status,
        ];
        return response()->json($data);
        // return [$result, $product->status];
    }

    public function changeOrderStatus(Request $request)
    {
        $result = $this->ajaxService->changeOrderStatus($request->all());
        return $result ? true : false;
    }

    public function checkQuantityCart(Request $request)
    {
        $result = $this->ajaxService->checkQuantity($request->id, $request->quantity) ;
        return $result;
    }

    public function checkUserLogin(Request $request)
    {
        $result = $this->ajaxService->userLogin($request->only('phone', 'password')) ;
        \Log::info($result);
        return $result;
    }
}
