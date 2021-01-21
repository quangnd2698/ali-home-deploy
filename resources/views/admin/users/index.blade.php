@extends('admin.layout.index')
@section('style')
<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')
    <!-- Export Datatable start -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thành viên</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-right row">
                @can('isAdmin')
                    {{-- <button type="button" class="btn btn-primary col-2" style="margin-right: 15px" id="text">
                        <i class="icon-copy fi-upload"></i>
                        Import
                    </button> --}}
                    {{-- <button type="button" class="btn btn-outline-info col-3" style="margin-right: 15px">
                        <i class="icon-copy fi-download"></i>
                        Xuất file
                    </button> --}}
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
                        <th>Ảnh</th>
                        <th>email</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Điểm</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach($users as $key => $user)
                    <tr>
                        {{-- <td style="font-size: 16px" ><div class="dt-checkbox"><input type="checkbox" name="checkbox-{{$user->id}}" value=""><span class="dt-checkbox-label"></span></div></td> --}}
                        <td style="font-size: 16px" >
                            <img  @if($user->avatar) {{$user->avatar}}
                            src = "images/users/{{$user->avatar}}"
                        @else
                            src = "images/admins/avatar.jpg"
                        @endif style="width: 40px; height: 40px; margin-left: 25%" class="rounded-circle">
                        </td>
                        <td style="font-size: 16px" style="font-size: 16px">{{ $user->email }}</td>
                        <td style="font-size: 16px">{{ $user->name}}</td>
                        <td style="font-size: 16px">{{ $user->phone }}</td>
                        <td style="font-size: 16px">{{ $user->point }}</td>
                        
                        <td style="font-size: 16px; width: 100px;" class="row dropdown">
                            <div class="col-4"><a data-toggle="modal" style="padding: 0px 5px 0px 5px" class="btn btn-primary"
                                data-target="#bd-example-modal-lg-{{$user->id}}" href="#">
                                    <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a data-toggle="modal" style="padding: 0px 5px 0px 5px" class="btn btn-danger"
                                data-target="#confirmation-modal-{{$user->id}}"><i
                                        class="dw dw-delete-3"></i>
                                </a>
                            </div>
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
                                <label class="weight-600">Loại khách</label>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio1" name="product_type" class="custom-control-input"
                                        checked>
                                    <label class="custom-control-label" for="customRadio1">Tất cả</label>
                                </div>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio2" name="product_type" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Công ty</label>
                                </div>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio3" name="product_type" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Cá nhân</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-box" style="width: 13%;">
                        <br>
                        <div class="col-md-12 col-sm-12">
                            <label class="weight-600">Cấp bậc</label>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                <label class="custom-control-label" for="customCheck1">Bình thường</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Thân thiết</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3">Ưu tú</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                <label class="custom-control-label" for="customCheck4">Tiềm năng</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                <label class="custom-control-label" for="customCheck4">Vip</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-box" style="width: 13%;">
                        <br>
                        <div class="col-md-12 col-sm-12">
                            <label class="weight-600">Giới tính</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="changeAll" name="customRadio" checked class="custom-control-input">
                                <label class="custom-control-label" for="changeAll">Tất cả</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="change1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="change1">Nam</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="change2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="change2">Nữ</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}
        </div>
    </div>

{{--  --}}

    {{-- modal --}}
    @foreach ($users as $user)
    <div class="modal fade bs-example-modal-xl"  id="bd-example-modal-lg-{{ $user->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Thông Tin khách hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img @if(isset($user->image))
                                            src = "images/users/{{$user->image}}"
                                            @else
                                                src = "images/admins/avatar.jpg"
                                            @endif 
                                            alt="user" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4>{{$user->name}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Gmail</h6>
                                        <span class="text-secondary">{{$user->email}}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Số điện thoại</h6>
                                        <span class="text-secondary">{{$user->phone}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                                <div class="pd-20 card-box">
                                    <div class="tab">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active text-blue" data-toggle="tab" href="#profile-{{$user->id}}" role="tab" aria-selected="true">Thông tin</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-blue" data-toggle="tab" href="#contact-{{$user->id}}" role="tab" aria-selected="false">Hóa đơn</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="profile-{{$user->id}}" role="tabpanel">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">Tên</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                {{$user->name}}
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">Ngày Sinh</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                {{$user->date_of_birth}}
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">Địa chỉ</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                {{$user->address}}
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">Điểm</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                2000
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">Rank</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                {{$user->rank}}
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h6 class="mb-0">Ngày Tạo</h6>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                {{$user->Created_at}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="contact-{{$user->id}}" role="tabpanel">
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
                                                                        @if ($user->invoice)
                                                                            @foreach ($user->invoice as $invoice)
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
    <div class="modal fade" id="confirmation-modal-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">Bạn có tiếp tục xóa</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                            NO
                        </div>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                YES
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

            <div class="modal fade" id="warning-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered ">
                    <div class="modal-content bg-warning" >
                        <div class="modal-body text-center">
                            <h3 class="mb-15"><i class="fa fa-exclamation-triangle"></i> Warning</h3>
                            <p>Bạn đang xóa nhiều mục cùng lúc, bạn có chắc chắn xóa các mục đó không</p>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    NO
                                </div>
                                {{-- <form action="{{route('users.delete_more')}}" method="POST">  --}}
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <div class="col-6">
                                        <input type="text" name="checkbox_selected" style="display: none">
                                        <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
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
    $('#delete_more').click(function(){
        var data =''
        $('input[type = "checkbox"]').each(function(value){
            if($(this).is(':checked')){
                data += ',';
                data += value;
            }
        });
        data = data.substring(1);
        $('input[name = "checkbox_selected"]').val(data);
    });
    </script>
@endsection
