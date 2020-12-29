@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzone.css">
    <link rel="stylesheet" type="text/css" href="src/avatar.scss">
@endsection
@section('content')
<script>
    function sumTotal()
    {
        var total = 0;
        $('.total_price').each( function(k, v){
            total += Number($(this).val());
        });
        $('#total_cost').val(total);
    }
    function del(item) {
        var id = $(item).attr("id");
        $('#tr'+id).hide();
        $('#tr'+id).children().children().prop('disabled', true);
        $('#tr'+id).children().children().val(null);
        sumTotal();
    }
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    function totalPrice(id)
    {
        var quantity = $('input[name="details['+id+'][quantity_product]"]').val();
        var price = $('input[name="details['+id+'][price_product]"]').val();
        var total_price = quantity * price;
        $('input[name="details['+id+'][total_price]"]').val(total_price);
        sumTotal();
    }
</script>
<div class="pd-30 card-box mb-10">
    <div class="clearfix" >
        <div class="pull-center" style="text-align: center;">
            <h2 class="h1">Sửa Phiếu</h2>
        </div>
        
    </div>
    <a href="{{route('importInvoices.index')}}">
        <button class="btn btn-danger" style="margin-right: 100px;">
            <i class="icon-copy fa fa-backward" aria-hidden="true"></i>
            Back 
        </button>
    </a>
    <div style=" margin-top: 50px">
        <div class="pd-20 card-box">
            <form action="{{ route('importInvoices.update', $importInvoice->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="col-md-10">
                            <div class="form-group @if ($errors->has('invoice_code')) {{'has-danger'}} @endif">
                                <label>Mã Phiếu </label>
                                <input type="text" class="form-control @if ($errors->has('invoice_code')) {{'form-control-danger'}} @endif"
                                    name="invoice_code" placeholder="mã tự động: SP-001"
                                    @if(isset($importInvoice))
                                    value="{{$importInvoice->invoice_code}}"
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
                                    @if(isset($importInvoice))
                                    value="{{$importInvoice->created_at}}"
                                @endif
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
                                    name="unit_of_delivery"
                                    @if(isset($importInvoice))
                                        value="{{$importInvoice->unit_of_delivery}}"
                                    @endif>
                                @if ($errors->has('unit_of_delivery'))
                                    <p style="color: red">{{ $errors->first('unit_of_delivery') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-10 @if ($errors->has('staff_make')) {{'has-danger'}} @endif">
                            <label>Nhân viên tạo phiếu <span style="color: red; font-size: 20px">*</span></label>
                            <select class="custom-select form-control" name="staff_make" id="staff_make">
                                {{-- <option value="{{$staff->name}}" >{{$staff->name}}</option> --}}
                                @foreach ($staffs as $staff)
                                <option value="{{$staff->name}}" 
                                    @if (isset($importInvoice) && ($importInvoice->staff_make == $staff->name))
                                        {{'selected'}}
                                    @elseif (!isset($importInvoice) && (Auth::guard('admins')->user()->name == $staff->name))
                                        {{'selected'}}
                                    @else
                                    @endif
                                    >{{$staff->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('staff_make'))
                                <p style="color: red">{{ $errors->first('staff_make') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                @include('admin.importInvoices.import_form')
            </form>
        </div>
    </div>
@endsection
@section('script')
<script src="src/plugins/dropzone/src/dropzone.js"></script>
<script src="vendors/scripts/advanced-components.js"></script>
<script src="src/plugins/switchery/switchery.min.js"></script>
<script src="src/avatar.js"></script>
<script>
    var count = $('#count_product').val();
    $('#add_product').click( function(){
        count ++;
        var text = '<tr id="tr'+count + '"><td>'+ count +'</td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control" name="details['+ count + '][product_name]"></td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control " name="details[' + count +'][product_code]"></td><td style="padding: 0%; width: 10%;"><input type="text" class="form-control" name="details['+ count +'][unit]"></td><td style="padding: 0%; width: 10%;"><input type="number" class="form-control" name="details['+ count +'][quantity_product]" min="0" onchange="totalPrice('+ count +')"><input type="number" class="form-control" name="details['+ count +'][quantity_old]" min="0" value="0" hidden></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control" name="details['+ count +'][price_product]" min="0" onchange="totalPrice('+ count +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control total_price" name="details['+ count +'][total_price]"></td><td style="padding: 2px" ><button type="button" id="'+ count +'" style="padding: 5px 10px 5px 10px" class="btn btn-danger" onclick="del(this)"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td></tr>'
        $('#table_import_body').append(text);
        $('#count_product').val(count);
    });
    
</script>
@endsection