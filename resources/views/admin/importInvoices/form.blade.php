<div class="row">
    <div class="col-md-5">
        <div class="col-md-12">
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
        {{-- <div class="col-md-12">
            <div class="form-group @if ($errors->has('invoice_name')) {{'has-danger'}} @endif">
                <label>Tên sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                <input type="text" class="form-control @if ($errors->has('invoice_name')) {{'form-control-danger'}} @endif"
                    name="invoice_name"
                @if(isset($invoice))
                    value="{{$invoice->invoice_name}}"
                @endif>
                @if ($errors->has('invoice_name'))
                    <p style="color: red">{{ $errors->first('invoice_name') }}</p>
                @endif
            </div>
        </div> --}}
        {{-- <div class="col-md-12">
            <div class="form-group @if ($errors->has('producer')) {{'has-danger'}} @endif">
                <label>Nhà sản xuất <span style="color: red; font-size: 20px">*</span></label>
                <input type="text" class="form-control @if ($errors->has('producer')) {{'form-control-danger'}} @endif"
                    name="producer"
                @if(isset($invoice))
                    value="{{$invoice->producer}}"
                @endif>
                @if ($errors->has('producer'))
                    <p style="color: red">{{ $errors->first('producer') }}</p>
                @endif
            </div>
        </div> --}}
        <div class="form-group col-md-12 @if ($errors->has('invoice_type')) {{'has-danger'}} @endif">
            <label>Loại phiếu <span style="color: red; font-size: 20px">*</span></label>
            <select class="custom-select form-control" name="invoice_type" id="invoice_type">
                <option value="">Chọn loại phiếu </option>
                <option value="import" @if(isset($invoice) && $invoice->invoice_type = 'ceramic') {{'selected'}} @endif>Phiếu nhập</option>
                <option value="export" @if(isset($invoice) && $invoice->invoice_type = 'sanitary_equipment') {{'selected'}} @endif>Phiếu xuất</option>
            </select>
            @if ($errors->has('invoice_type'))
                <p style="color: red">{{ $errors->first('invoice_type') }}</p>
            @endif
        </div>
        <div class="col-md-12">
            <div class="form-group @if ($errors->has('introduce_staff')) {{'has-danger'}} @endif">
                <label>Nhân viên tư vấn </label>
                <input type="text" class="form-control" name="introduce_staff"
                @if(isset($invoice))
                value="{{$invoice->introduce_staff}}"
                @endif>
                @if ($errors->has('introduce_staff'))
                    <p style="color: red">{{ $errors->first('introduce_staff') }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group @if ($errors->has('customer_name')) {{'has-danger'}} @endif">
                <label>Khách Hàng </label>
                <input type="text" class="form-control @if ($errors->has('customer_name')) {{'form-control-danger'}} @endif"
                    name="customer_name"
                @if(isset($invoice))
                    value="{{$invoice->customer_name}}"
                @endif>
                @if ($errors->has('customer_name'))
                    <p style="color: red">{{ $errors->first('customer_name') }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group @if ($errors->has('customer_phone')) {{'has-danger'}} @endif">
                <label>Số điện thoại </label>
                <input type="text" class="form-control @if ($errors->has('customer_phone')) {{'form-control-danger'}} @endif"
                    name="customer_phone"
                @if(isset($invoice))
                    value="{{$invoice->customer_phone}}"
                @endif>
                @if ($errors->has('customer_phone'))
                    <p style="color: red">{{ $errors->first('customer_phone') }}</p>
                @endif
            </div>
        </div>
        {{-- <div class="col-md-12">
            <div class="form-group @if ($errors->has('surface')) {{'has-danger'}} @endif">
                <label>Bề mặt </label>
                <input type="text" class="form-control @if ($errors->has('surface')) {{'form-control-danger'}} @endif"
                    name="surface"
                @if(isset($invoice))
                    value="{{$invoice->surface}}"
                @endif>
                @if ($errors->has('surface'))
                    <p style="color: red">{{ $errors->first('surface') }}</p>
                @endif
            </div>
        </div> --}}
    </div>
    <div class="col-md-7">
        {{-- <div class="col-md-9">
            <div class="form-group @if ($errors->has('uses_for')) {{'has-danger'}} @endif">
                <label>Chứ </label>
                <input type="text" name="uses_for" class="form-control @if ($errors->has('uses_for')) {{'form-control-danger'}} @endif"
                @if(isset($invoice))
                value="{{$invoice->uses_for}}"
                @endif>
                @if ($errors->has('uses_for'))
                    <p style="color: red">{{ $errors->first('uses_for') }}</p>
                @endif
            </div>
        </div> --}}
        <div class="col-md-9">
            <div class="form-group @if ($errors->has('total_cost')) {{'has-danger'}} @endif">
                <label>Tổng giá </label>
                <input type="number" name="total_cost"
                    class="form-control @if ($errors->has('total_cost')) {{'form-control-danger'}} @endif"
                    @if(isset($invoice))
                    value="{{$invoice->total_cost}}"
                @endif>
                @if ($errors->has('total_cost'))
                    <p style="color: red">{{ $errors->first('total_cost') }}</p>
                @endif
            </div>
        </div>
        <div class="persional_computer">
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('preferential')) {{'has-danger'}} @endif">
                    <label>Khuyến mãi <span style="color: red; font-size: 20px">*</span></label>
                    <input type="number" name="preferential"
                        class="form-control @if ($errors->has('preferential')) {{'form-control-danger'}} @endif"
                        @if(isset($invoice))
                        value="{{$invoice->preferential}}"
                    @endif>
                    @if ($errors->has('preferential'))
                        <p style="color: red">{{ $errors->first('preferential') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('last_cost')) {{'has-danger'}} @endif">
                    <label>Giá cuối <span style="color: red; font-size: 20px">*</span></label>
                    <input type="number" name="last_cost"
                        class="form-control @if ($errors->has('last_cost')) {{'form-control-danger'}} @endif"
                        @if(isset($invoice))
                        value="{{$invoice->last_cost}}"
                    @endif>
                    @if ($errors->has('last_cost'))
                        <p style="color: red">{{ $errors->first('last_cost') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('sales_channel')) {{'has-danger'}} @endif">
                    <label>kênh bán <span style="color: red; font-size: 20px">*</span></label>
                    <input type="number" name="sales_channel"
                        class="form-control @if ($errors->has('sales_channel')) {{'form-control-danger'}} @endif"
                        @if(isset($invoice))
                        value="{{$invoice->sales_channel}}"
                    @endif>
                    @if ($errors->has('sales_channel'))
                        <p style="color: red">{{ $errors->first('sales_channel') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>