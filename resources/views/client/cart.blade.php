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
    {{-- <div style="background-color: #EEEEEE"> --}}
        <div id="heading-breadcrumbs" style="height: 50px; padding: 5px">
            <div class="container" style="height: 50px">
                <div class="row d-flex align-items-center flex-wrap">
                    <div class="col-md-8" >
                        <ul class="breadcrumb d-flex" style="text-align: left">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Giỏ hàng</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h1 class="h2">Shopping Cart</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container">
                <div class="row bar">
                    {{-- <div class="col-lg-12">
                        <p class="text-muted lead">You currently have 3 item(s) in your cart.</p>
                    </div> --}}
                    <div id="basket" class="col-lg-12">
                        <div class="box mt-0 pb-0 no-horizontal-padding">
                            <form method="get" action="{{route('client.checkouts')}}">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Khuyến mãi</th>
                                                <th colspan="2">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                            <tr id="cart-{{$cart->product_id}}">
                                                <td><a href="product_details/{{$cart->product_id}}"><img src="images/products/product10.jpg" alt="White Blouse Armani"
                                                    style="object-fit: cover; height: 50px;" class="img-fluid"></a></td>
                                                <td><a href="product_details/{{$cart->product_id}}">{{$cart->product_name}}</a></td>
                                                <td>
                                                    <input type="number" name="quantity_product-{{$cart->product_id}}" value="{{$cart->quantity}}"
                                                    @if (Auth::guard('web')->check())
                                                        onchange="changeCartAuth({{$cart->product_id}}, {{$cart->id}}, 'update')"
                                                    @else
                                                        onchange="changeQuantity({{$cart->product_id}})"
                                                    @endif
                                                    class="form-control" style="padding-right: 0px; padding-left: 2px;">
                                                </td>
                                                <td>{{ number_format($cart->price, 0, ',', ' ') }} vnđ/m2</td>
                                                <td>0.00</td>
                                                <td id="total_price-{{$cart->product_id}}">{{ number_format($cart->total_price, 0, ',', ' ') }} vnđ</td>
                                                <td><button type="button" class="btn btn-danger"
                                                    @if (Auth::guard('web')->check())
                                                        onclick="changeCartAuth({{$cart->product_id}}, {{$cart->id}}, 'delete')"
                                                    @else
                                                        onclick="removeProduct({{$cart->product_id}})"
                                                    @endif
                                                    ><i class="fa fa-trash-o"></i></button></td>
                                                <input type="number" name="product_price-{{$cart->product_id}}" value="{{$cart->price}}" hidden>
                                                <input class="total_price" type="number" name="total_price-{{$cart->product_id}}" value="{{$cart->total_price}}" hidden>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <input type="number" name="cost" hidden>
                                                <th colspan="5">Tổng</th>
                                                <th id="cost" colspan="2">980,000 vnđ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="box-footer d-flex justify-content-between align-items-center">
                                    <div class="left-col"><a href="products" class="btn btn-secondary mt-0"><i
                                                class="fa fa-chevron-left"></i> Tiếp tục mua</a></div>
                                    <div class="right-col">
                                        <button class="btn btn-secondary"><i class="fa fa-refresh"></i> Cập nhật giỏ hàng</button>
                                        <a href="{{route('client.checkouts')}}"><button type="button" class="btn btn-template-outlined">Tiến hành thanh toán <i
                                            class="fa fa-chevron-right"></i></button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div id="order-summary" class="box mt-0 mb-4 p-0">
                            <div class="box-header mt-0">
                                <h3>Đơn hàng</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tổng đơn hàng</td>
                                            <th>980,000 vnđ</th>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <th>Miễn phí</th>
                                        </tr>
                                        <tr>
                                            <td>Thuế</td>
                                            <th>0.00</th>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng cộng</td>
                                            <th>980,000</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box box mt-0 mb-4 p-0">
                            <div class="box-header mt-0">
                                <h4>Mã khuyến mại</h4>
                            </div>
                            <p class="text-muted">Nếu bạn có mã khuyến mại, hãy nhập vào ô bên dưới để nhận được ưu đãi.</p>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control"><span class="input-group-btn">
                                        <button type="button" class="btn btn-template-main"><i
                                                class="fa fa-gift"></i></button></span>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection
@section('script')
    {{-- <script>
        $(document).ready(function() {
            $('.minus').click(function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });

        $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function() {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 3; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });

    </script> --}}
    <script>
        
        function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }

        function getCost()
        {
            var cost = 0;
            $('.total_price').each(function() {
                // var quantity = $('input[name="quantity_product-'+id+'"]').val();
                cost += Number($(this).val());
            });

            $('#cost').text(formatNumber(cost)+ 'VNĐ');
        }

        $(window).on("load", function() { 
            getCost();
        });
        function loadPrice(id)
        {
            var quantity = $('input[name="quantity_product-'+id+'"]').val();
            var price = $('input[name="product_price-'+id+'"]').val();
            var total_price = quantity * price;
            $('#total_price-'+id).text(formatNumber(total_price)+ 'VNĐ');
            $('input[name="total_price-'+id+'"]').val(total_price);
            getCost();
        }

        function changeQuantity(id)
        {
            var quantity = $('input[name="quantity_product-'+id+'"]').val();
            $.cookie("count_product-"+id, quantity,{ expires: 7, path: '/' });
            loadPrice(id);
        }

        function removeProduct(id)
        {
            var listProduct = $.cookie("cart_product");
            var product_id = Number(listProduct.search(','+ id +','));

            if(product_id != -1) {
                var first = listProduct.slice(0, product_id);
                var last = listProduct.slice(product_id + 2, );
                var data = first + last;
                $.cookie("cart_product", data,{ expires: 7, path: '/' });
                $.removeCookie("count_product-"+id,{ expires: 7, path: '/' });
                $('#cart-'+id).remove();
                loadPrice(id);
            }
        };

        function changeCartAuth( product, id, action)
        {
            
            var quantity = $('input[name="quantity_product-'+product+'"]').val();
            var request = $.ajax({
                url: "ajax/updateCartAuth",
                method: "GET",
                data: {
                    quantity : quantity,
                    id : id,
                    action: action
                },
                dataType: "html"
            });
            request.done(function( data ) {
                if (action == 'delete') {
                    $('#cart-'+product).remove();
                }
                loadPrice(product);
            });
            
            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        }

    </script>
@endsection
