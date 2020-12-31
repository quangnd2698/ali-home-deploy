<div class="top-bar">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-5 d-md-block d-none">
                <p>liên hệ đến 097 6464 794 or alihomeht@gmail.com.</p>
            </div>
            <div class="col-md-7">
                <div class="d-flex justify-content-md-end justify-content-between">
                    <ul class="list-inline contact-info d-block d-md-none">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                    @if (Auth::guard('web')->check())
                        <div class="login"><a href="{{ route('users.profile', Auth::guard('web')->id()) }}"
                                class="login-btn">
                                <i class="fa fa-user"></i>{{ Auth::guard('web')->user()->name }}<span
                                    class="d-none d-md-inline-block"></span></a>
                            <a href="{{ route('users.logout') }}" class="signup-btn"><i class="fa fa-user"></i><span
                                    class="d-none d-md-inline-block">Đăng xuất</span></a>
                        </div>
                    @else
                        <div class="login"><a href="user_login" class="login-btn"><i class="fa fa-sign-in"></i><span
                                    class="d-none d-md-inline-block">Sign In</span></a>
                            <a href="sign_up" class="signup-btn"><i class="fa fa-user"></i><span
                                    class="d-none d-md-inline-block">Sign Up</span></a>
                        </div>
                    @endif

                    {{-- <ul class="social-custom list-inline">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li> --}}
                        {{-- <li class="list-inline-item"><a href="#"><i
                                    class="fa fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                        --}}
                    {{-- </ul> --}}
                    {{-- <ul class="list-inline contact-info d-block d-md-none">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-2x fa-cart-plus"></i></a></li>
                    </ul> --}}

                    <div style="margin-left: 10px; margin-top: -2px">
                        <a href="{{ route('client.carts') }}">
                            <button type="button" class="btn btn-outline-warning" style="padding: 4px">
                                <i style="font-size: 15px" class="fa fa-cart-plus"></i> Giỏ hàng
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top bar end-->
<!-- Login Modal-->
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true"
    class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="login-modalLabel" class="modal-title">Đăng nhập</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.sign_in') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input id="email_modal" type="text" placeholder="phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="password_modal" type="password" name="password" placeholder="password"
                            class="form-control">
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log
                            in</button>
                    </p>
                </form>
                {{-- <p class="text-center text-muted">Not registered yet?</p>
                --}}
                {{-- <p class="text-center text-muted"><a
                        href="customer-register.html"><strong>Register
                            now</strong></p> --}}
            </div>
        </div>
    </div>
</div>

<header class="nav-holder make-sticky" >
    <div id="navbar" role="navigation" class="navbar navbar-expand-lg" style="background: linear-gradient(to left, #EEC900, #FFFFFF)">
        <div class="container">
            <a href="{{route('client.home')}}" class="navbar-brand home"><img src="vendors/images/ali-logo.png" style="object-fit: cover; height: 50px;"
                    alt="Universal logo" class="d-none d-md-inline-block"><img src="vendors/images/ali-logo.png"
                    style="object-fit: cover; height: 50px;" alt="Universal logo" class="d-inline-block d-md-none"><span class="sr-only"></span></a>
            <div id="search" class=" clearfix navbar-collapse collapse" style="margin-top: 15px; height: 55px;width: 400px;">
                <div class="flex-center position-ref full-height col-10" style="width: 350px">
                    <div class="content col-12" style="width: 350px">
                        <form class=" col-12" role="search" style="width: 350px;">
                            <input type="search" style="width: 350px;" name="q"
                                class="form-control search-input col-12"
                                placeholder="Tìm kiếm theo tên, mã sản phẩm" autocomplete="off">
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" data-toggle="collapse" data-target="#navigation"
                class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i
                    class="fa fa-align-justify"></i></button>
            <div id="navigation" class="navbar-collapse collapse" style="height: 55px">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a href="{{route('client.home')}}"
                            class="dropdown-toggle">Home <b class="caret"></b></a>
                    </li>
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown"
                        class="dropdown-toggle">Sản phẩm<b class="caret"></b></a>
                    <ol class="dropdown-menu megamenu btn-list" style="max-width: 700px;">
                        <li>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <a href="{{ route('client.products', 'ceramic?type=all') }}">
                                        <h5>Gạch mem</h5>
                                    </a>
                                    <ul class="list-unstyled mb-3">
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'ceramic?type=gach-lat') }}"
                                                class="nav-link">Gạch lát nền</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'ceramic?type=gach-op') }}"
                                                class="nav-link">Gạch ốp tường</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'ceramic?type=gach-bong') }}"
                                                class="nav-link">Gạch bông</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'ceramic?type=gach-trang-tri') }}"
                                                class="nav-link">Gạch trang trí</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'ceramic?type=gach-via-he') }}"
                                                class="nav-link">Gạch vỉa hè</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'ceramic?type=gach-gia-go') }}"
                                                class="nav-link">Gạch giả gỗ</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <a href="{{ route('client.products', 'TBVS?type=all') }}">
                                        <h5>Thiết bị vệ sinh</h5>
                                    </a>
                                    <ul class="list-unstyled mb-3">
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'TBVS?type=bon-cau') }}"
                                                class="nav-link">Bồn cầu</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'TBVS?type=PKNT') }}"
                                                class="nav-link">Phụ kiện nhà tắm</a></li>
                                        <li class="nav-item"><a
                                                href="{{ route('client.products', 'TBVS?type=TBNL') }}"
                                                class="nav-link">Thiết bị nóng lạnh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ol>
                </li>
                <li class="nav-item dropdown menu-large"><a href="{{ route('users.promotion') }}">Khuyến Mãi</a>
                </li>
                <!-- ========== FULL WIDTH MEGAMENU ==================-->
                <li class="nav-item dropdown menu-large"><a href="{{ route('users.contact.index') }}">Liên
                        hệ</a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</header>
