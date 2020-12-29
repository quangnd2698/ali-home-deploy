@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')
    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20" >
            <div class="row">
                <div class="col-3">
                    <a href=" {{ route('products.create') }}">
                        <button type="button" class="btn btn-success">
                            Thêm
                            <span class="icon-copy ti-plus"></span>
                        </button>
                    </a>
                    <button type="button" id="delete_more" class="btn btn-danger" data-toggle="modal"
                        data-target="#warning-modal">
                        Xóa
                        <span class="icon-copy fa fa-minus"></span>
                    </button>
                </div>
                <div class="col-md-6" style="text-align: center">
                    <h3 class="text-blue h4" style="color: black; font-size: 24px">Danh Sách Sản Phẩm</h3>
                </div>
                <div class="col-3">

                </div>
            </div>
        </div>
        <div class="pb-20">
            <div style="background-color: royalblue">
                <table class="checkbox-datatable table nowrap table-bordered" style="width: 100%;">
                    <thead style="background-color: #FFFFCC">
                        <tr>
                            <th>
                                <div class="dt-checkbox">
                                    <input type="checkbox" name="select_all" value="1" id="example-select-all">
                                    <span class="dt-checkbox-label"></span>
                                </div>
                            </th>
                            <th>Mã Sản Phẩm</th>
                            {{-- <th>Hãng</th> --}}
                            <th>Tên sản phẩm</th>
                            {{-- <th>Loại sản phẩm</th> --}}
                            <th>Giá Vốn</th>
                            <th>Giá Bán</th>
                            <th>Tồn Kho</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>
                                    <div class="dt-checkbox"><input type="checkbox" name="checkbox-{{ $product->id }}"
                                        value=""><span class="dt-checkbox-label"></span></div>
                                </td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_name }} </td>
                                <td>{{ number_format($product->import_price, 0, ',', ' ') }}</td>
                                <td>{{ number_format($product->sale_price, 0, ',', ' ') }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td style="width: 50px;">
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                            role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" data-toggle="modal"
                                                data-target="#bd-example-modal-lg-{{ $product->id }}" href="#"><i
                                                    class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"><i
                                                    class="dw dw-edit2"></i> Edit </a>
                                            <button class="dropdown-item" data-toggle="modal"
                                                data-target="#confirmation-modal-{{ $product->id }}"><i
                                                    class="dw dw-delete-3"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src="vendors/images/img3.jpg"
                                                            alt="First slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="vendors/images/img4.jpg"
                                                            alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="vendors/images/img5.jpg"
                                                            alt="Third slide">
                                                    </div>
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
                                                <div class="col">
                                                    <img class="d-block w-100" src="vendors/images/img3.jpg"
                                                        alt="First slide">
                                                </div>
                                                <div class="col">
                                                    <img class="d-block w-100" src="vendors/images/img4.jpg"
                                                        alt="Second slide">
                                                </div>
                                                <div class="col">
                                                    <img class="d-block w-100" src="vendors/images/img5.jpg"
                                                        alt="Third slide">
                                                </div>
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
                                                    {{ number_format($product->count_buy, 0, ',', ' ') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
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
                                        </div>

                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="col-sm-12 text-secondary">

                                                    <div class="col-xl-12">
                                                        <div class="progress-box text-center">
                                                            <input type="text" class="knob dial5"
                                                                value="{{ 100 - ROUND(($product->inventory / $product->quantity) * 100, 2) }}"
                                                                data-width="70" data-height="70" data-thickness="0.2"
                                                                data-fgColor="#1b00ff" data-skin="tron"
                                                                data-angleOffset="180" readonly>
                                                        </div>
                                                    </div>
                                                    <h6 style="width: 100%; text-align: center" class="mb-0">Tỉ Lệ Tồn kho
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="col-sm-12 text-secondary">

                                                    <div class="col-xl-12">
                                                        <div class="progress-box text-center" style="height: 75px">
                                                            <br>
                                                            <h4 class="">4.5</h4>
                                                        </div>
                                                    </div>
                                                    <h6 style="width: 100%; text-align: center" class="mb-0">Đánh giá</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Lợi nhuận tháng này</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <h6 class="mb-15 text-danger h6">
                                                        {{ number_format($product->monthly_profit, 0, '.', ',') }} VNĐ</h6>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Lợi nhuận Quý này</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <h6 class="mb-15 text-danger h6">
                                                        {{ number_format($product->quarterly_profit, 0, '.', ',') }} VNĐ</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);">
                            <i class="icon-copy fa fa-lock" aria-hidden="true"></i> Ngừng kinh doanh
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmation-modal-{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to continue delete</h4>
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
                        {{-- <form action="{{ route('products.delete_more') }}" method="POST">
                            @csrf
                            <div class="col-6">
                                <input type="text" name="checkbox_selected" style="display: none">
                                <button type="submit"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                YES
                            </div>
                        </form> --}}
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
    {{-- <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script> --}}
    <script>
        $('#delete_more').click(function() {
            var data = ''
            $('input[type = "checkbox"]').each(function(value) {
                if ($(this).is(':checked')) {
                    data += ',';
                    data += value;
                }
            });
            data = data.substring(1);
            $('input[name = "checkbox_selected"]').val(data);
        });

    </script>
@endsection
