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
                    <li class="breadcrumb-item active" aria-current="page">Bảng lương nhân viên</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 text-right row">
            @can('isAdmin')
                {{-- <button type="button" class="btn btn-primary col-2" style="margin-right: 15px" id="text">
                    <i class="icon-copy fi-upload"></i>
                    Import
                </button> --}}
                {{-- <button type="button" class="btn btn-outline-info col-3" style="margin-right: 15px">
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


    <div class="card-box mb-30">
        <div class="pb-20">
            <table class="checkbox-datatable table table-hover nowrap" style="width: 100%; background-color: #CCFFFF">
                <thead style="background-color: #FFCC33">
                    <tr>
                        <th>id</th>
                        <th>Nhân viên</th>
                        <th>Chức vụ</th>
                        <th>Lương cơ bản</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach($staffs as $key => $staff)
                    <tr>
                        <td>{{ $staff->id }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->position}}</td>
                        <td>{{ number_format($staff->basic_salary , 0, ',', ',') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
