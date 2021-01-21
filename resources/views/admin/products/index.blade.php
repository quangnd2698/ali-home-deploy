@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-right row">
            @can('isAdmin')
                {{-- <button type="button" class="btn btn-primary col-2" style="margin-right: 15px" id="text">
                    <i class="icon-copy fi-upload"></i>
                    Import
                </button>
                <button type="button" class="btn btn-outline-info col-3" style="margin-right: 15px">
                    <i class="icon-copy fi-download"></i>
                    Xuất file
                </button> --}}
                <a href=" {{route('products.create') }}" class="btn btn-success col-5" style="margin-right: 15px">
                    {{-- <button type="button" class="btn btn-success col-12"> --}}
                        <span class="icon-copy ti-plus"></span>
                        Thêm
                    {{-- </button> --}}
                </a>
                <button type="button" id="delete_more" class="btn btn-danger col-6" data-toggle="modal"
                    data-target="#warning-modal">
                    <span class="icon-copy fa fa-minus "></span>
                    Xóa nhiều
                </button>
            @endcan
        </div>
    </div>
</div>

    <div class="row">

        <div class="col-12 card-box" 
        {{-- style="overflow-y: auto; height: 750px" --}}
        >
            <br>
            <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
                <thead style="background-color: #FFCC33">
                    <tr>
                        <th>
                            <div class="">
                                <input class="dt-checkbox" type="checkbox" name="select_all" value="1" id="example-select-all">
                                <span class="dt-checkbox-label"></span>
                            </div>
                        </th>
                        <th></th>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá Bán</th>
                        <th>Tồn Kho</th>
                        <th>Trạng thái</th>
                        <th style="width: 100px;">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>
                                <div><input class="dt-checkbox" type="checkbox" name="checkbox-{{ $product->id }}"
                                value="{{ $product->id }}"><span class="dt-checkbox-label"></span></div>
                            </td>
                            <td style="padding: 0px"><img style="width: 50px; height: 50px;" @if($product->images->first()) src="images/products/{{$product->images->first()->name}}" @else src="images/products/product.jpg" @endif alt=""></td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->product_name }} </td>
                            <td>{{ number_format($product->sale_price, 0, ',', ' ') }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td id="status-{{$product->id}}">{{ $product->status }}</td>
                            <td class="row" style="width: 100px;">
                                <div class="col-4">
                                    <a  data-toggle="modal" class="btn btn-primary" style="padding: 0px 5px 0px 5px"
                                        data-target="#bd-example-modal-lg-{{ $product->id }}" href="#">
                                        {{-- <button class="btn btn-primary col-1" type="button"> --}}
                                            <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                        {{-- </button> --}}
                                    </a>
                                </div>
                                @cannot('isMarketing')
                                    <div class="col-4">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success"
                                            style="padding: 0px 5px 0px 5px">
                                            <i class="icon-copy fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a data-toggle="modal" data-target="#confirmation-modal-{{ $product->id }}"
                                            style="padding: 0px 5px 0px 5px" class="btn btn-danger">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                @endcan
                            </td class="row" style="width: 100px;">
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="col-2 row" >
            <div class="col-12" style="position: fixed">
                <div class="col-12" >
                    <div class="card-box" style="width: 13%;">
                        <br>
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-12 col-sm-12">
                                <label class="weight-600">Loại hàng</label>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio1" name="product_type" class="custom-control-input"
                                        checked>
                                    <label class="custom-control-label" for="customRadio1">Tất cả</label>
                                </div>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio2" name="product_type" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Gạch men</label>
                                </div>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio3" name="product_type" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Thiết bị vệ sinh</label>
                                </div>
                                <a href=""><i class="icon-copy fa fa-plus" aria-hidden="true"
                                        style="margin-left: 8px; font-size: 15px"> Thêm danh muc</i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-box" style="width: 13%;">
                        <br>
                        <div class="col-md-12 col-sm-12">
                            <label class="weight-600">Trạng thái</label>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                <label class="custom-control-label" for="customCheck1">Đang Kinh doanh</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Hết hàng</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Ngừng kinh doanh</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-box" style="width: 13%;">
                        <br>
                        <div class="col-md-12 col-sm-12">
                            <label class="weight-600">Kênh bán</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="changeAll" name="customRadio" checked class="custom-control-input">
                                <label class="custom-control-label" for="changeAll">Tất cả</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="change1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="change1">Trực tiếp</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="change2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="change2">Website</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}
    </div>


    {{-- modal --}}
    @foreach ($products as $product)
        <div class="modal fade bs-example-modal-xl" id="bd-example-modal-lg-{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="text-align: center">
                        <h4 class="modal-title" id="myLargeModalLabel" style="margin-left: 40%">Thông Tin Sản Phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row gutters-sm">
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-4 ">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="0"
                                                        class="active"></li>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                                </ol>
                                                <div class="carousel-inner">

                                                    @if (!$product->images->first())
                                                    <div class="carousel-item active">
                                                        <img style="height: 200px;" class="d-block w-100" src="images/products/no-image.jpg"
                                                            alt="0-slide">
                                                    </div>
                                                    @else
                                                        @foreach ($product->images as $key => $image)
                                                        <div class="carousel-item @if ($key == 0) {{'active'}} @endif">
                                                            <img style="height: 200px;" class="d-block w-100" src="images/products/{{$image->name}}"
                                                                alt="{{$key}}-slide">
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                    
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                    role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                    role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <div class="mt-3 row">
                                                @if ($product->images->first() == null)
                                                    <div class="col-3">
                                                        <img style="height: 55px" class="d-block w-100" style="max-width: 50px;" src="images/products/no-image.jpg" alt="0-slide">
                                                    </div>
                                                    @else
                                                        @foreach ($product->images as $key => $image)
                                                        <div class="col-3">
                                                        <img style="height: 55px" class="d-block w-100" src="images/products/{{$image->name}}" alt="{{$key}}-slide">
                                                    </div>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8 row">
                                            <div class="col-7">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Tên Sản Phẩm</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->product_name }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Mã Sản phẩm</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->product_code }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Nhà Sản Xuất</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->producer }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Kích Thước</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->size }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Bề Mặt</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->surface }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Màu Sắc</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->color }}
                                                    </div>
                                                </div>
                                                {{--
                                                <hr> --}}

                                            </div>
                                            <div class="col-5">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Chức Năng</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->uses_for }}
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Số Lượng</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->quantity }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Giá Nhập</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ number_format($product->import_price, 0, ',', ' ') }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Giá Bán</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ number_format($product->sale_price, 0, ',', ' ') }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Ngày Tạo</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->created_at }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h6 class="mb-0">Ngày Sửa</h6>
                                                    </div>
                                                    <div class="col-sm-7 text-secondary">
                                                        {{ $product->updated_at }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('isAdmin')
                            <div class="col-md-12 mb-3">
                                <h4 style="width: 100%; text-align: center" class="mb-3">Thống kê</h4>
                                <div class="card">
                                    <div class="card-body col-md-12 row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Lượt Xem</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    {{ number_format($product->count_view, 0, ',', ' ') }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Lượt mua</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    {{ number_format($product->turn_buy, 0, ',', ' ') }}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-2">
                                            <div class="row">
                                                <div class="col-sm-12 text-secondary">

                                                    <div class="col-xl-12">
                                                        <div class="progress-box text-center">
                                                            <input type="text" class="knob dial5"
                                                                value="{{ ROUND(($product->number_error / $product->quantity) * 100, 2) }}"
                                                                data-width="70" data-height="70" data-thickness="0.2"
                                                                data-fgColor="#FF0000	" data-skin="tron"
                                                                data-angleOffset="180" readonly>
                                                        </div>
                                                    </div>
                                                    <h6 style="width: 100%; text-align: center" class="mb-0">Tỉ Lệ lỗi</h6>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-sm-12 text-secondary">

                                                    <div class="col-xl-12">
                                                        <div class="progress-box text-center">
                                                            <input type="text" class="knob dial5"
                                                                value=" @if ($product->count_view)
                                                                {{ 100 - ROUND(($product->turn_buy / ($product->count_view) ?? 0) * 100, 2) }}
                                                                @else
                                                                {{0}}
                                                                @endif
                                                                "
                                                                data-width="70" data-height="70" data-thickness="0.2"
                                                                data-fgColor="#1b00ff" data-skin="tron"
                                                                data-angleOffset="180" readonly>
                                                        </div>
                                                    </div>
                                                    <h6 style="width: 100%; text-align: center" class="mb-0">Tỉ Lệ Mua Hàng
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-sm-12 text-secondary">

                                                    <div class="col-xl-12">
                                                        <div class="progress-box text-center" style="height: 75px">
                                                            <br>
                                                            <h4 class="">{{$product->point}}/5</h4>
                                                            <p style="color: #FF9900; font-size: 14px; margin-bottom: 5px">
                                                                <?= $product->display_star ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 style="width: 100%; text-align: center" class="mb-0">{{$product->count_evaluate}} Đánh giá</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Doanh số tháng này</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <h6 class="mb-15 text-danger h6">
                                                        {{ number_format($product->monthly_profit, 0, '.', ',') }} VNĐ
                                                    </h6>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Doanh số Quý này</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <h6 class="mb-15 text-danger h6">
                                                        {{ number_format($product->quarterly_profit, 0, '.', ',') }} VNĐ
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                    <div class="modal-footer">
                        @cannot('isMarketing')
                        <a href="{{ route('products.edit', $product->id) }}">
                            <button type="button" class="btn" data-bgcolor="#006600" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: #FF3333;">
                                <i class="icon-copy ion-android-create"></i>
                                Sửa
                            </button>
                        </a>
                        <a data-toggle="modal" data-target="#confirmation-modal-{{ $product->id }}">
                            <button type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: #FF3333;">
                                <i class="dw dw-delete-3"></i>
                                Xóa
                            </button>
                        </a>
                        <button type="button"  id="nkd-{{$product->id}}" class="btn" onclick="changeStatusProduct({{$product->id}})" data-bgcolor="#FF6666" data-color="#ffffff"
                            style="color: rgb(255, 255, 255); background-color: #FF3333;">
                            <i class="icon-copy fa fa-lock" aria-hidden="true"></i> 
                            @if ($product->status == 'active')
                                {{'Ngừng kinh doanh'}}
                            @else
                                {{'Kinh Doanh'}}
                            @endif
                        </button>
                        @endcannot
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmation-modal-{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h4 class="padding-top-30 mb-30 weight-500">Bạn có tiếp tục xóa</h4>
                        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="fa fa-times"></i></button>
                                NO
                            </div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="col-6">
                                    <button type="submit"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                            class="fa fa-check"></i></button>
                                    YES
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="warning-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered ">
                <div class="modal-content bg-warning">
                    <div class="modal-body text-center">
                        <h3 class="mb-15"><i class="fa fa-exclamation-triangle"></i> Warning</h3>
                        <p>Bạn đang xóa nhiều mục cùng lúc, bạn có chắc chắn xóa các mục đó không</p>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="fa fa-times"></i></button>
                                NO
                            </div>
                            <form action="{{ route('products.delete_more') }}" method="POST">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <div class="col-6">
                                    <input type="text" name="checkbox_selected" style="display: none">
                                    <button type="submit"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                            class="fa fa-check"></i></button>
                                    YES
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
    <script src="vendors/scripts/knob-chart-setting.js"></script>
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <script src="vendors/scripts/datatable-setting.js"></script>

    <script>
        $('#delete_more').click(function() {
            var data = ''
            $('.dt-checkbox').each(function(value) {
                if ($(this).is(':checked')) {
                    data += ',';
                    data += $(this).val();
                }
            });
            data = data.substring(1);
            $('input[name = "checkbox_selected"]').val(data);
            // alert(data);
        });

        function changeStatusProduct(id) {
            var request = $.ajax({
                url: "ajax/changeStatus",
                method: "GET",
                data: {
                    id : id,
                },
                dataType: "html"
            });

            request.done(function( data ) {
                // alert(JSON.parse(data).status)/
                $("#nkd-"+ id).text(JSON.parse(data).result);
                
                $("#status-"+ id).text(JSON.parse(data).status);
            });
            
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
        }

        $('.filter').change(function() {
            $('#filter_form').submit();
        })

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

        $('.brand').click(function() {
            if ($(this).val() == 'all') {
                $('.brand').prop('checked', false);
                $('input[name="brand_all"]').prop('checked', true);
            } else {
                $('input[name="brand_all"]').prop('checked', false);

            }
            getData('brand');
        });
    </script>
@endsection
