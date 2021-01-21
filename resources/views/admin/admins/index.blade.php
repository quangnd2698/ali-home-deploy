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
                        <li class="breadcrumb-item active" aria-current="page">Nhân viên</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-right row">
                @can('isAdmin')
                    <a href=" {{ route('admins.create') }}" class="btn btn-success col-5" style="margin-right: 15px">
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

            <div class="col-12 card-box">
                <br>
                <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
                    <thead style="background-color: #FFCC33">
                        <tr>
                            <th>
                                <div class="dt-checkbox">
                                    <input type="checkbox" name="select_all" value="1" id="example-select-all">
                                    <span class="dt-checkbox-label"></span>
                                </div>
                            </th>
                            <th>Ảnh</th>
                            <th>email</th>
                            <th>Tên</th>
                            <th>Số Điện Thoại</th>
                            <th>Chức Vụ</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        @foreach ($admins as $key => $admin)
                            <tr>
                                <td>
                                    <div><input class="dt-checkbox" type="checkbox" name="checkbox-{{ $admin->id }}"
                                            value=""><span class="dt-checkbox-label"></span></div>
                                </td>
                                <td>
                                    <img @if (isset($admin) && $admin->image)
                                    src = "images/admins/{{ $admin->image }}"
                                    @else
                                        src = "images/admins/avatar.jpg"
                                    @endif
                                        style="width: 40px; height: 40px; margin-left: 25%" class="rounded-circle">
                                </td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->position}}</td>

                                <td style="font-size: 16px; width: 100px" class="row">
                                    <div class="col-4"><a data-toggle="modal"  style="padding: 0px 5px 0px 5px" class="btn btn-primary"
                                            data-target="#bd-example-modal-lg-{{ $admin->id }}" href="#">
                                            <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    @can('isAdmin')
                                        <div class="col-4">
                                            <a href="{{ route('admins.edit', $admin->id) }}"  style="padding: 0px 5px 0px 5px" class="btn btn-success"> 
                                                <i class="icon-copy fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    @elsecan('itMe', $admin)
                                        <div class="col-4">
                                            <a href="{{ route('admins.edit', $admin->id) }}"  style="padding: 0px 5px 0px 5px" class="btn btn-success">
                                                <i class="icon-copy fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('isAdmin')
                                    @if ($admin->permission !== 1)
                                    <div class="col-4">
                                        <a data-toggle="modal" data-target="#confirmation-modal-{{ $admin->id }}"
                                            style="padding: 0px 5px 0px 5px" class="btn btn-danger">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- </div> --}}


        {{-- modal --}}
        @foreach ($admins as $admin)
            <div class="modal fade" id="confirmation-modal-{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
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

            <div class="modal fade bs-example-modal-xl" id="bd-example-modal-lg-{{ $admin->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Thông tin cá nhân</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row gutters-sm">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img style="width: 150px; height: 150px;" @if (isset($admin) && $admin->image)
                                                src = "images/admins/{{ $admin->image }}"
                                                @else
                                                    src = "images/admins/avatar.jpg"
                                                @endif
                                                alt="Admin" class="rounded-circle" width="150">
                                                <div class="mt-3">
                                                    <h4>{{ $admin->name }}</h4>
                                                    <h6>
                                                        <span class="text-secondary mb-1">Chức vụ :</span>
                                                        <span style="color: blue"> {{$admin->position}}
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6><i class="fa fa-google-plus" style="color: red"></i> Gmail</h6>
                                                <span class="text-secondary">{{ $admin->email }}</span>
                                            </li>
                                            {{-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-facebook mr-2 icon-inline text-primary">
                                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                        </path>
                                                    </svg>Facebook</h6>
                                                <span class="text-secondary">bootdey</span>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                                        <div class="pd-20 card-box">
                                            <div class="tab">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active text-blue" data-toggle="tab" href="#profile-{{ $admin->id }}"
                                                            role="tab" aria-selected="true">Thông Tin</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-blue" data-toggle="tab" href="#contact-{{ $admin->id }}" role="tab"
                                                            aria-selected="false">Đơn hàng</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="profile-{{ $admin->id }}" role="tabpanel">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Tên</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        {{ $admin->name }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Email</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        {{ $admin->email }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Điện Thoại</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        {{ $admin->phone }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Ngày Sinh</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        {{ $admin->date_of_birth }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Địa chỉ</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        {{ $admin->address }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="contact-{{ $admin->id }}" role="tabpanel">
                                                        <div class="row gutters-sm">
                                                            <div class="col-sm-12 mb-3">
                                                                <div class="card h-100">
                                                                    <div class="card-body">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col">Mã hóa đơn</th>
                                                                                    <th scope="col">Tên Khách hàng</th>
                                                                                    <th scope="col">Giá Trị</th>
                                                                                    <th scope="col">Ngày Mua</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @if ($admin->contract_month)
                                                                                    @foreach ($admin->contract_month as $invoice)
                                                                                        <tr>
                                                                                            <td>{{ $invoice->invoice_code }}</td>
                                                                                            <td>{{ $invoice->customer_name }}</td>
                                                                                            <td>{{ $invoice->total_cost }}</td>
                                                                                            <td>{{ $invoice->created_at }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                        <div style="text-align: right" class="col-12">
                                                                            <h6>Tổng : {{ number_format($admin->turnover_month, 0, ',', ',') }} VNĐ</h6>
                                                                            <h6>Hoa Hồng : {{ number_format($admin->commission, 0, ',', ',') }} VNĐ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                            <form action="{{ route('admins.delete_more') }}" method="POST">
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
    {{-- <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script> --}}
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    {{-- <script src="src/plugins/datatables/js/pdfmake.min.js"></script> --}}
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
            $('input[name = "checkbox_selected"]').val(data);
        });

    </script>
@endsection
