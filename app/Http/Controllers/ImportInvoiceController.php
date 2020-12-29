<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportInvoiceServiceInterface;
use App\Models\ImportInvoice;
use App\Models\Admin;
use App\Models\ImportInvoiceDetail;

class ImportInvoiceController extends Controller
{

    public function __construct(
        ImportInvoiceServiceInterface $importInvoiceService,
        ImportInvoice $importInvoice
    ) {
        $this->importInvoiceService = $importInvoiceService;
        $this->importInvoice = $importInvoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(1);
        $importInvoices = ImportInvoice::query()->with('importInvoiceDetail')->get();
        // dd($importInvoices->importInvoiceDetail);
        return view('admin/importInvoices/index', ['importInvoices' => $importInvoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = Admin::whereIn('permission', [3,1])->get();
        return view('admin/importInvoices/create', [
            'staffs' => $staffs
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
        $count =  $this->importInvoice->orderBy('id', 'DESC')->first()->id ?? 0;
        list($success, $errors) = $this->importInvoiceService->storeImportInvoice($request, $count);
        if (!$success) {
            return redirect()->route('importInvoices.create')->withErrors($errors);
        }
        alert()->success('Thêm phiếu', 'thành công');
        return redirect()->route('importInvoices.index');
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
        $staffs = Admin::whereIn('permission', [3,1])->get();
        $importInvoice = ImportInvoice::findOrFail($id);
        return view('admin/importInvoices/edit', [
            'importInvoice' => $importInvoice,
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
        $count =  $this->importInvoice->orderBy('id', 'DESC')->first()->id ?? 0;
        list($success, $errors) = $this->importInvoiceService->updateImportInvoice($request, $count, $id);
        if (!$success) {
            return redirect()->route('importInvoices.edit')->withErrors($errors);
        }
        alert()->success('Sửa phiếu', 'thành công');
        return redirect()->route('importInvoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $importInvoice = ImportInvoice::findOrFail($id);
        $importInvoice->importInvoiceDetail->each(function ($item, $key) {
            $item->delete();
        });
        $importInvoice->delete();
        alert()->success('xóa phiếu', 'thành công');
        return redirect()->route('importInvoices.index');
    }

    /**
     * Remove more the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMore(Request $request)
    {
        // if (\Gate::allows('isAdmin')) {
            
        list($success, $errors) = $this->importInvoiceService->deleteMoreImportInvoice($request);
        if (!$success) {
            return redirect()->route('importInvoices.index')->withErrors($errors);
        }
        alert()->success('Xóa phiếu', 'thành công');
        return redirect()->route('importInvoices.index');
        // }
        // return redirect()->to('403');
    }
}
