<div class="row">
    <div class="card col-9" style="width: 65%">
        <table class="table " >
            <thead style="text-align: center">
                <th>stt</th>
                <th>Tên sản phẩm</th>
                <th>Mã sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th></th>
            </thead>
            <tbody style="text-align: center" id="table_import_body">
                <tfoot>
                    <th colspan="4">
                    </th>
                    <th> Tổng</th>
                    <th colspan="2">
                        <input class="form-control" id="total_cost" type="number" name="total_cost" readonly
                        @if (isset($importInvoice))
                            value="{{$importInvoice->total_cost}}"
                        @endif>
                    </th>
                </tfoot>
            </tbody>
        </table>
    </div>
    <div class="card col-3" style="border-width:5px; border-color: #009900; border-radius: 15px; height: ;background-color: #FFFFCC">
        <div>
            <div class="row" style="margin-top: 15px">
                <div class="col-md-5" style="margin-left: 15px">
                    <label>{{Auth::guard('admins')->user()->name}}</label>
                </div>
                <div class="col-md-6">
                    {{now()->format('d-m-Y H:i')}}
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="form-group row @if ($errors->has('customer_name')) {{'has-danger'}} @endif">
                    <label class="col-4">khách hàng </label>
                    <input type="text" class="form-control col-8 @if ($errors->has('customer_name')) {{'form-control-danger'}} @endif"
                        name="customer_name"
                        @if(isset($importInvoice))
                        value="{{$importInvoice->customer_name}}"
                    @endif
                    >
                    @if ($errors->has('customer_name'))
                        <p style="color: red">{{ $errors->first('customer_name') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row @if ($errors->has('customer_phone')) {{'has-danger'}} @endif">
                    <label class="col-4">SĐT </label>
                    <input type="text" class="form-control col-8 @if ($errors->has('customer_phone')) {{'form-control-danger'}} @endif"
                        name="customer_phone" 
                        @if(isset($importInvoice))
                        value="{{$importInvoice->customer_phone}}"
                    @endif
                    onchange="getPromotion()"
                    >
                    @if ($errors->has('customer_phone'))
                        <p style="color: red">{{ $errors->first('customer_phone') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-4 col-form-label">NV tư vấn</label>
                    {{-- <div class="col-md-8"> --}}
                        <select class="custom-select col-8" name="introduce_staff">
                            <option value="">Chọn nhân viên</option>
                            @foreach ($staffs as $staff)
                            <option value="{{$staff->id}}">{{$staff->name}}</option>    
                            @endforeach
                        </select>
                    {{-- </div> --}}
                </div>
            </div>
            
            <ul class="list-group list-group-flush">
                <hr style="background-color: red">
                <li class="list-group-item">Tạm tính: <b id="cost_temporary"></b></li>
                <li class="list-group-item">Khuyến mại:
                    <div class="row" id="km"></div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                    <h6 class="col-12">Thành tiền: <span style="color: red; font-size: 20px" id="last_money"></span></h6>
                    {{-- <p class="col-5">Thành tiền:</p> --}}
                    {{-- <h5 class="col-6" style="color: red" id="last_money"></h5> --}}
                </li>
                
            </ul>
            <div class="row">
                {{-- <button type="button" id="add_product_selected"  style="margin-left: 15px" class="btn btn-primary col-5"> Cập nhật </button> --}}
            <button type="submit" style="margin-left: 15px; margin-top: 15px; margin-bottom: 15px" class="btn btn-success col-11"> Lưu phiếu </button>
            </div>
        </div>
    </div>
    <input type="number" id="count_product" hidden value="0">
</div>
<input type="text" name="sales_channel" hidden value="store">
<input type="number" hidden name="last_cost">
<input type="number" hidden name="preferential">

