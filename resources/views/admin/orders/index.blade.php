@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 text-right row">
            @can('isAdmin')
                {{-- <button type="button" class="btn btn-primary col-2" style="margin-right: 15px" id="text">
                    <i class="icon-copy fi-upload"></i>
                    Import
                </button>
                <button type="button" class="btn btn-outline-info col-3" style="margin-right: 15px">
                    <i class="icon-copy fi-download"></i>
                    Xuất file
                </button>
                <button type="button" id="delete_more" class="btn btn-danger col-3" data-toggle="modal"
                    data-target="#warning-modal">
                    <span class="icon-copy fa fa-minus "></span>
                    Xóa nhiều
                </button> --}}
            @endcan
        </div>
    </div>
</div>
<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-blue h4" style="color: red">Đơn hàng chưa xác nhận</h4>
        </div>
    </div>
    <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
        <thead style="background-color: #FFCC33">
            {{-- <thead style="background-color: #FFFFCC"> --}}
                <tr>
                    {{-- <th> --}}
                        {{-- <div class="dt-checkbox">
                            <input type="checkbox" name="select_all" value="1" id="example-select-all">
                            <span class="dt-checkbox-label"></span>
                        </div> --}}
                    {{-- </th> --}}
                    <th>id</th>
                    <th>Tên khách hàng</th>
                    {{-- <th>Địa chỉ</th> --}}
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>số tiền</th>
                    <th>Ngày mua</th>
                    <th style="width: 100px">action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($orders as $key => $order)
                    @if ($order->order_status == 1)
                    <tr>
                        {{-- <td>
                            <div class="dt-checkbox"><input type="checkbox" name="checkbox-{{$order->id}}" value=""><span class="dt-checkbox-label"></span></div>
                        </td> --}}
                        <td style="font-size: 15px" >{{ $order->id }}</td>
                        <td style="font-size: 15px">{{ $order->customer_name }}</td>
                        {{-- <td style="font-size: 15px">{{ $order->customer_address}}</td> --}}
                        <td style="font-size: 15px">{{ $order->customer_phone }}</td>
                        <td style="font-size: 15px">
                        <button type="button" class="btn btn-secondary">Chờ xác nhận</button>
                        </td>
                        <td style="font-size: 15px">{{ $order->cost }}</td>
                        <td style="font-size: 15px">{{ $order->created_at}}</td>
                        <td style="font-size: 16px; width: 100px;" class="row">
                            <div class="col-5"><a data-toggle="modal"  style="padding: 0px 5px 0px 5px" class="btn btn-primary"
                                data-target="#bd-example-modal-lg-{{ $order->id }}" href="#">
                                <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                            </a>
                            </div>
                            <div class="col-5">
                                <a data-toggle="modal" style="padding: 0px 5px 0px 5px" class="btn btn-danger" data-target="#confirmation-modal-{{ $order->id }}"><i
                                        class="dw dw-delete-3"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
            </tbody>
    </table>
</div>
{{-- đã xác nhân --}}
<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-yeallow h4">Đã xác nhận</h4>
        </div>
    </div>
    <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
        <thead style="background-color: #FFCC33">
            {{-- <thead style="background-color: #FFFFCC"> --}}
                <tr>
                    {{-- <th>
                        <div class="dt-checkbox">
                            <input type="checkbox" name="select_all" value="1" id="example-select-all">
                            <span class="dt-checkbox-label"></span>
                        </div>
                    </th> --}}
                    <th>id</th>
                    <th>Tên khách hàng</th>
                    {{-- <th>Địa chỉ</th> --}}
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>số tiền</th>
                    <th>Ngày mua</th>
                    <th style="width: 100px">action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($orders as $key => $order)
                    @if ($order->order_status == 2)
                    <tr>
                        {{-- <td><div class="dt-checkbox"><input type="checkbox" name="checkbox-{{$order->id}}" value=""><span class="dt-checkbox-label"></span></div></td> --}}
                        <td style="font-size: 15px" >{{ $order->id }}</td>
                        <td style="font-size: 15px">{{ $order->customer_name }}</td>
                        {{-- <td style="font-size: 15px">{{ $order->customer_address}}</td> --}}
                        <td style="font-size: 15px">{{ $order->customer_phone }}</td>
                        <td style="font-size: 15px">
                            <button type="button" class="btn btn-warning">Đã xác nhận</button>
                        </td>
                        <td style="font-size: 15px">{{ $order->cost }}</td>
                        <td style="font-size: 15px">{{ $order->created_at}}</td>
                        <td style="font-size: 16px; width: 100px;" class="row">
                            <div class="col-5"><a data-toggle="modal"  style="padding: 0px 5px 0px 5px" class="btn btn-primary"
                                data-target="#bd-example-modal-lg-{{ $order->id }}" href="#">
                                <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                            </a>
                            </div>
                            <div class="col-5">
                                <a data-toggle="modal" style="padding: 0px 5px 0px 5px" class="btn btn-danger" data-target="#confirmation-modal-{{ $order->id }}"><i
                                        class="dw dw-delete-3"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
            </tbody>
    </table>
</div>

{{-- đang giao --}}

<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-blue h4">Đơn hàng đang giao</h4>
        </div>
    </div>
    <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
        <thead style="background-color: #FFCC33">
            {{-- <thead style="background-color: #FFFFCC"> --}}
                <tr>
                    {{-- <th>
                        <div class="dt-checkbox">
                            <input type="checkbox" name="select_all" value="1" id="example-select-all">
                            <span class="dt-checkbox-label"></span>
                        </div>
                    </th> --}}
                    <th>id</th>
                    <th>Tên khách hàng</th>
                    {{-- <th>Địa chỉ</th> --}}
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>số tiền</th>
                    <th>Ngày mua</th>
                    <th style="width: 100px">action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($orders as $key => $order)
                    @if ($order->order_status == 3)
                    <tr>
                        {{-- <td><div class="dt-checkbox"><input type="checkbox" name="checkbox-{{$order->id}}" value=""><span class="dt-checkbox-label"></span></div></td> --}}
                        <td style="font-size: 15px" >{{ $order->id }}</td>
                        <td style="font-size: 15px">{{ $order->customer_name }}</td>
                        {{-- <td style="font-size: 15px">{{ $order->customer_address}}</td> --}}
                        <td style="font-size: 15px">{{ $order->customer_phone }}</td>
                        <td style="font-size: 15px">
                        <button type="button" class="btn btn-primary">Đang giao hàng</button>
                        </td>
                        <td style="font-size: 15px">{{ $order->cost }}</td>
                        <td style="font-size: 15px">{{ $order->created_at}}</td>
                        <td style="font-size: 16px; width: 100px;" class="row">
                            <div class="col-5"><a data-toggle="modal"  style="padding: 0px 5px 0px 5px" class="btn btn-primary"
                                data-target="#bd-example-modal-lg-{{ $order->id }}" href="#">
                                <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                            </a>
                            </div>
                            <div class="col-5">
                                <a data-toggle="modal" style="padding: 0px 5px 0px 5px" class="btn btn-danger" data-target="#confirmation-modal-{{ $order->id }}"><i
                                        class="dw dw-delete-3"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
            </tbody>
    </table>
</div>
@endsection
@foreach ($orders as $order)
{{-- delete modal --}}
    <div class="modal fade" id="confirmation-modal-{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
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

    {{-- show modal --}}
    <div class="modal fade bs-example-modal-xl" id="bd-example-modal-lg-{{$order->id}}" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body row">
                    <div class="col-12" style="text-align: center">
                        <h2 style="font-family: 'Times New Roman', Times, serif">Đơn hàng</h2>
                        <br>
                        <h6 style="font-style: oblique;">Ngày {{$order->created_at->day}} tháng {{$order->created_at->month}} năm {{$order->created_at->year}}</h6>
                        <h6 style="text-align: right; margin-right: 15%">Số...0000{{$order->id}}...</h6>
                    </div>
                    <br>
                    <div class="col-12">
                        <h6 style="margin-left: 5%">khách hàng: {{$order->customer_name}}</h6>
                        <br>
                        <h6 style="margin-left: 5%">Số điện thoại: {{$order->customer_phone}}</h6>
                        <br>
                        <h6 style="margin-left: 5%">Địa chỉ: {{$order->customer_address}}</h6>
                        <br>
                        <table class="table table-bordered ">
                            <thead>
                                <th>stt</th>
                                <th>Tên sản phẩm</th>
                                <th>Mã sản phẩm</th>
                                <th>Đơn vị</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetail as $key => $detail)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ $detail->product_name }}</td>
                                        <td>{{ $detail->product_code }}</td>
                                        <td>{{ $detail->unit }}</td>
                                        <td>{{ $detail->quantity_product }}</td>
                                        <td>{{ number_format($detail->price_product, 0, ',', ',') }}</td>
                                        <td>{{ number_format($detail->total_price, 0, ',', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6"></th>
                                    <th colspan="2">{{ number_format($order->total_prices, 0, ',', ',')}} VNĐ</th>
                                </tr>
                                <tr><th colspan="3"></th>
                                    <th colspan="3">Điểm sử dụng</th>
                                    <th colspan="2">{{ number_format($order->point_used, 0, ',', ',')}} </th>
                                </tr>
                                <tr><th colspan="3"></th>
                                    <th colspan="3">Ưu đãi thành viên</th>
                                    <th colspan="2">{{ number_format($order->copreferentialst, 0, ',', ',')}}</th>
                                </tr>
                                <tr>
                                    <th colspan="6">Tổng cộng</th>
                                    <th colspan="2">{{ number_format($order->cost, 0, ',', ',')}} VNĐ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{-- <div class="row col-12">
                        <div class="col-4" style="text-align: center">
                            <h6>Thủ bán</h6>
                            <small>(ký, họ tên)</small>
                            <p>{{$order->staff_sale}}</p>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4" style="text-align: center">
                            <h6>Khách hàng</h6>
                            <small>(ký, họ tên)</small>
                            <p>{{$order->customer_name}}</p>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    @if ($order->order_status == 1)
                    <button onclick="changeOrderStatus({{$order->id}}, 1)" type="button" class="btn btn-outline-info">Đã xác nhận</button>
                    @elseif ($order->order_status == 2) 
                    <button onclick="changeOrderStatus({{$order->id}}, 2)" type="button" class="btn btn-outline-primary">Đang giao</button>
                    @elseif ($order->order_status == 3) 
                        <button onclick="changeOrderStatus({{$order->id}}, 3)" type="button" class="btn btn-outline-success">Hoàn thành</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach


@section('script')
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <script src="vendors/scripts/datatable-setting.js"></script>
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
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
            alert(data);
            $('input[name = "checkbox_selected"]').val(data);
        });

        function changeOrderStatus(id, status) {
            var request = $.ajax({
                url: "ajax/changeOrderStatus",
                method: "GET",
                data: {
                    id : id,
                    status : status
                },
                dataType: "html"
            });

            request.done(function( data ) {
                location.reload()
            });
            
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
        }

    </script>
@endsection
