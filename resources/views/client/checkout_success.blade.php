@extends('client.index')
@section('content')

    {{-- <div id="content"> --}}
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="row col-12" style="height: 600px;">
                        <div id="checkout" class="col-lg-12">
                            <div style="text-align: center; margin-top: 10%">
                                <h3>Bạn đã đặt hàng thành công</h3>
                                <h3>Nhân viên cửa hàng sẽ liện hệ đến bạn</h3>
                                <br>
                                <a href="{{route('client.home')}}" class="btn btn-success">Quay lại trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    
<script>
    $(window).on("load", function() { 
        var listProduct = $.cookie("cart_product").split(',');
        $.each(listProduct, function( index, value ) {
            // alert(value );
            $.removeCookie("count_product-"+value,{ expires: 7, path: '/' });
        });
        $.removeCookie("cart_product",{ expires: 7, path: '/' });
        // alert(listProduct[1]);
    });
    
    // $.removeCookie("count_product-"+id,{ expires: 7, path: '/' });
</script>
@endsection

