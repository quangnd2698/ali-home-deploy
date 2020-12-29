@extends('client.index')
@section('style')

    {{--
    <link rel="stylesheet" type="text/css" href="client/count.css"> --}}
    <link rel="stylesheet" href="client/carousel.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    {{--
    <link rel="stylesheet" type="text/css" href="src/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    --}}

@endsection
@section('content')
<script>
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    function getPointUse(item){

        var point_use = ($('input[name="point_used"]').length) ? Number($('input[name="point_used"]').val()) : 0;
        var percent = Number($('input[name="preferential"]').val());
        var total_prices = $('input[name="total_prices"]').val();
        // alert(data);
        var last_cost = Math.ceil(total_prices*((100-percent)/100) - (point_use*400));
        if (last_cost < 0) {
            last_cost = 0;
        }
        $('input[name="cost"]').val(last_cost);
        $('#last_money').text(formatNumber(last_cost) + " VNĐ");
        // alert(last_cost);
    }
</script>
    {{-- <div style="background-color: #EEEEEE"> --}}
        <form action="{{route('client.checkouts.create')}}" method="POST">
            {{-- @method('PATCH') --}}
            @csrf
            <div id="heading-breadcrumbs" style="height: 50px; padding: 5px">
                <div class="container" style="height: 50px">
                    <div class="row d-flex align-items-center flex-wrap">
                        <div class="col-md-8">
                            <ul class="breadcrumb d-flex" style="text-align: left">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Thanh toán</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            {{-- <h1 class="h2">Shopping Cart</h1> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div id="content"> --}}
                <div class="row">
                    <div class="col-2"></div>
                    <div class="row col-8">
                        <div id="checkout" class="col-lg-8">
                            <div class="box border-bottom-0">
                                {{-- <form method="get" action="shop-checkout2.html"> --}}
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="firstname">Họ tên</label>
                                                    <input id="firstname" type="text" class="form-control" name="customer_name"
                                                    @if (Auth::guard('web')->check())
                                                        value="{{Auth::guard('web')->user()->name}}" readonly
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="company">Số điện thoại</label>
                                                    <input id="company" type="text"  name="customer_phone" class="form-control"
                                                    @if (Auth::guard('web')->check())
                                                        value="{{Auth::guard('web')->user()->phone}}" readonly
                                                    @else 
                                                        onchange="getPromotion()"
                                                    @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="street">Địa chỉ</label>
                                                    <input id="street" type="text" class="form-control" name="customer_address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="province">Tỉnh/Thành</label>
                                                    <select class="form-control" id="province" name="province">
                                                        <option  value="Hà Tĩnh" selected>Hà Tĩnh</option>
                                                        @isset($provinces)
                                                        @foreach ($provinces as $province)
                                                        <option onclick="getDistricts()" value="{{$province->name}}">{{$province->name}}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="district">Huyện</label>
                                                    <select class="form-control" id="district" name="district">
                                                        <option  value="Cẩm Xuyên" selected>Cẩm Xuyên</option>
                                                        @isset($districts)
                                                        @foreach ($districts as $district)
                                                        <option onclick="getWards({{$district->id}})" value="{{$district->name}}">{{$district->name}}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="ward">Xã, phường</label>
                                                    <select class="form-control" id="ward" name="ward">
                                                        @isset($wards)
                                                        @foreach ($wards as $ward)
                                                        <option  value="{{$ward->name}}">{{$ward->name}}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <li class="list-group-item">Khuyến mại:
                                        <hr>
                                        @if (Auth::guard('web')->check())
                                        <div class="col-12">
                                            <div class="row"><p style="margin-left:5px" class="col-7"> Cấp: <span><b>{{Auth::guard('web')->user()->rank}}</b></span></p><p class="col-4">giảm:<b id="percent">{{Auth::guard('web')->user()->percent}}</b>%</p>
                                            </div>
                                            <div class="row"><p class="col-9">Số điểm đang có: <h5 id="point">{{Auth::guard('web')->user()->point}}</h5> </p>
                                            </div>
                                        </div>
                                        <p>
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Sử dụng điểm
                                            </button>
                                        </p>
                                        <div class="collapse col-12" id="collapseExample" >
                                                {{-- <input type="number"> --}}
                                                <input style="padding:0px" class="form-control" value="0" type="number" min="0" max="{{Auth::guard('web')->user()->point}}" name="point_used" onchange="getPointUse(this)"></div>
                                        {{-- </div> --}}
                                        @else 
                                        <div class="row" id="km" style="margin-left: 10px">
                                        
                                        </div>
                                        @endif
                                        
                                    </li>
                                    
                                    <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-col"><a href="{{route('client.carts')}}" class="btn btn-secondary mt-0"><i
                                                    class="fa fa-chevron-left"></i>Quay lại giỏ hàng</a></div>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div id="order-summary" class="box mb-4 p-0">
                                <div class="box-header mt-0">
                                    <h3>ĐƠN HÀNG</h3>
                                </div>
                                {{-- <p class="text-muted text-small">Shipping and additional costs are calculated based on the
                                    values you have entered.</p> --}}
                                <div class="table-responsive">
                                    <ul class="list-group list-group-flush">
                                        <hr style="background-color: red">
                                        <li class="list-group-item">Tạm tính: <b id="cost_temporary">{{ number_format($last_cost, 0, ',', ' ') }} vnđ</b></li>
                                        <li class="list-group-item">Phí vận chuyển: 0.00
                                        <li class="list-group-item">
                                            <div class="row">
                                            <h6 class="col-12">Thành tiền: <span style="color: red; font-size: 20px" id="last_money">{{ number_format($last_cost, 0, ',', ' ') }} vnđ</span></h6>
                                            {{-- <p class="col-5">Thành tiền:</p> --}}
                                            {{-- <h5 class="col-6" style="color: red" id="last_money"></h5> --}}
                                        </li>
                                        
                                    </ul>
                                    <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                                            <button type="submit" class="btn btn-template-main">Xác nhận mua hàng<i
                                                    class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
            <!-- GET IT-->
                <input type="text" name="sales_channel" hidden value="web">
                <input type="number" hidden name="total_prices" value="{{$last_cost}}">
                <input type="number" hidden name="cost" value="{{$last_cost}}">
                <input type="number" hidden name="preferential">
        </form>
        
    @endsection
    @section('script')
        <script>
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
            }

            function getPromotion() {

                var phone = $('input[name="customer_phone"').val();
                $.get("orders/prices/"+phone, function(data) {
                    // alert(data[0]);
                    $("#km").html(data[0]);
                    $('input[name="preferential"]').val(data[2]);
                });
                // alert(1);
            }
            $(window).on("load", function() { 
                getPromotion();
            });

            $('#province').change(function () {
                var name = $(this).val();
                // alert(name);
                getDistricts(name)
            })
            function getDistricts(name) {
                $.get("ajax/districts/"+name, function(data) {
                    $('#district').html(data[0]);
                    $('#ward').html(data[1]);
                });
            }

            $('#district').change(function () {
                var name = $(this).val();
                // alert(name);
                getWards(name)
            })
            function getWards(name) {
                $.get("ajax/wards/"+name, function(data) {
                    $('#ward').html(data);
                });
            }
        </script>


    @endsection
