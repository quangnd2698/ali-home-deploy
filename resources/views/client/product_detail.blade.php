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
    <style>
        .bottomright {
            position: fixed;
            bottom: 8px;
            right: 16px;
            font-size: 18px;
        }
    </style>
    <div style="background-color: #EEEEEE">
        <div id="heading-breadcrumbs" style="height: 50px; padding: 5px">
            <div class="container" style="height: 50px">
                <div class="row d-flex align-items-center flex-wrap">
                    <div class="col-md-8" >
                        <ul class="breadcrumb d-flex" style="text-align: left">
                            <li class="breadcrumb-item"><a href="{{route('client.home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('client.products', 'ceramic,all')}}">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">{{$product->product_name}}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        {{-- <h1 class="h2">Shopping Cart</h1> --}}
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container">
                <div class="row bar">
                    <!-- LEFT COLUMN _________________________________________________________-->
                    <div class="col-lg-9">
                        <div id="productMain" class="row">
                            <div class="col-sm-5">
                                <div data-slider-id="1" class="owl-carousel shop-detail-carousel" style="height: 400px">
                                    @if (!$product->images->first())
                                    <div> <img src="images/products/product2.jpg" alt="" class="img-fluid"
                                        style="height: 400px; object-fit: cover">
                                    </div>
                                    @else
                                        @foreach ($product->images as $key => $image)
                                        <div> <img src="images/products/{{$image->name}}" alt="" class="img-fluid"
                                            style="height: 400px; object-fit: cover">
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div data-slider-id="1" class="owl-thumbs" style="height: 70px">
                                    @if (!$product->images->first())
                                    <button class="owl-thumb-item"><img src="images/products/product2.jpg" alt=""
                                        class="img-fluid" style="height: 70px"></button>
                                    @else
                                        @foreach ($product->images as $key => $image)
                                        <button class="owl-thumb-item"><img src="images/products/{{$image->name}}" alt=""
                                            class="img-fluid" style="height: 70px"></button>
                                        @endforeach
                                    @endif
                                    {{-- <button class="owl-thumb-item"><img src="images/products/product2.jpg" alt=""
                                            class="img-fluid" style="height: 70px"></button>
                                    <button class="owl-thumb-item"><img src="images/products/product3.jpg" alt=""
                                            class="img-fluid" style="height: 70px"></button>
                                    <button class="owl-thumb-item"><img src="images/products/product4.jpg" alt=""
                                            class="img-fluid" style="height: 70px"></button> --}}
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <h3>{{$product->product_name}}</h3>
                                <div class="box" style="margin-top: 0px; margin-bottom: 0px">
                                    <form>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-5">Thương hiệu:</div>
                                                    <div class="col-7">
                                                        <h5>{{$product->producer}}</h5>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-5">Kích thước:</div>
                                                    <div class="col-7">
                                                        <h5>{{$product->size}}</h5>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-5">Màu sắc:</div>
                                                    <div class="col-7">
                                                        <h5>{{$product->color}}</h5>
                                                    </div>
                                                </div>
                                            </li>
                                            <div class="card"
                                                style="border-width:5px; border-color: #009900; border-radius: 15px; text-align: center">
                                                <h2 style="color: red; margin-top: 15px">{{ number_format($product->sale_price, 0, ',', ' ') }} VNĐ</h2>
                                                <p class="text">Tiết kiệm đến <span
                                                        style="color: red; font-size: 20px">5%</span> (giá gốc) <del>{{ number_format($product->sale_price + 30000, 0, ',', ' ') }}
                                                        VNĐ</del></p>
                                            </div>
                                            <input type="number" name="max_quantity" value="{{$product->quantity}}">
                                            <div class="col-12 row">
                                                <div class=" number col-5 row">
                                                    <button class="minus col-3 btn btn-danger" type="button"
                                                        style="padding: 0px 0px 0px 0px; border-radius: 10px 0px 0px 10px">
                                                        <i class="fa fa-2x fa-minus-square"></i>
                                                    </button>
                                                    <div class="col-6" style="padding: 0px">
                                                        <input class="form-control" min="0" name="count_product" type="number" value="1" 
                                                            style="display: block">
                                                    </div>
                                                    <button class="plus col-3 btn btn-success" type="button"
                                                        style="padding: 0px 0px 0px 0px; border-radius: 0px 10px 10px 0px">
                                                        <i class="fa fa-2x fa-plus-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col-7" style="text-align: center">
                                                    <h3 style="margin-top: 10px; margin-bottom: 5px">
                                                        @if ($product->quantity > 0)
                                                            Tồn kho: {{$product->quantity}}
                                                        @else
                                                        <p style="color: red">HẾT HÀNG</p>
                                                        @endif
                                                        
                                                    </h3>
                                                </div>
                                            </div>
                                            
                                            <br>
                                            <p class="text-center">
                                                @if (Auth::guard('web')->check())
                                                <button type="button" onclick="addToCartAuth({{$product->id}}, 'checkout')" class="btn btn-danger"><i
                                                    class="fa fa-shopping-cart"></i>
                                                Đặt mua ngay</button>
                                                <button onclick="addToCartAuth({{$product->id}}, 'addToCart')" type="button" class="btn btn-template-outlined"><i
                                                        class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                @else
                                                <button type="button" onclick="getCheckout({{$product->id}})" class="btn btn-danger"><i
                                                    class="fa fa-shopping-cart"></i>
                                                Đặt mua ngay</button>
                                                <button onclick="addToCart({{$product->id}})" type="button" class="btn btn-template-outlined"><i
                                                        class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                @endif
                                            </p>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="details" class="card-box pd-10 mb-4 mt-4">
                            <div class="tab">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#info" role="tab"
                                            aria-selected="true">Thông tin chi tiết</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#evaluate" role="tab"
                                            aria-selected="false">Đánh giá</a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="info" role="tabpanel">
                                        <div class="pd-20">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Tên sản phẩm:</div>
                                                        <div class="col-7">{{$product->product_name}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Thương hiệu:</div>
                                                        <div class="col-7">{{$product->producer}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Mã sản phẩm:</div>
                                                        <div class="col-7">{{$product->product_code}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Chất liệu:</div>
                                                        <div class="col-7">{{$product->material}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Kích thước:</div>
                                                        <div class="col-7">{{$product->size}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Màu sắc:</div>
                                                        <div class="col-7">{{$product->color}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Bề mặt:</div>
                                                        <div class="col-7">{{$product->surface}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Chức năng:</div>
                                                        <div class="col-7">{{$product->uses_for}}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-5">Số đơn vị/hộp:</div>
                                                        <div class="col-7">{{$product->quantity_in_one_box}}</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- đánh giá --}}

                        <div id="details" class="card-box pd-10 mb-4 mt-4">
                            <div class="col-12">
                                <h4>
                                    Đánh giá & nhận xét
                                </h4>
                                <hr>
                            </div>
                            <div class="pd-20 row">
                                <div class="tab-content col-4" style="padding-top: 35px">
                                    <h3 class="col-12" style="text-align: center">{{$product->point}}/5</h3>
                                    <p style="margin-left: 20%; color: #FF9900; font-size: 25px">
                                        <?= $product->display_star ?>
                                    </p>
                                    <p class="col-12" style="text-align: center;color: #333333; font-size: 13px">{{$product->count_evaluate}} đánh giá &nhận xét</p>
                                </div>
                                <input type="text" name="star_evaluate" value="0" hidden>
                                <div class="tab-content col-8" style="padding-bottom:">
                                    
                                    <h6 style="margin-bottom: 4px">Bạn chấm sản phẩm này mấy sao</h6>
                                    <p style="margin-bottom: 4px; color: #FF9900; font-size: 20px">
                                        <i style="cursor:pointer" class="icon-copy fa fa-star-o evaluate" id="1"></i>
                                        <i style="cursor:pointer" class="icon-copy fa fa-star-o evaluate" id="2"></i>
                                        <i style="cursor:pointer" class="icon-copy fa fa-star-o evaluate" id="3"></i>
                                        <i style="cursor:pointer" class="icon-copy fa fa-star-o evaluate" id="4"></i>
                                        <i style="cursor:pointer" class="icon-copy fa fa-star-o evaluate" id="5"></i>
                                        <small id="title_evaluate" style="font-size: 15px">Tuyệt vời</small>
                                    </p>
                                    <textarea name="comment" class="form-control" style="height: 50px;margin-bottom: 4px;"></textarea>
                                    <div style="margin-bottom: 0px">
                                        <div class="float-right">
                                            @if (Auth::guard('web')->check())
                                            <input type="text" name="user_id" value="{{Auth::guard('web')->id()}}" hidden>
                                            <input type="text" name="user_name" value="{{Auth::guard('web')->user()->name ?? 'stark'}}" hidden>
                                            <input type="text" name="product_id" value="{{$product->id}}" hidden>
                                            <button id="submit_cmt" class="btn btn-danger">gửi</button>
                                            @else
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#login-modal" style="margin-top: 10%">Đăng nhập</button>
                                            @endif
                                        </div>
                                        <div class="float-left">
                                            <small>Một đánh giá có ích thường dài từ 100 ký tự trở lên</small>
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <hr> --}}
                            </div>
                            {{-- <br> --}}
                            <div style="margin-left: 30px">
                                <h5>Khách hàng nhận xét
                                    <hr>
                                </h5>
                                <div id="list_comment">
                                    @foreach ($product->comments()->get() as $comment)
                                    <div>
                                        <p style="color: #FF9900; font-size: 14px; margin-bottom: 5px">
                                            <?= $comment->display_star ?>
                                        </p>
                                        <small>Bởi: <b style="margin-right: 30px; font-size: 15px">{{$comment->user_name}}</b> vào ngày:{{$comment->created_at}}</small>
                                        <p>{{$comment->comment}}</p>
                                    </div>
                                    <hr>
                                    @endforeach
                                    
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!-- MENUS AND FILTERS-->
                        <div class="panel panel-default sidebar-menu">
                            <div class="panel-heading">
                                <h3 class="h4 panel-title">ALI HOME cam kết</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-pills flex-column text-sm category-menu">
                                    <li class="nav-item">
                                        <i class="fa fa-2x fa-barcode" style="color: red"></i> <span
                                            style="margin-left: 15px">Hàng chính hãng</span>
                                    </li>
                                    <br>
                                    <li class="nav-item">
                                        <i class="icon-copy fa-2x fa fa-handshake-o" style="color: red"
                                            aria-hidden="true"></i><span style="margin-left: 15px">Bảo hành 1 năm</span>
                                    </li>
                                    <br>
                                    <li class="nav-item">
                                        <i class="icon-copy fa-2x fa fa-truck" style="color: red"
                                            aria-hidden="true"></i><span style="margin-left: 15px">Vận chuyển miễn
                                            phí</span>
                                    </li>
                                    <br>
                                    <li class="nav-item">
                                        <i class="icon-copy fa-2x fa fa-repeat" style="color: red"
                                            aria-hidden="true"></i><span style="margin-left: 15px">Hàng luôn có sẵn</span>
                                    </li>
                                    <br>
                                    <li class="nav-item">
                                        <i class="icon-copy fa-2x fa fa-headphones" style="color: red"
                                            aria-hidden="true"></i><span style="margin-left: 15px">Hỗ trợ 24/7</span>
                                    </li>
                                </ul>
                            </div>
                            <br>
                            {{-- Phân loại --}}


                            <div class="panel panel-default sidebar-menu">

                                <div class="panel-heading">
                                    <h5 class="panel-title">Danh mục sản phẩm</h5>
                                </div>

                                <div class="panel-body">
                                    <ul class="nav nav-pills nav-stacked category-menu">
                                        <li class="col-12">
                                            <a href="shop-category.html">Gạch men </a><span
                                                class="badge badge-dark pull-right">420</span>
                                            <ul style="font-size: 14px; margin-left: 20px;">
                                                <li><a href="shop-category.html" style="color: black">Gạch lát nền</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Gạch ốp tường</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Gạch bông</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Gạch trang trí</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Gạch vỉa hè</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Gạch giả gỗ</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="active col-12">
                                            <a href="shop-category.html">Thiết bị vệ sinh </a><span
                                                class="badge badge-dark pull-right">123</span>
                                            <ul style="font-size: 14px; margin-left: 20px;">
                                                <li><a href="shop-category.html" style="color: black">Bồn cầu</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Bộ bồn tắm sen tắm</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Chậu rửa mặt</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Vòi Lavabo</a>
                                                </li>
                                                <li><a href="shop-category.html" style="color: black">Thiết bị nóng lạnh</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="banner">
                            <div class="panel-heading">
                                <h5 class="panel-title">Combo theo sản phẩm</h5>
                            </div>
                            @foreach ($product->combo_product as $key => $combo)
                                <div class="product" style="background-color: white;x">
                                    <div class="image">
                                        <a href="product_details/{{$combo->id}}">
                                            <img src="images/products/product{{$key+1}}.jpg" alt=""
                                                style="object-fit: cover; height: 160px; width: 100%"
                                                class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="text" style="margin: 0px">
                                        <a href="product_details/{{$combo->id}}" style="font-size: 13px; margin: 0%">{{$combo->product_name}}</a>
                                        <p class="price"
                                            style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                            <del style="font-size: 10px">{{$combo->sale_price + 20000}}</del>
                                            {{ number_format($combo->sale_price, 0, ',', ' ') }} vnđ/m2
                                        </p>
                                        <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                            <?= $combo->display_star ?>
                                            <span><small style="font-size: 10px; color: #333333"> {{$combo->count_evaluate}} đánh
                                                    giá</small></span>
                                        </p>
                                        <a href="product_details/{{$combo->id}}" style="font-size: 12px"
                                            class="btn btn-default">Xem</a>
                                        <a onclick="addToCart({{$combo->id}})" style="font-size: 12px"
                                            class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a>
                                    </div>
                                    <div class="ribbon-holder">
                                        <div class="ribbon new" style="text-align: left;"><small
                                                style="margin-left: 5px">COMBO</small></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- sản phẩm tương tự --}}
            </div>
        </div>
        <section class="bar no-mb text-md-center">
            <div class="col-12 row">
                <div style="width: 10%"></div>
                <div class="col-10 card" style="padding: 10px 10px 10px 10px">
                    <div class="row">
                        <div class="heading text-left col-6">
                            <h3 style="margin-left: 5%">Gợi ý sản phẩm</h3>
                        </div>
                        <div class="col-6 heading text-right">
                            {{-- <a href="">
                                <h6>Xem tất cả >></h6>
                            </a> --}}
                        </div>
                    </div>
                    <div id="carousel-example-multi-2" class="carousel slide carousel-multi-item v-2 product-carousel"
                        data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-multi-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="2"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="3"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="4"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="5"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="6"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="7"></li>
                            <li data-target="#carousel-example-multi-2" data-slide-to="8"></li>
                        </ol>
                        <!--/.Indicators-->
                        <div class="row col-12">
                            <div class="col" style="width: 10px; padding: 0 0 0 0">
                                <a class="btn-floating btn-sm" href="#carousel-example-multi-2" data-slide="prev"
                                    style="margin-top: 125px">
                                    <i class="fa fa-3x fa-chevron-left"></i>
                                </a>
                            </div>
                            <div class="col-11" style="padding: 0 0 0 0">
                                <div class="carousel-inner" role="listbox">
                                    @foreach ($similarProducts as $key => $similarProduct)
                                    <div class="carousel-item @if ($key == 0)
                                        {{'active mx-auto'}}
                                        @endif">
                                        <div class="product" style="width: 21% ;background-color: white; margin-left: 20px">
                                            <div class="image">
                                                <a href="{{route('client.product_details', $product->id)}}">
                                                    <img src="images/products/product{{$key+1}}.jpg" alt=""
                                                        style="object-fit: cover; height: 160px; width: 100%"
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="text" style="margin: 0px">
                                                <a href="{{route('client.product_details', $product->id)}}" style="font-size: 13px; margin: 0%">{{$similarProduct->product_name}}</a>
                                                <p class="price"
                                                    style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                                    <del style="font-size: 10px">{{$similarProduct->sale_price + 20000}}</del>
                                                    {{ number_format($similarProduct->sale_price, 0, ',', ' ') }} vnđ/m2
                                                </p>
                                                <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                                    <?= $similarProduct->display_star ?>
                                                    <span><small style="font-size: 10px; color: #333333"> {{$similarProduct->count_evaluate}} đánh
                                                            giá</small></span>
                                                </p>
                                                <a href="product_details/{{$similarProduct->id}}" style="font-size: 12px"
                                                    class="btn btn-default col-2">Xem</a>
                                                <a onclick="addToCart({{$similarProduct->id}})" style="font-size: 12px"
                                                    class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a>
                                            </div>
                                            <div class="ribbon-holder">
                                                <div class="ribbon new" style="text-align: left;width: 40px;"><small
                                                        style="margin-left: 5px">NEW</small></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col" style="width: 10px; padding: 0 0 0 0">
                                <a class="btn-floating btn-sm" href="#carousel-example-multi-2" data-slide="next"
                                    style="margin-top: 125px">
                                    <i class="fa fa-3x fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" style="width: 5%"></div>
                <!-- Carousel End-->
            </div>
        </section>
    </div>
    <div class="bottomright" id="bottomright">

    </div>
@endsection
@section('script')
<script src="client/product_details.js"></script>
    <script>

        function checkQuantity() {
            var count = $('input[name="count_product"]').val();
            var max_quantity = $('input[name="max_quantity"]').val();
            // alert(max_quantity)
            if (Number(count) > Number(max_quantity)) {
                return false
            } else {
                return true
            }
            
        }
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

    function alertSuccess()
    {
        var text = '<div id="alerts" class="alert alert-success" role="alert">Đã thêm sản phẩm vào giỏ</div>';
        $('#bottomright').html(text);
        $('#alerts').slideUp( 4000 ).delay( 4000 ).remove( 4000 );
    }

    function alertErrors()
    {
        var text = '<div id="alerts" class="alert alert-danger" role="alert">Sản phẩm đã có trong giỏ</div>';
        $('#bottomright').html(text);
        $('#alerts').slideUp( 4000 ).delay( 4000 ).remove( 4000 );
    }

    // $.cookie("cart_product",",",{ expires: 7, path: '/' });
    function addToCart(id) {
        alert(checkQuantity());
        if (checkQuantity() == true) {
            var listProduct = $.cookie("cart_product");
            var count = $('input[name="count_product"]').val();

            if (listProduct == null || listProduct.search(','+ id + ',') == -1) {
                // alert(1);
                if (listProduct == null) {
                    listProduct = ','
                }
                listProduct += id;
                listProduct += ','

                $.cookie("cart_product", listProduct,{ expires: 7, path: '/' });
                $.cookie("count_product-"+id, count,{ expires: 7, path: '/' });
                // $.cookie("product-"+id, id,{ expires: 7, path: '/' });
                alertSuccess();
            } else {
                alertErrors();
            }
        } else {
            alert('số hàng trong kho không đủ')
        }
    }

    function getCheckout(id)
    {
        if (checkQuantity() == true) {
            var listProduct = $.cookie("cart_product");
            var count = $('input[name="count_product"]').val();

            if (listProduct == null || listProduct.search(','+ id + ',') == -1) {
                // alert(1);
                if (listProduct == null) {
                    listProduct = ','
                }
                listProduct += id;
                listProduct += ','

                $.cookie("cart_product", listProduct,{ expires: 7, path: '/' });
                $.cookie("count_product-"+id, count,{ expires: 7, path: '/' });
            }
            window.location.href='/carts';
        } else {
            alert('số hàng trong kho không đủ')
        } 

    }

    function setEvaluate(id) {
        for (let i = 0; i <= id; i++) {
            $('#'+i).attr("class", 'fa fa-star evaluate');
        }
        for (let i = 5; i > id; i--) {
            $('#'+i).attr("class", 'icon-copy fa fa-star-o evaluate');
        }

        if (id == 1) {
            $('#title_evaluate').text('Rất tệ')
        } else if (id == 2) {
            $('#title_evaluate').text('Tệ')
        }else if (id == 3) {
            $('#title_evaluate').text('Được')
        } else if ( id == 4){
            $('#title_evaluate').text('Tốt')
        } else {
            $('#title_evaluate').text('Tuyệt vời')
        }
    }

    $('.evaluate').mouseover(function() {
        var star_id = $(this).attr('id');
        setEvaluate(star_id);
    });

    $('.evaluate').mouseleave(function() {
        setEvaluate($('input[name="star_evaluate"]').val());
    });

    $('.evaluate').click(function() {
        var star_id = $(this).attr('id');
        setEvaluate(star_id);
        $('input[name="star_evaluate"]').val(star_id);
    });

    $('#submit_cmt').click(function () {
        var star_evaluate = $('input[name="star_evaluate"]').val();
        var product_id = $('input[name="product_id"]').val();
        var user_name = $('input[name="user_name"]').val();
        var comment = $('textarea[name="comment"]').val();
        var user_id = $('input[name="user_id"]').val();
        var request = $.ajax({
            url: "ajax/comment",
            method: "GET",
            data: { point : star_evaluate,
                comment : comment,
                user_id : user_id,
                product_id : product_id,
                user_name : user_name
            },
            dataType: "html"
        });

        request.done(function( data ) {
            $( "#list_comment" ).append(data);
            location.reload()
        });
        
        request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
    });

    function addToCartAuth (product_id, flag) {

        if (checkQuantity() == true) {
            var product_id = $('input[name="product_id"]').val();
            var count = $('input[name="count_product"]').val();
            var request = $.ajax({
                url: "ajax/addToCartAuth",
                method: "GET",
                data: {
                    quantity : count,
                    product_id : product_id,
                },
                dataType: "html"
            });
            request.done(function( data ) {
                if (flag == 'checkout') {
                    window.location.href='/carts'; 
                } else {
                    alertSuccess();
                }
            });
            
            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        } else {
            alert ('số hàng không đủ')
        }

        
    };

    </script>
@endsection
