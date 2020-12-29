@extends('client.index')
@section('content')

    <div id="heading-breadcrumbs" style="height: 50px; padding: 5px">
        <div class="container" style="height: 50px">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-8">
                    <ul class="breadcrumb d-flex" style="text-align: left">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Liên hệ</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    {{-- <h1 class="h2">Shopping Cart</h1> --}}
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div id="contact" class="container">
            <section class="bar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>Chúng tôi ở đây để giúp bạn</h2>
                        </div>
                        <p class="text-sm">Xin vui lòng liên hệ với chúng tôi, trung tâm dịch vụ khách hàng của chúng tôi
                            đang làm việc cho bạn
                            24/7.</p>
                    </div>
                </div>
            </section>
            <section>
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="box-simple">
                            <div class="icon-outlined"><i class="fa fa-map-marker"></i></div>
                            <h3 class="h4">Địa chỉ</h3>
                            <p>Cẩm Thịnh - Cẩm Xuyên - Hà Tĩnh</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-simple">
                            <div class="icon-outlined"><i class="fa fa-phone"></i></div>
                            <h3 class="h4">Liên hệ Qua số điện thoại</h3>
                            {{-- <p>This number is toll free if calling from Great Britain
                                otherwise we advise you to use the
                                electronic form of communication.</p> --}}
                            <p><strong>097 6464 794</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-simple">
                            <div class="icon-outlined"><i class="fa fa-envelope"></i></div>
                            <h3 class="h4">Thư điện tử</h3>
                            {{-- <p>Please feel free to write an email to us or to use our
                                electronic ticketing system.</p> --}}
                            <ul class="list-unstyled text-sm">
                                <li><strong><a href="mailto:">alihomeht@gmail.com</a></strong></li>
                                {{-- <li><strong><a href="#">Ticketio</a></strong> - our
                                    ticketing support platform</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bar pt-0">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    {{-- @foreach ($errors->all() as $error) --}}
                                        <li>{{ $errors->first() }}</li>
                                    {{-- @endforeach --}}
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8 mx-auto">
                        <form method="POST" action="{{ route('users.contact') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">Tên</label>
                                        <input name="name" id="lastname" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" id="email" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="subject">Tiêu đề</label>
                                        <input name="title" id="subject" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message">Tin nhắn</label>
                                        <textarea name="message" id="message" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-template-outlined"><i class="fa fa-envelope-o"></i>
                                        Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('script')

    <script>
    </script>
@endsection
