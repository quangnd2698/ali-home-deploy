<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use App\Models\ImportInvoice;
use App\Models\ImportInvoiceDetail;

class ImportInvoiceService implements ImportInvoiceServiceInterface
{
    /**
     * validate store invoice request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreImportInvoiceRequest(array $params)
    {
        $validator = Validator::make($params, [
            'invoice_code' => 'required|unique:invoices|string',
            'staff_make' => 'required|string|max:124',
            'unit_of_delivery' => 'nullable|string',
            'total_cost' => 'required|numeric',
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
    public function validateStoreImportInvoiceDetailRequest(array $params)
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
    public function validateUpdateImportInvoiceRequest(array $params, int $id)
    {
        $validator = Validator::make($params, [
            'invoice_code' => sprintf('sometimes|unique:invoices,invoice_code,%s|string', $id),
            'staff_make' => 'sometimes|string|max:124',
            'unit_of_delivery' => 'nullable|string',
            'total_cost' => 'sometimes|numeric',
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
    public function validateUpdateImportInvoiceDetailRequest(array $params)
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

    public function storeImportInvoice(Request $request, int $count)
    {
        $paramInvoice = $request->only([
            'invoice_code',
            'unit_of_delivery',
            'staff_make',
            'created_at',
            'total_cost',
        ]);
        
        $paramInvoice['invoice_code'] =  $paramInvoice['invoice_code']
            ? $paramInvoice['invoice_code']
            : 'IV-000'. ($count + 1);
        $paramInvoice['created_at'] =  $paramInvoice['created_at']
            ? $paramInvoice['created_at']
            : now();
        $paramInvoice['staff_make'] =  $paramInvoice['staff_make']
            ? $paramInvoice['staff_make']
            : \Auth::guard('admins')->user()->name;

        $paramInvoiceDetails = $request->details;

        foreach ($paramInvoiceDetails as $paramInvoiceDetail) {
            $paramInvoiceDetail['invoice_code'] = $paramInvoice['invoice_code'];
            list($success, $errors) = $this->validateStoreImportInvoiceDetailRequest($paramInvoiceDetail);

            if (!$success) {
                \DB::rollBack();
                return [false, $errors];
            }

            $product = Product::where('product_code', $paramInvoiceDetail['product_code'])->first();
            if ($product) {
                $quantity = $product->quantity + $paramInvoiceDetail['quantity_product']; 
                $product->update(['quantity' => $quantity]);
            }
            ImportInvoiceDetail::create($paramInvoiceDetail);
        }

        list($success, $errors) = $this->validateStoreImportInvoiceRequest($paramInvoice);
        if (!$success) {
            \DB::rollBack();
            return [false, $errors];
        }
        ImportInvoice::create($paramInvoice);
        \DB::commit();
        return [true, ''];
    }

    public function updateImportInvoice(Request $request, int $count, int $id)
    {
        $importInvoice = ImportInvoice::findOrFail($id);
        // dd($request->all());
        $paramInvoice = $request->only([
            'invoice_code',
            'unit_of_delivery',
            'staff_make',
            'created_at',
            'total_cost',
        ]);
        
        $paramInvoice['invoice_code'] =  $paramInvoice['invoice_code']
            ? $paramInvoice['invoice_code']
            : 'IV-000'. ($count + 1);
        $paramInvoice['created_at'] =  $paramInvoice['created_at']
            ? $paramInvoice['created_at']
            : now();
        $paramInvoice['staff_make'] =  $paramInvoice['staff_make']
            ? $paramInvoice['staff_make']
            : \Auth::guard('admins')->user()->name;

        $paramInvoiceDetails = $request->details;
        // dd($paramInvoiceDetails);
        foreach ($paramInvoiceDetails as $paramInvoiceDetail) {
            $paramInvoiceDetail['invoice_code'] = $paramInvoice['invoice_code'];
            list($success, $errors) = $this->validateUpdateImportInvoiceDetailRequest($paramInvoiceDetail);

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
            ImportInvoiceDetail::updateOrCreate(
                ['id' => $paramInvoiceDetail['id']],
                $paramInvoiceDetail);
        }

        list($success, $errors) = $this->validateUpdateImportInvoiceRequest($paramInvoice, $id);
        if (!$success) {
            \DB::rollBack();
            return [false, $errors];
        }
        $importInvoice->update($paramInvoice);
        \DB::commit();
        return [true, ''];
    }

    public function deleteMoreImportInvoice($request)
    {
        $param = $request->all();
        $listId = explode(',', $param['checkbox_selected']);
        $importInvoices = ImportInvoice::with('importinvoiceDetail')->whereIn('id', $listId);
        $invoiceId = $importInvoices->pluck('id');
        $details = ImportInvoiceDetail::whereIn('id', $invoiceId);

        \DB::beginTransaction();

        try {
            $details->delete();
            $importInvoices->delete();
        } catch (Exception  $e) {
            \DB::rollback();
            return [false, $e->getMessage()];
        }
        \DB::commit();
        return [true, ''];
    }

}
