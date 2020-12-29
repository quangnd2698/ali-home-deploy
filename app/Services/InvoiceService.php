<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use App\Models\AccumulatePoint;

class InvoiceService implements InvoiceServiceInterface
{
    /**
     * validate store invoice request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreInvoiceRequest(array $params)
    {
        $validator = Validator::make($params, [
            'invoice_code' => 'required|unique:invoices|string',
            'staff_sale' => 'required|string|max:124',
            'introduce_staff' => 'nullable|string|max:124',
            'customer_name' => 'nullable|string',
            'customer_phone' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'preferential' => 'nullable|string',
            'last_cost' => 'required|numeric',
            'sales_channel' => 'nullable|string|max:8',
            'created_at' => 'nullable|date',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    /**
     * validate store invoice detail request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreInvoiceDetailRequest(array $params)
    {
        $validator = Validator::make($params, [
            'invoice_code' => 'required|string',
            'product_code' => 'required|string|max:12',
            'product_name' => 'required|string|max:124',
            'unit' => 'nullable|string|max:124',
            'quantity_product' => 'required|numeric',
            'price_product' => 'required|numeric',
            'total_price' => 'required|numeric'
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    /**
     * validate update invoice request
     *
     * @param array $params
     * @param int $id
     * @return array
     */
    public function validateUpdateInvoiceRequest(array $params, int $id)
    {
        $validator = Validator::make($params, [
            'invoice_code' => sprintf('sometimes|unique:invoices,invoice_code,%s|string', $id),
            'staff_sale' => 'sometimes|string|max:124',
            'introduce_staff' => 'nullable|string|max:124',
            'customer_name' => 'nullable|string',
            'customer_phone' => 'nullable|string',
            'total_cost' => 'sometimes|numeric',
            'preferential' => 'nullable|string',
            'last_cost' => 'sometimes|numeric',
            'sales_channel' => 'nullable|string|max:8',
            'created_at' => 'nullable|date',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    /**
     * validate store invoice request
     *
     * @param array $params
     * @return array
     */
    public function validateUpdateInvoiceDetailRequest(array $params)
    {
        $validator = Validator::make($params, [
            'invoice_code' => 'sometimes|string',
            'product_code' => 'sometimes|string|max:12',
            'product_name' => 'sometimes|string|max:124',
            'unit' => 'nullable|string|max:124',
            'quantity_product' => 'sometimes|numeric',
            'price_product' => 'sometimes|numeric',
            'total_price' => 'sometimes|numeric'
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    public function storeExportInvoice(Request $request, int $count)
    {
        // dd($request->all());
        $paramInvoice = $request->only([
            'customer_name',
            'customer_phone',
            'introduce_staff',
            'total_cost',
            'last_cost',
            'sales_channel',
            'point_used',
            'preferential',
        ]);
        
        $paramInvoice['invoice_code'] = 'EIV-000'. ($count + 1);
        $paramInvoice['staff_sale'] = \Auth::guard('admins')->user()->name;

        $paramInvoiceDetails = $request->details;
        \DB::beginTransaction();
        foreach ($paramInvoiceDetails as $paramInvoiceDetail) {
            $paramInvoiceDetail['invoice_code'] = $paramInvoice['invoice_code'];
            list($success, $errors) = $this->validateStoreInvoiceDetailRequest($paramInvoiceDetail);

            if (!$success) {
                \DB::rollBack();
                return [false, $errors];
            }

            $product = Product::where('product_code', $paramInvoiceDetail['product_code'])->first();
            if ($product) {
                $quantity = $product->quantity - $paramInvoiceDetail['quantity_product']; 
                $product->update(['quantity' => $quantity]);
            }
            InvoiceDetail::create($paramInvoiceDetail);
        }

        $paramInvoice['last_cost'] =  $paramInvoice['total_cost'];

        $this->setAccumulatePoint( $paramInvoice['customer_phone'],
            $paramInvoice['last_cost'] ?? 0,
            $paramInvoice['point_used'] ?? 0,
            $paramInvoice['customer_name']
        );
        list($success, $errors) = $this->validateStoreInvoiceRequest($paramInvoice);
        if (!$success) {
            \DB::rollBack();
            return [false, $errors];
        }
        Invoice::create($paramInvoice);
        \DB::commit();
        return [true, ''];
    }

    public function updateImportInvoice(Request $request, int $count, int $id)
    {
        $invoice = Invoice::findOrFail($id);
        $paramInvoice = $request->only([
            'invoice_type',
            'invoice_code',
            'unit_of_delivery',
            'staff_sale',
            'created_at',
            'total_cost',
        ]);
        
        $paramInvoice['invoice_code'] =  $paramInvoice['invoice_code']
            ? $paramInvoice['invoice_code']
            : 'IV-000'. ($count + 1);
        $paramInvoice['created_at'] =  $paramInvoice['created_at']
            ? $paramInvoice['created_at']
            : now();
        $paramInvoice['staff_sale'] =  $paramInvoice['staff_sale']
            ? $paramInvoice['staff_sale']
            : \Auth::guard('admins')->user()->name;

        $paramInvoiceDetails = $request->details;
        \DB::beginTransaction();
        foreach ($paramInvoiceDetails as $paramInvoiceDetail) {
            $paramInvoiceDetail['invoice_code'] = $paramInvoice['invoice_code'];
            list($success, $errors) = $this->validateUpdateInvoiceDetailRequest($paramInvoiceDetail);

            if (!$success) {
                \DB::rollBack();
                return [false, $errors];
            }

            $product = Product::where('product_code', $paramInvoiceDetail['product_code'])->first();
            // $product = Product::where('product_code', '2SZu4P')->first();
            if ($product) {
                $quantity =  $product->quantity + $paramInvoiceDetail['quantity_product'] - $paramInvoiceDetail['quantity_old'];
                $product->update(['quantity' => $quantity]);
            }
            unset($paramInvoiceDetail['quantity_old']);
            InvoiceDetail::updateOrCreate($paramInvoiceDetail);
        }

        $paramInvoice['last_cost'] =  $paramInvoice['total_cost'];
        
        list($success, $errors) = $this->validateUpdateInvoiceRequest($paramInvoice, $id);
        if (!$success) {
            \DB::rollBack();
            return [false, $errors];
        }
        $invoice->update($paramInvoice);
        \DB::commit();
        return [true, ''];
    }


    // public function storeExportInvoice(Request $request, int $count)
    // {
    //     dd($request->all());
    //     $paramInvoice = $request->only([
    //         'invoice_type',
    //         'invoice_code',
    //         'unit_of_delivery',
    //         'staff_id',
    //     ]);
        
    // }

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
}
