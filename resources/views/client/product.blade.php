@extends('client.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/ion-rangeslider/css/ion.rangeSlider.css">
@endsection
@section('content')
<div style="background-color: #C1CDCD" >
    <div id="heading-breadcrumbs" style="height: 50px; padding: 5px">
        <div class="container" style="height: 50px">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-8" >
                    <ul class="breadcrumb d-flex" style="text-align: left">
                        <li class="breadcrumb-item"><a href="{{route('client.home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    {{-- <h1 class="h2">Shopping Cart</h1> --}}
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="row col-12">
        <div class="col-1">
            
        </div>
        <div class="col-10">
            <div class="row bar" style="padding: 10px">
                <div class="col-md" style="background-color: #FFE4B5; margin-right: 10px">
                    <!-- MENUS AND FILTERS-->
                    {{-- <div class="panel panel-default sidebar-menu">
                        --}}
                        
                    <div class="panel-heading d-flex align-items-center justify-content-between">
                        <h3 class="h4 panel-title">Hãng</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 row">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" name="brand_all" class="custom-control-input brand filter" value="all" id="brand_all" checked>
                                        <label class="custom-control-label" for="brand_all">Tất cả</label>
                                    </div>
                                </div>
                                @foreach ($brands as $brand)
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" name="brand[{{$brand->brand_name}}]" value="{{$brand->brand_name}}" class="custom-control-input brand filter" id="brandCheck-{{$brand->id}}">
                                        <label class="custom-control-label" for="brandCheck-{{$brand->id}}">{{$brand->brand_name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if ($filter['typeProduct'] === 'ceramic')
                    <div class="panel-heading d-flex align-items-center justify-content-between">
                        <h3 class="h4 panel-title">Kích thước</h3>
                        {{-- <a href="#" class="btn btn-sm btn-danger"><i
                                class="fa fa-times-circle"></i><span class="d-none d-md-inline-block">Clear</span></a> --}}
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 row">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" name="size_all" class="custom-control-input size filter" id="size_all" value="all" checked>
                                        <label class="custom-control-label" for="size_all">Tất cả</label>
                                    </div>
                                </div>
                                @foreach ($filter['size'] as $key => $size)
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" name="size[{{$size}}]" value="{{$size}}" class="custom-control-input filter size" id="size-{{$key}}">
                                        <label class="custom-control-label" for="size-{{$key}}">{{$size}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- giá --}}
                    <div class="panel-heading d-flex align-items-center justify-content-between">
                        <h3 class="h4 panel-title">Khoảng giá</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12">
                                    <input id="range_05_2" name="setprice"  class="filter"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                </div> --}}
                {{-- <div class="panel panel-default sidebar-menu">
                    --}}
                    {{-- <div class="panel-heading d-flex align-items-center justify-content-between">
                        <h3 class="h4 panel-titlen">Màu sắc</h3>
                    </div> --}}
                    {{-- <div class="panel-body">
                        <div class="form-group row">
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color_all" value="all" type="checkbox" class="color" checked><span class="colour"></span> Tất cả
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[trắng]" value="trắng" type="checkbox" class="color"><span class="colour white"></span> Trắng
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[xanh]" value="xanh" type="checkbox" class="color"><span class="colour blue"></span> Xanh
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[xám]" value="xám" type="checkbox" class="color"><span class="colour" style="background-color: gray"></span> Xám
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[vàng]" value="vàng" type="checkbox" class="color"><span class="colour yellow"></span> Vàng
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[đỏ]" value="đỏ" type="checkbox" class="color"><span class="colour red"></span> Đỏ
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[đen]" value="đen" type="checkbox" class="color"><span style="background-color: black" class="colour red"></span> Đen
                                </label>
                            </div>
                            <div class="checkbox col-4">
                                <label>
                                    <input name="color[nâu]" value="nâu" type="checkbox" class="color"><span style="background-color: brown" class="colour red"></span> Nâu
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <form action="{{route('client.products', $filter['typeProduct'])}}" id="filter_form" method="get">
                            <input type="text" name="type" value="{{$filter['type']}}" hidden>
                            <input type="text" name="brand_selected" hidden>
                            <input type="text" name="size_selected" hidden>
                            <input type="text" name="color_selected" hidden>
                            <input type="text" name="order_by" hidden>
                            <input type="text" name="price" hidden>
                    </form>
                </div>
                <div class="col-md-9" style="background-color: #ffffff; min-height: 800px">
                    <div style="padding: 10px 0px 0px 0px;">
                        <div class="row">
                            <div class="col-3">
                                <p style="margin-top: 15px">Số sản phẩm: <b>{{$filter['count']}}</b></p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <select class="custom-select col-12 filter" name="order" id="order" onchange="getOrder()">
                                    {{-- <option selected="">Sắp xếp theo...</option> --}}
                                    <option selected value="new">Mới nhất</option>
                                    <option value="thap-cao">Giá thấp đến cao</option>
                                    <option value="cao-thap">Giá cao đến thấp</option>
                                    {{-- <option value="ban-chay-nhat">Bán chạy nhất</option> --}}
                                </select>
                            </div>
                            <div class="col-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination" style="margin-top: 5px">
                                        {{ $products->links("pagination::bootstrap-4") }}
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <hr style="margin-top: 0px">
                    <div class="row products products-big">
                        @foreach ($products as $key => $product)
                            <div class="col-lg-3">
                                <div class="product" style="background-color: ">
                                    <div class="image" style="">
                                        <a href="{{ route('client.product_details', $product->id)}}">
                                            <img
                                            @if($product->images->first()) src="images/products/{{$product->images->first()->name}}" @else src="images/products/product{{ $key + 1 }}.jpg" @endif
                                            alt="" style="object-fit: cover; height: 160px; width: 100%" class="img-fluid">
                                        </a>
                                        <br>
                                        <div class="text">
                                            <a href="{{ route('client.product_details', $product->id)}}" style="font-size: 13px">{{$product->product_name}}</a>
                                            <p class="price" style="color: red;font-size: 12px; text-align: left">
                                                <del style="font-size: 10px">{{ number_format($product->sale_price + 30000, 0, ',', ' ') }} vnđ</del>
                                                {{ number_format($product->sale_price, 0, ',', ' ') }} vnđ/m2
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="ribbon-holder">
                                        <div class="ribbon new" style="text-align: left;width: 40px;"><small style="margin-left: 5px">NEW</small></div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="pages" style="margin-left: 40%">
                        <ul >
                            {{ $products->links("pagination::bootstrap-4") }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- GET IT-->
</div>
@endsection
@section('script')
    <script src="src/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="vendors/scripts/range-slider-setting.js"></script>
    <script>
        $('.filter').change(function() {
            $('#filter_form').submit();
        })
        function getOrder() {
            $('input[name="order_by"]').val($('#order').val());
        }

        function getData(type) {
            var data = ''
            $('.'+type).each(function(value) {
                if ($(this).is(':checked')) {
                    data += '-';
                    data += $(this).val();
                }
            });
            data = data.substring(1);
            $('input[name = "'+type+'_selected"]').val(data);
        }

        // xử lý brand
        $('.brand').click(function() {
            if ($(this).val() == 'all') {
                $('.brand').prop('checked', false);
                $('input[name="brand_all"]').prop('checked', true);
            } else {
                $('input[name="brand_all"]').prop('checked', false);

            }
            getData('brand');
        });

        // xử lý kích thước
        $('.size').click(function() {
            if ($(this).val() == 'all') {
                $('.size').prop('checked', false);
                $('input[name="size_all"]').prop('checked', true);
            } else {
                $('input[name="size_all"]').prop('checked', false);

            }
            getData('size');
        });

        // xử lý màu sắc
        $('.color').click(function() {
            if ($(this).val() == 'all') {
                $('.color').prop('checked', false);
                $('input[name="color_all"]').prop('checked', true);
            } else {
                $('input[name="color_all"]').prop('checked', false);

            }
            getData('color');
        });

        // xử lý giá
        $("#range_05_2").change(function () {
            $('input[name="price"]').val($(this).val());
        });

        $(document).ready(function() {
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                    name = name.replace(/[\[\]]/g, '\\$&');
                    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                        results = regex.exec(url);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, ' '));
                }
            var url = location.href;

            var price = getParameterByName('price', url);
            if (price) {
                $('input[name="price"]').val(price);
                var price = price.split(';',);
                var price_to = price[1];
                var price_from = price[0];
            } else {
                var price_to = 20000000;
                var price_from = 0;
            }

            $("#range_05_2").ionRangeSlider({
                type: "double",
                min: 0,
                max: 2000000,
                from: price_from,
                to: price_to,
                skin: "square",
                hide_min_max: true,
                hide_from_to: false,
                grid: false
            });

            var brand = getParameterByName('brand_selected', url);
            if(brand && brand == 'all') {
                $('input[name="brand_all"]').prop('checked', true);
            } else if(brand) {
                var brands = brand.split('-',);
                $.each(brands, function( index, value ) {
                    $('input[name="brand_all"]').prop('checked', false);
                    $('input[name="brand['+value+']"]').prop('checked', true);
                });
            }
            getData('brand');

            var size = getParameterByName('size_selected', url);
            if( size && size == 'all') {
                $('input[name="size_all"]').prop('checked', true);
            } else if (size) {
                var sizes = size.split('-',);
                $.each(sizes, function( index, value ) {
                    $('input[name="size_all"]').prop('checked', false);
                    $('input[name="size['+value+']"]').prop('checked', true);
                });
            }
            getData('size');

            // xử lý màu sắc
            var color = getParameterByName('color_selected', url);
            if( color && color == 'all') {
                $('input[name="color_all"]').prop('checked', true);
            } else if (color) {
                var colors = color.split('-',);
                $.each(colors, function( index, value ) {
                    $('input[name="color_all"]').prop('checked', false);
                    $('input[name="color['+value+']"]').prop('checked', true);
                });
            }
            getData('color');

            var order_by = getParameterByName('order_by', url);
            if (order_by) {
                $('#order').val(order_by);
            }
            getOrder();


        });
    </script>
@endsection
