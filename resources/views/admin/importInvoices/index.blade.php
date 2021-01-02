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
                    <li class="breadcrumb-item active" aria-current="page">Phiếu nhập kho</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 text-right row">
            {{-- @can('isAdmin') --}}
            <a href=" {{route('importInvoices.create') }}" class="btn btn-success col-2" style="margin-right: 15px">
                <span class="icon-copy ti-plus"></span>
                Thêm
            </a>
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
            {{-- @endcan --}}
        </div>
    </div>
</div>
<div class="pd-20 card-box mb-30">
    <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
        <thead style="background-color: #FFCC33">
            <tr>
                <th>
                    {{-- <div class="dt-checkbox">
                        <input type="checkbox" name="select_all" value="1" id="example-select-all">
                        <span class="dt-checkbox-label"></span>
                    </div> --}}
                </th>
                <th>Mã phiếu</th>
                <th>Nhân viên</th>
                <th>Tổng tiền</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            @foreach ($importInvoices as $key => $importInvoice)
                <tr>
                    <td>
                        {{-- <div class="dt-checkbox"><input type="checkbox" name="checkbox-{{ $importInvoice->id }}"
                            value=""><span class="dt-checkbox-label"></span></div> --}}
                    </td>
                    <td>{{ $importInvoice->invoice_code }}</td>
                    <td>{{ $importInvoice->staff_make }}</td>
                    <td>{{ $importInvoice->total_cost }}</td>
                    <td></td>
                    <td>{{ $importInvoice->created_at }}</td>
                    <td style="font-size: 16px; width: 100px;" class="row">
                        <div class="col-4"><a data-toggle="modal"  style="padding: 0px 5px 0px 5px" class="btn btn-primary"
                            data-target="#bd-example-modal-lg-{{ $importInvoice->id }}" href="#">
                            <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                        </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('importInvoices.edit', $importInvoice->id) }}" class="btn btn-success"
                                style="padding: 0px 5px 0px 5px">
                                <i class="icon-copy fa fa-edit" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a data-toggle="modal" style="padding: 0px 5px 0px 5px" class="btn btn-danger" data-target="#confirmation-modal-{{ $importInvoice->id }}"><i
                                    class="dw dw-delete-3"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@foreach ($importInvoices as $importInvoice)
{{-- delete modal --}}
    <div class="modal fade" id="confirmation-modal-{{ $importInvoice->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form action="{{ route('importInvoices.destroy', $importInvoice->id) }}" method="POST">
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
    <div class="modal fade bs-example-modal-xl" id="bd-example-modal-lg-{{$importInvoice->id}}" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body row">
                    <div class="col-12" style="text-align: center">
                        <h2 style="font-family: 'Times New Roman', Times, serif">PHIẾU NHẬP KHO</h2>
                        <br>
                        <h6 style="font-style: oblique;">Ngày {{$importInvoice->created_at->day}} tháng {{$importInvoice->created_at->month}} năm {{$importInvoice->created_at->year}}</h6>
                        <h6 style="text-align: right; margin-right: 15%">Số...0000{{$importInvoice->id}}...</h6>
                    </div>
                    <br>
                    <div class="col-12">
                        <h6 style="margin-left: 5%">- Nhà cung cấp: {{$importInvoice->unit_of_delivery}}</h6>
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
                                @foreach ($importInvoice->importInvoiceDetail as $key => $detail)
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
                                <th colspan="6">Tổng cộng</th>
                                <th colspan="2">{{ number_format($importInvoice->total_cost, 0, ',', ',')}} VNĐ</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row col-12">
                        <div class="col-4" style="text-align: center">
                            <h6>Thủ kho</h6>
                            <small>(ký, họ tên)</small>
                            <p>{{$importInvoice->staff_make}}</p>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4" style="text-align: center">
                            <h6>Người giao</h6>
                            <small>(ký, họ tên)</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                            <form action="{{ route('importInvoices.delete_more') }}" method="POST">
                                @csrf
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

    </script>
@endsection
