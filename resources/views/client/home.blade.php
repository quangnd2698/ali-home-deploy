@extends('client.index')
@section('style')
    <link rel="stylesheet" href="client/carousel.css">
@endsection
@section('content')
    <section style="background: url('client/img/photogrid.jpg') center center repeat; background-size: cover;"
        class="bar background-white relative-positioned">
            <div class="home-carousel">
                <div class="dark-mask mask-primary"></div>
                <div class="container">
                    <div class="homepage owl-carousel">
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <p>
                                        <img src="" alt="" class="ml-auto">
                                    </p>
                                    <h1 style="color: yellow">Đa dạng mẫu mã</h1>
                                    <p style="color: black">gạch ốp tường<br>gạch lát nền
                                        <br>gạch bông
                                        <br> trang trí
                                        <br>gạch giả gỗ
                                        <br>gạch sân vườn
                                        <br>gạch vỉa hè
                                        <br>gạch bóng kiếng
                                    </p>
                                </div>
                                <div class="col-md-7"><img src="vendors/slides/slide4.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-7 text-center"><img src="vendors/slides/slide2.jpg" alt=""
                                        class="img-fluid"></div>
                                <div class="col-md-5">
                                    <h2 style="color: black">Cung cấp sản phẩm chính hiệu, uy tín</h2>
                                    <ul class="list-unstyled">
                                        <li>Nguyên liệu đầu vào có chất lượng cao do được nhập khẩu trực tiếp từ các
                                            <br> nước có nền công nghiệp phát triển như Nhật Bản, Tây Ban Nha, Đài Loan
                                            ...
                                        </li>
                                        <li>
                                            Cam kết chịu trách nhiệm lâu dài đối với các sản phẩm do trung tâm cung
                                            cấp.
                                        </li>
                                        {{-- <li>Google maps, Forms, Megamenu, CSS3 Animations
                                            and much more</li>
                                        <li>+ 11 extra pages showing template features</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <h1 style="color: black">Chính sách bảo hành uy tín</h1>
                                    <ul class="list-unstyled">
                                        <li>Đổi trả 15 ngày</li>
                                        <li>Hệ thống kiểm tra bảo hành online</li>
                                        <li>chính sách bảo hành hợp lý</li>
                                        {{-- <li>7 preprepared colour variations</li>
                                        --}}
                                    </ul>
                                </div>
                                <div class="col-md-7"><img src="vendors/slides/slide7.png" alt="" class="img-fluid"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-7"><img src="vendors/slides/slide8.jpg" alt="" class="img-fluid"></div>
                                <div class="col-md-5">
                                    <h1 style="color: black">Khuyến mãi và ưu đãi</h1>
                                    <ul class="list-unstyled">
                                        <li>Nhiều chính sách khuyến mã hấp dẫn</li>
                                        <li>Tích điểm cho khách hàng</li>
                                        <li>Chia cấp bậc cho khách hàng</li>
                                        <li>Miễn phí vận chuyển</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End-->
            {{--
        </div> --}}
    </section>

    <section class="bar background-pentagon no-mb text-md-center">
        <div class="row col-12" >
            <div class="col-2"></div>
            <div class="col-8 row pd-20" style="border: 2px solid gold; background-color: white">
                <div class="col-3 row" style="border-right: 2px solid black;">
                    <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-truck"></i></div>
                    <div class="col-9">
                        <h5>Miễn phí vận chuyển</h5>
                        <h6>Cho đơn hàng trên 500k và trong phạm vi tỉnh Hà Tĩnh</h6>
                    </div>
                    
                </div>
                <div class="col-3 row" style="border-right: 2px solid black; margin-left: 5px">
                    <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-life-ring"></i></i></div>
                    <div class="col-9">
                        <h5>365 Ngày đổi trả</h5>
                        <h6>Đối với sản phẩm hỏng</h6>
                    </div>
                </div>
                <div class="col-3 row" style="border-right: 2px solid black; margin-left: 5px">
                        <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-box-open"></i></div>
                    <div class="col-9">
                        <h5>Hàng luôn có sẵn</h5>
                    <h6>Hàng có sẵn ở kho và sẵn sàng giao</h6>
                    </div>
                </div>
                <div class="col-3 row" style="margin-left: 5px">
                    <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-comments"></i></div>
                <div class="col-9">
                    <h5>
                        Hỗ trợ 24/7</h5>
                <h6>Luôn luôn hỗ trợ bạn</h6>
                </div>
            </div>
            </div>
            <div class="col-2"></div>
        </div>
        <br>
        <br>
        <div class="col-12 row">
            <div  style="width: 10%"></div>
            <div class="col-10 card" style="padding: 10px 10px 10px 10px">
                <div class="row">
                    <div class="heading text-left col-6">
                        <h3 style="margin-left: 5%; font-family: cursive">Sản phẩm mới nhất</h3>
                    </div>
                    <div class="col-6 heading text-right">
                        <a href=""><h6>Xem tất cả >></h6></a>
                    </div>
                </div>
                
                <div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2 product-carousel"
                    data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-multi" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="1"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="2"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="3"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="4"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="5"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="6"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="7"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="8"></li>
                    </ol>
                    <!--/.Indicators-->
                    <div class="row col-12">
                        <div class="col" style="width: 10px; padding: 0 0 0 0">
                        <a class="btn-floating btn-sm" href="#carousel-example-multi" data-slide="prev" style="margin-top: 175px">
                            <i class="fa fa-3x fa-chevron-left"></i>
                        </a>
                        </div>
                        <div class="col-11" style="padding: 0 0 0 0">
                            <div class="carousel-inner" role="listbox">

                                @foreach ($newProducts as $key => $product)
                                <div class="carousel-item @if ($key == 0)
                                    {{'active mx-auto'}}
                                @endif">
                                    <div class="product" style="width: 21% ;background-color: white; margin-left: 20px">
                                        <div class="image">
                                            <a href="{{route('client.product_details', $product->id)}}">
                                                <img src="images/products/product{{$key + 1}}.jpg" alt=""
                                                    style="object-fit: cover; height: 160px; width: 100%"
                                                    class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text" style="margin: 0px">
                                            <a href="{{route('client.product_details', $product->id)}}" style="font-size: 13px; margin: 0%">{{$product->product_name}}</a>
                                            <p class="price"
                                                style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                                <del style="font-size: 10px">{{$product->sale_price + 20000}}</del>
                                                {{ number_format($product->sale_price, 0, ',', ' ') }} vnđ/m2
                                            </p>
                                            <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span><small style="font-size: 10px; color: #333333"> 12 đánh
                                                        giá</small></span>
                                            </p>
                                            <a href="{{route('client.product_details', $product->id)}}" style="font-size: 12px"
                                                class="btn btn-default col-2">Xem</a>
                                            {{-- <a href="shop-basket.html" style="font-size: 12px"
                                                class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a> --}}
                                        </div>
                                        <div class="ribbon-holder">
                                            <div class="ribbon hot" style="text-align: left;width: 40px;"><small
                                                    style="margin-left: 5px">HOT</small></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{-- </div> --}}
                            </div>
                        </div>
                        <div class="col" style="width: 10px; padding: 0 0 0 0">
                            <a class="btn-floating btn-sm" href="#carousel-example-multi" data-slide="next" style="margin-top: 175px">
                                <i class="fa fa-3x fa-chevron-right"></i>
                            </a>
                        </div>

                    </div>



                </div>

            </div>
            <div class="col" style="width: 5%"></div>

            <!-- Carousel End-->
        </div>
        <br>
        {{-- <div class="col-12 row">
            <div  style="width: 10%"></div>
            <div class="col-10 card" style="padding: 10px 10px 10px 10px">
                <div class="row">
                    <div class="heading text-left col-6">
                        <h3 style="margin-left: 5%; font-family: cursive">Sản phẩm bán chạy nhất</h3>
                    </div>
                    <div class="col-6 heading text-right">
                        <a href=""><h6>Xem tất cả >></h6></a>
                    </div>
                </div>
                <div id="carousel-example-multi-1" class="carousel slide carousel-multi-item v-2 product-carousel"
                    data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-multi-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="1"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="2"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="3"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="4"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="5"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="6"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="7"></li>
                        <li data-target="#carousel-example-multi-1" data-slide-to="8"></li>
                    </ol>
                    <!--/.Indicators-->
                    <div class="row col-12">
                        <div class="col" style="width: 10px; padding: 0 0 0 0">
                        <a class="btn-floating btn-sm" href="#carousel-example-multi-1" data-slide="prev" style="margin-top: 175px">
                            <i class="fa fa-3x fa-chevron-left"></i>
                        </a>
                        </div>
                        <div class="col-11" style="padding: 0 0 0 0">
                            <div class="carousel-inner" role="listbox">
                                @foreach ($topBuyProducts as $key => $product)
                                <div class="carousel-item @if ($key == 0)
                                    {{'active mx-auto'}}
                                @endif">
                                    <div class="product" style="width: 21% ;background-color: white; margin-left: 20px">
                                        <div class="image">
                                            <a href="shop-detail.html">
                                                <img src="images/products/product{{$key}}.jpg" alt=""
                                                    style="object-fit: cover; height: 160px; width: 100%"
                                                    class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text" style="margin: 0px">
                                            <a href="shop-detail.html" style="font-size: 13px; margin: 0%">{{$product->product_name}}</a>
                                            <p class="price"
                                                style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                                <del style="font-size: 10px">{{$product->sale_price + 20000}}</del>
                                                {{ number_format($product->sale_price, 0, ',', ' ') }} vnđ/m2
                                            </p>
                                            <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span><small style="font-size: 10px; color: #333333"> 12 đánh
                                                        giá</small></span>
                                            </p>
                                            <a href="shop-detail.html" style="font-size: 12px"
                                                class="btn btn-default col-2">Xem</a>
                                            <a href="shop-basket.html" style="font-size: 12px"
                                                class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a>
                                        </div>
                                        <div class="ribbon-holder">
                                            <div class="ribbon hot" style="text-align: left;width: 40px;"><small
                                                    style="margin-left: 5px">HOT</small></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col" style="width: 10px; padding: 0 0 0 0">
                            <a class="btn-floating btn-sm" href="#carousel-example-multi-1" data-slide="next" style="margin-top: 175px">
                                <i class="fa fa-3x fa-chevron-right"></i>
                            </a>
                        </div>

                    </div>



                </div>

            </div>
            <div class="col" style="width: 5%"></div>

            <!-- Carousel End-->
        </div> --}}

        <br>
        <div class="col-12 row">
            <div  style="width: 10%"></div>
            <div class="col-10 card" style="padding: 10px 10px 10px 10px">
                <div class="row">
                    <div class="heading text-left col-6">
                        <h3 style="margin-left: 5%; font-family: cursive">Sản phẩm đang khuyến mại</h3>
                    </div>
                    <div class="col-6 heading text-right">
                        <a href=""><h6>Xem tất cả >></h6></a>
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
                        <a class="btn-floating btn-sm" href="#carousel-example-multi-2" data-slide="prev" style="margin-top: 175px">
                            <i class="fa fa-3x fa-chevron-left"></i>
                        </a>
                        </div>
                        <div class="col-11" style="padding: 0 0 0 0">
                            <div class="carousel-inner" role="listbox">

                                @foreach ($saleProducts as $key => $product)
                                <div class="carousel-item @if ($key == 0)
                                    {{'active mx-auto'}}
                                @endif">
                                    <div class="product" style="width: 21% ;background-color: white; margin-left: 20px">
                                        <div class="image">
                                            <a href="{{route('client.product_details', $product->id)}}">
                                                <img src="images/products/product{{$key + 1}}.jpg" alt=""
                                                    style="object-fit: cover; height: 160px; width: 100%"
                                                    class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text" style="margin: 0px">
                                            <a href="{{route('client.product_details', $product->id)}}" style="font-size: 13px; margin: 0%">{{$product->product_name}}</a>
                                            <p class="price"
                                                style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                                <del style="font-size: 10px">{{$product->sale_price + 20000}}</del>
                                                {{ number_format($product->sale_price, 0, ',', ' ') }} vnđ/m2
                                            </p>
                                            <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span><small style="font-size: 10px; color: #333333"> 12 đánh
                                                        giá</small></span>
                                            </p>
                                            <a href="{{route('client.product_details', $product->id)}}" style="font-size: 12px"
                                                class="btn btn-default col-2">Xem</a>
                                            {{-- <a href="shop-basket.html" style="font-size: 12px"
                                                class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a> --}}
                                        </div>
                                        <div class="ribbon-holder">
                                            <div class="ribbon hot" style="text-align: left;width: 40px;"><small
                                                    style="margin-left: 5px">HOT</small></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col" style="width: 10px; padding: 0 0 0 0">
                            <a class="btn-floating btn-sm" href="#carousel-example-multi-2" data-slide="next" style="margin-top: 175px">
                                <i class="fa fa-3x fa-chevron-right"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col" style="width: 5%"></div>

            <!-- Carousel End-->
        </div>

        {{-- <br>
        <div class="col-12 row">
            <div  style="width: 10%"></div>
            <div class="col-10 card" style="padding: 10px 10px 10px 10px">
                <div class="row">
                    <div class="heading text-left col-6">
                        <h3 style="margin-left: 5%; font-family: cursive">Thiết bị vệ sinh</h3>
                    </div>
                    <div class="col-6 heading text-right">
                        <a href=""><h6>Xem tất cả >></h6></a>
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
                        <a class="btn-floating btn-sm" href="#carousel-example-multi-2" data-slide="prev" style="margin-top: 175px">
                            <i class="fa fa-3x fa-chevron-left"></i>
                        </a>
                        </div>
                        <div class="col-11" style="padding: 0 0 0 0">
                            <div class="carousel-inner" role="listbox">

                                <div class="carousel-item active mx-auto">
                                    <div class="product" style="width: 21% ;background-color: white; margin-left: 20px">
                                        <div class="image">
                                            <a href="shop-detail.html">
                                                <img src="images/products/product1.jpg" alt=""
                                                    style="object-fit: cover; height: 160px; width: 100%"
                                                    class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text" style="margin: 0px">
                                            <a href="shop-detail.html" style="font-size: 13px; margin: 0%">Gạch lát nền
                                                Đông tâm ALI-001</a>
                                            <p class="price"
                                                style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                                <del style="font-size: 10px">280 000 vnđ</del>
                                                250 000 vnđ/m2
                                            </p>
                                            <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span><small style="font-size: 10px; color: #333333"> 12 đánh
                                                        giá</small></span>
                                            </p>
                                            <a href="shop-detail.html" style="font-size: 12px"
                                                class="btn btn-default col-2">Xem</a>
                                            <a href="shop-basket.html" style="font-size: 12px"
                                                class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a>
                                        </div>
                                        <div class="ribbon-holder">
                                            <div class="ribbon new" style="text-align: left;width: 40px;"><small
                                                    style="margin-left: 5px">NEW</small></div>
                                        </div>
                                    </div>
                                </div>
                                @for ($i = 1; $i < 7; $i++)
                                    <div class="carousel-item">
                                        <div class="product" style="width: 21% ;background-color: white; margin-left: 20px">
                                            <div class="image">
                                                <a href="shop-detail.html">
                                                    <img src="images/products/product{{$i}}.jpg" alt=""
                                                        style="object-fit: cover; height: 160px; width: 100%"
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="text" style="margin: 0px">
                                                <a href="shop-detail.html" style="font-size: 13px; margin: 0%">Gạch lát nền
                                                    Đông tâm ALI-001</a>
                                                <p class="price"
                                                    style="color: red;font-size: 13px; text-align: center;margin: 0%;padding: 0% ">
                                                    <del style="font-size: 10px">280 000 vnđ</del>
                                                    250 000 vnđ/m2
                                                </p>
                                                <p style="margin-top: 0%; color: #FF9900; padding: 0%; margin: 0%">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span><small style="font-size: 10px; color: #333333"> 12 đánh
                                                            giá</small></span>
                                                </p>
                                                <a href="shop-detail.html" style="font-size: 12px"
                                                    class="btn btn-default col-2">Xem</a>
                                                <a href="shop-basket.html" style="font-size: 12px"
                                                    class="btn btn-success"><i class="fa fa-shopping-cart"></i>Thêm</a>
                                            </div>
                                            <div class="ribbon-holder">
                                                <div class="ribbon new" style="text-align: left;width: 40px;"><small
                                                        style="margin-left: 5px">NEW</small></div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                        </div>
                        </div>
                        <div class="col" style="width: 10px; padding: 0 0 0 0">
                            <a class="btn-floating btn-sm" href="#carousel-example-multi-2" data-slide="next" style="margin-top: 175px">
                                <i class="fa fa-3x fa-chevron-right"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col" style="width: 5%"></div> --}}

            <!-- Carousel End-->
        {{-- </div> --}}
    </section>
@endsection
@section('script')
    <script>
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

    </script>
@endsection
