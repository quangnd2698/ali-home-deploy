<form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="invoice_type" value="import" hidden>
    <div class="row">
        <div class="col-6">
            <div class="col-md-10">
                <div class="form-group @if ($errors->has('invoice_code')) {{'has-danger'}} @endif">
                    <label>Mã Phiếu </label>
                    <input type="text" class="form-control @if ($errors->has('invoice_code')) {{'form-control-danger'}} @endif"
                        name="invoice_code" placeholder="mã tự động: SP-001"
                        @if(isset($invoice))
                        value="{{$invoice->invoice_code}}"
                    @endif>
                    @if ($errors->has('invoice_code'))
                        <p style="color: red">{{ $errors->first('invoice_code') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group @if ($errors->has('created_at')) {{'has-danger'}} @endif">
                    <label>Ngày tạo phiếu </label>
                    <input type="text" class="form-control @if ($errors->has('created_at')) {{'form-control-danger'}} @endif"
                        name="created_at" placeholder="Tự động {{ now()->format('Y-m-d H:i:s')}}"
                        {{-- @if(isset($invoice))
                        value="{{$invoice->created_at}}"
                    @endif --}}
                    >
                    @if ($errors->has('created_at'))
                        <p style="color: red">{{ $errors->first('created_at') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="col-md-10">
                <div class="form-group @if ($errors->has('unit_of_delivery')) {{'has-danger'}} @endif">
                    <label>Người/ Đơn vị giao </label>
                    <input type="text" class="form-control @if ($errors->has('unit_of_delivery')) {{'form-control-danger'}} @endif"
                        name="unit_of_delivery" placeholder="bỏ trống nếu là chính bạn"
                        @if(isset($invoice))
                        value="{{$invoice->unit_of_delivery}}"
                    @endif>
                    @if ($errors->has('unit_of_delivery'))
                        <p style="color: red">{{ $errors->first('unit_of_delivery') }}</p>
                    @endif
                </div>
            </div>
            {{-- <div class="col-md-10"> --}}
                <div class="form-group col-md-10 @if ($errors->has('staff_sale')) {{'has-danger'}} @endif">
                    <label>Nhân viên tạo phiếu <span style="color: red; font-size: 20px">*</span></label>
                    <select class="custom-select form-control" name="staff_sale" id="staff_sale">
                        <option value="">Chọn nhân viên </option>
                        <option value="import" @if(isset($invoice) && $invoice->staff_sale = 'ceramic') {{'selected'}} @endif>Phiếu nhập</option>
                        <option value="export" @if(isset($invoice) && $invoice->staff_sale = 'sanitary_equipment') {{'selected'}} @endif>Phiếu xuất</option>
                    </select>
                    @if ($errors->has('staff_sale'))
                        <p style="color: red">{{ $errors->first('staff_sale') }}</p>
                    @endif
                </div>
        </div>
        
    </div>
    <hr>
    <div class="card-box">
        <table class="table table-bordered ">
            <thead>
                <th>stt</th>
                <th>Tên sản phẩm</th>
                <th>Mã sản phẩm</th>
                <th>Đơn vị</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th></th>
            </thead>
            <tbody id="table_import_body">
                <tr>
                    <td>1</td>
                    <td style="padding: 0%; width: 20%;">
                        <input type="text" class="form-control" name="details[1][product_name]">
                    </td>
                    <td style="padding: 0%; width: 20%;">
                        <input type="text" class="form-control " name="details[1][product_code]">
                    </td>
                    <td style="padding: 0%; width: 10%;">
                        <input type="text" class="form-control" name="details[1][unit]">
                    </td>
                    <td style="padding: 0%; width: 10%;">
                        <input type="number" class="form-control" name="details[1][quantity_product]">
                    </td>
                    <td style="padding: 0%; width: 20%;">
                        <input type="text" class="form-control" name="details[1][price_product]">
                    </td>
                    <td style="padding: 0%; width: 20%;">
                        <input type="text" class="form-control" name="details[1][total_price]">
                    </td>
                    <td style="padding: 2px" ><button type="button" style="padding: 5px 10px 5px 10px" class="btn btn-danger"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td>
                </tr>
                <tfoot>
                    <th colspan="7">
                        <button type="button" id="add_product" class="btn btn-primary"><i class="icon-copy fa fa-plus-circle" aria-hidden="true"></i>Thêm sản phẩm</button>
                    </th>
                </tfoot>
            </tbody>
        </table>
        <input type="number" id="count_product" hidden value="1">
        <button type="submit" style="margin-left: 15%" class="btn btn-success col-8"> Lưu phiếu </button>
    </div>
</form>
