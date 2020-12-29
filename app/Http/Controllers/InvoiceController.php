<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\InvoiceServiceInterface;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function __construct(
        InvoiceServiceInterface $invoiceService,
        Invoice $invoice
    ) {
        $this->invoiceService = $invoiceService;
        $this->invoice = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::query()->with('invoiceDetail')->get();
        return view('admin/invoices/index', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::query()->get();
        $staffs = Admin::where('permission', 4)->get();
        return view('admin/invoices/create', [
            'staffs' => $staffs,
            'products' => $products
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
        // dd(1);
        $count =  $this->invoice->orderBy('id', 'DESC')->first()->id ?? 0;

        list($success, $errors) = $this->invoiceService->storeExportInvoice($request, $count);
        if (!$success) {
            return redirect()->route('invoices.create')->withErrors($errors);
        }
        alert()->success('Thêm phiếu', 'thành công');
        return redirect()->route('invoices.create');
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
        $staffs = Admin::whereIn('permission', [2,1])->get();
        // dd($staffs);
        $invoice = Invoice::findOrFail($id);
        // dd(count($invoice->invoiceDetail));
        return view('admin/invoices/edit', [
            'invoice' => $invoice,
            'staffs' => $staffs
        ]);
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
        // $params =$request->all();
        $count =  $this->invoice->orderBy('id', 'DESC')->first()->id ?? 0;
        // dd($count);
        list($success, $errors) = $request->invoice_type == 'import'
            ? $this->invoiceService->updateImportInvoice($request, $count, $id)
            : $this->invoiceService->storeExportInvoice($request, $count);
        if (!$success) {
            return redirect()->route('invoices.create')->withErrors($errors);
        }
        alert()->success('Sửa phiếu', 'thành công');
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->invoiceDetail->each(function ($item, $key) {
            $item->delete();
        });
        $invoice->delete();
        alert()->success('xóa phiếu', 'thành công');
        return redirect()->route('invoices.index');
    }
}
