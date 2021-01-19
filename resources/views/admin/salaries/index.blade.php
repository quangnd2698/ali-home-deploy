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
                    <li class="breadcrumb-item active" aria-current="page">Lương hàng tháng</li>
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

    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pb-20">
            <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
                <thead style="background-color: #FFCC33">
                    <tr>
                        {{-- <th>
                            <div class="dt-checkbox">
                                <input type="checkbox" name="select_all" value="1" id="example-select-all">
                                <span class="dt-checkbox-label"></span>
                            </div>
                        </th> --}}
                        <th>Mã</th>
                        <th>Tổng Chi Phí</th>
                        <th>Tháng</th>
                        <th>Ghi chú</th>
                        <th>Ngày Tạo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @if (count($salaries) > 0)
                        @foreach($salaries as $key => $salary)
                        <tr>
                            {{-- <td><div class="dt-checkbox"><input type="checkbox" name="checkbox-{{$salary->id}}" value=""><span class="dt-checkbox-label"></span></div></td> --}}
                            <td>{{ $salary->salary_code }}</td>
                            <td>{{ number_format($salary->total_cost, 0, ',', ',') }}</td>
                            <td>{{ $salary->month }}</td>
                            <td style="width: 18%">{{ substr( $salary->note,  0, 30) . '...'}}</td>
                            <td>{{ $salary->created_at}}</td>
                    
                            <td style="font-size: 16px" class="row dropdown" style="width: 100px;">
                                <div class="col-4"><a data-toggle="modal" data-target="#bd-example-modal-lg-{{ $salary->id }}" href="#">
                                    <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </div>
                                
                                <div class="col-4">
                                    <a data-toggle="modal" data-target="#confirmation-modal-{{ $salary->id }}"><i
                                            class="dw dw-delete-3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- modal --}}
    @foreach ($salaries as $salary)

    <div class="modal fade bs-example-modal-xl"  id="bd-example-modal-lg-{{ $salary->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Bảng lương chi tiết tháng {{ $salary->month}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover" style="width: 100%;margin-top: 5px">
                        <thead>
                            <tr>
                                <th>Họ Tên</th>
                                <th>Lương Cơ Bản</th>
                                <th>Ngày Công</th>
                                <th>Lương SP</th>
                                <th>Trợ Cấp</th>
                                <th>Phạt</th>
                                <th>Ứng trước</th>
                                <th>Bảo Hiểm</th>
                                <th>Thanh Toán</th>
                                <th>Tháng</th>
                            </tr>
                        </thead>
                        <tbody class="table-striped">
                            @foreach($salary->salaryDetail() as $key => $detail)
                            <tr>
                                <td>{{ $detail->staff_name }}</td>
                                <td>{{ number_format($detail->basic_salary, 0, ',', ',') }}</td>
                                <td>{{ $detail->workdays }}</td>
                                <td>{{ number_format($detail->commission, 0, ',', ',') }}</td>
                                <td>{{ number_format($detail->allowance, 0, ',', ',') }}</td>
                                <td>{{ number_format($detail->amercement, 0, ',', ',') }}</td>
                                <td>{{ number_format($detail->advance_money, 0, ',', ',') }}</td>
                                <td>{{ number_format($detail->insurrance, 0, ',', ',') }}</td>
                                <td>{{ number_format($detail->last_salary, 0, ',', ',') }}</td>
                                {{-- <td>{{ number_format(9000000, 0, ',', ',') }}</td> --}}
                                <td>{{ $salary->month }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <h5>Chú Thích</h5>
                        </div>
                        <div class="card-box col-md-10">
                            {{$salary->note}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmation-modal-{{$salary->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to continue delete</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                            NO
                        </div>
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST"> 
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
