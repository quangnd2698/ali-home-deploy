@extends('admin.layout.index')
@section('style')
    <style>
        a {
            color: #333;
        }

    .header-title {
        padding: 5px 10px;
        background: #dadada;
        font-weight: bold;
        width: 500px;
    }

    .tt-menu {
        text-align: left;
    }

</style>
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

<div class="flex-center position-ref full-height col-10" style="width: 500px;margin-top: 5px">
    <div class="content col-12" style="width: 500px">
        <form class=" col-12" role="search" style="width: 500px;">
            <input type="search" style="width: 500px;" name="q" class="form-control search-input col-12" placeholder="Tìm kiếm theo tên, mã sản phẩm" autocomplete="off">
        </form>
    </div>
</div>
<hr>
{{-- <div class="pd-30 card-box mb-10"> --}}
    {{-- <div class="clearfix" >
        <div class="pull-center" style="text-align: center;">
            <h2 class="h1">Thêm Mới Phiếu</h2>
        </div>
        
    </div>
    <a href="{{route('invoices.index')}}">
        <button class="btn btn-danger" style="margin-right: 100px;">
            <i class="icon-copy fa fa-backward" aria-hidden="true"></i>
            Back 
        </button>
    </a> --}}
    <div style=" margin-top: 50px">
        <div class="pd-20 card-box">
            <form action="{{ route('importInvoices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.importInvoices.import_form')
                <hr>
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
                        {{-- <div class="col-md-10"> --}}
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
                {{-- <input type="submit">gui --}}
                <button type="submit" id="sub" style="margin-left: 15%" class="btn btn-success col-8"> Lưu phiếu </button>
            </form>
        </div>
    </div>
{{-- </div> --}}
@endsection
@section('script')
<script src="src/plugins/dropzone/src/dropzone.js"></script>
<script src="vendors/scripts/advanced-components.js"></script>
<script src="src/plugins/switchery/switchery.min.js"></script>
<script src="src/avatar.js"></script>
<script>

    $.cookie("list_product_selected", { path: '/admin/importInvoices/create' });
    function addProduct(data) {
        var count = $('#count_product').val();
        var listProductSelected = $.cookie("list_product_selected") ?? null;
        // alert(JSON.stringify(listProductSelected));
        if (listProductSelected.indexOf(data.id) == -1) {

            listProductSelected += ','
            listProductSelected += data.id; 
            // alert(2);
            count ++;
            var text = '<tr class="tr_num" id="tr'+data.id + '"><td>'+ count +'</td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control" name="details['+ data.id + '][product_name]" value="'+ data.product_name+'" readonly></td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control " name="details[' +data.id +'][product_code]" value="'+ data.product_code+'" readonly></td><td style="padding: 0%; width: 10%;"><input type="text" class="form-control" name="details['+ data.id +'][unit]" ></td><td style="padding: 0%; width: 10%;"><input type="number" class="form-control" name="details['+ data.id +'][quantity_product]" min="0" value="1" onchange="totalPrice('+ data.id +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control" name="details['+ data.id +'][price_product]" min="0" value="'+ data.import_price+'" readonly onchange="totalPrice('+ count +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control total_price" name="details['+ data.id +'][total_price]" readonly ></td><td style="padding: 2px" ><button type="button" id="'+ data.id +'" style="padding: 5px 10px 5px 10px" class="btn btn-danger" onclick="del(this)"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td></tr>'
            $('#table_import_body').append(text);
            $('#count_product').val(count);
            totalPrice(data.id);
            $.cookie("list_product_selected", listProductSelected, { path: '/admin/importInvoices/create' });
        
        }

    }

    $('#sub').click(function(){
        
        $.removeCookie("list_product_selected", { path: '/admin/importInvoices/create' });
    });

    $(document).ready(function($) {
        var engine1 = new Bloodhound({
            remote: {
                url: '/search/product_name?value=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        // var engine2 = new Bloodhound({
        //     remote: {
        //         url: '/search/product_code?value=%QUERY%',
        //         wildcard: '%QUERY%'
        //     },
        //     datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        //     queryTokenizer: Bloodhound.tokenizers.whitespace
        // });

        $(".search-input").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, [
            {
                source: engine1.ttAdapter(),
                name: 'students-name',
                display: function(data) {
                    // console.log(data);
                    return data.name;
                },
                templates: {
                    empty: [
                        // '<div class="header-title" style="width=500px;">Tên sản phẩm</div><div style="width=500px;" class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="header-title"></div><div class="list-group search-results-dropdown"></div>'
                    ],
                    suggestion: function (data) {
                        // var product = $.makeArray(data);
                        // alert(JSON.stringify(data))
                        // JSON.stringify(data)
                        // var list = ;
                        return "<a onclick='addProduct("+JSON.stringify(data)+")' class='btn list-group-item list-group-item-action'><div class='row'><div class='col-4'><img style='width: 50px; height: 50px;' src='images/products/product1.jpg' alt=''></div><div class='col-8'><h6>" + data.product_name + "</h6><p>" + data.product_code + "<span style='margin-left: 15%'>" + data.sale_price + "</span></p></div></div></a>";
                        // return "<br><a onclick='addProduct("+list+")'>"+data.id+"</a><br>"
// <a onclick="addProduct('+data+')" class="btn"><div class="row"><div class="col-4"><img style="width: 50px; height: 50px;" src="images/products/product1.jpg" alt=""></div><div class="col-8"><h6>'+data.product_name+'</h6><p>'+data.product_code+'<span>'+data.sale_price+'</span></p></div></div></a>
                    }
                }
            }, 
            // {
            //     source: engine2.ttAdapter(),
            //     name: 'students-email',
            //     display: function(data) {
            //         return data.email;
            //     },
            //     templates: {
            //         empty: [
            //             '<div class="header-title"></div>Mã sản phẩm<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            //         ],
            //         header: [
            //             '<div class="header-title"></div><div class="list-group search-results-dropdown"></div>'
            //         ],
            //         suggestion: function (data) {
            //             return "<a onclick='addProduct("+ JSON.stringify(data) +")' class='btn list-group-item list-group-item-action'><div class='row'><div class='col-4'><img style='width: 50px; height: 50px;' src='images/products/product1.jpg' alt=''></div><div class='col-8'><h6>" + data.product_name + "</h6><p>" + data.product_code + "<span style='margin-left: 15%'>" + data.sale_price + "</span></p></div></div></a>";
            //         }
            //     }
            // }
        ]);
    });
</script>
@endsection