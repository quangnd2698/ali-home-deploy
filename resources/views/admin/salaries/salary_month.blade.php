@extends('admin.layout.index')
@section('style')
    {{--
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css"> --}}
    <link rel="stylesheet" href="src/inputs/bootstrap-material-design.min.css" type="text/css">
@endsection
@section('content')
    <!-- Export Datatable start -->
    {{-- <div class="card-box"> --}}
        <form action="{{ route('salaries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-box row">

                <div class="col-md-9 mb-5" style="overflow-x: scroll" >
                    <table class="table table-striped table-hover" style="min-width: 1200px;margin-top: 5px;">
                        <thead style="background-color: #FFFFCC">
                            <tr>
                                <th>Họ Tên</th>
                                <th>Lương CB</th>
                                <th>Ngày Công</th>
                                <th>Lương SP</th>
                                <th>Trợ Cấp</th>
                                <th>Phạt / Phụ phí</th>
                                <th>Ứng trước</th>
                                <th>Bảo Hiểm</th>
                                <th>Thanh Toán</th>
                                {{-- <th>Tháng</th> --}}
                            </tr>
                        </thead>
                        <tbody class="table-striped">
                            @foreach ($staffs as $key => $staff)
                                <tr>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ number_format($staff->basic_salary, 0, ',', ',') }}</td>
                                    <td style="width: 10%">
                                        <input style="font-size: 14px" type="text" name="data[{{ $key }}][workdays]"
                                            class="form-control salary" value=" {{ $staff->workday }}"></td>
                                    <td>{{ number_format($staff->commission, 0, ',', ',') }}</td>
                                    <td>
                                        <input style="font-size: 14px" type="text" name="data[{{ $key }}][allowance]"
                                            class="form-control salary" value=" {{ 1500000 }}"></td>
                                    <td>
                                        <input style="font-size: 14px" type="text" name="data[{{ $key }}][amercement]"
                                            class="form-control salary" value="0"> </td>
                                    <td>
                                        <input style="font-size: 14px" type="text" name="data[{{ $key }}][advance_money]"
                                            class="form-control salary" value="0">
                                    </td>
                                    <td>{{ number_format(ROUND($staff->basic_salary * 0.105, 0), 0, ',', ',') }}</td>
                                    <td class="last_salary" id="last_salary[{{ $key }}]"></td>
                                </tr>
                                <input type="text" name="data[{{ $key }}][admin_id]" value="{{ $staff->id }}" hidden>
                                <input type="text" name="data[{{ $key }}][staff_name]" value="{{ $staff->name }}" hidden>
                                <input type="number" name="data[{{ $key }}][basic_salary]"
                                    value="{{ $staff->basic_salary }}" hidden>
                                <input type="number" name="data[{{ $key }}][commission]" value="{{ $staff->commission }}"
                                    hidden>
                                <input type="number" name="data[{{ $key }}][insurrance]"
                                    value="{{ ROUND($staff->basic_salary * 0.105,0)}}" hidden>
                                <input type="number" name="data[{{ $key }}][last_salary]" value="" hidden>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-box col-3 mb-3" style="background-color: #CCFFFF; margin-top: 5px">
                    <div class="card-body">
                        <div class="row">
                            <p class="col-5">kỳ làm việc:</p>
                            <h6>01/10/2020 - 01/11/2020</h6>
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col-5">Mã bảng lương:</p>
                            <input type="text" name="salary_code" class="form-control col-7" value="" placeholder="Mã tự động: SLR-01-2020/xx ">
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col-5">Ngày công chuẩn:</p>
                            <input mdbInput type="text" name="standard_days" class="form-control col-2 salary"
                                value="26">
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col-5">kỳ Hạn Trả:</p>
                            <h6>Hàng tháng</h6>
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col-5">Ghi chú:</p>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="button" class="btn btn-primary col-5">Cập nhật</button>
                            <p class="col-2"></p>
                            <button type="submit" class="btn btn-success col-5">Chốt lương</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        {{-- </div> --}}

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
    {{-- <script src="src/inputs/jquery-3.2.1.slim.min.js"></script>
    --}}
    {{-- <script src="src/inputs/popper.js"></script> --}}
    {{-- <script src="src/inputs/bootstrap-material-design.js"></script>
    --}}
    <script>
        $(document).ready(function() {
            $('body').bootstrapMaterialDesign();
        });

    </script>

    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }
        $('.salary').change(function() {
            // $(this).children().val(1233);
            $('.last_salary').each(function(k, v) {
                var workday = Number($('input[name="data[' + k + '][workdays]"]').val());
                var basic_salary = Number($('input[name="data[' + k + '][basic_salary]"]').val());
                var allowance = Number($('input[name="data[' + k + '][allowance]"]').val());
                var commission = Number($('input[name="data[' + k + '][commission]"]').val());
                var insurrance = Number($('input[name="data[' + k + '][insurrance]"]').val());
                var amercement = Number($('input[name="data[' + k + '][amercement]"]').val());
                var advance_money = Number($('input[name="data[' + k + '][advance_money]"]').val());
                var standard_days = Number($('input[name="standard_days"]').val());
                var last_salary = (basic_salary * (workday / standard_days)) + commission + allowance -
                    insurrance -
                    amercement -
                    advance_money;
                last_salary = Math.ceil(last_salary);
                $(this).html(formatNumber(last_salary));
                $('input[name="data[' + k + '][last_salary]"]').attr('value', last_salary);
            });
        });

        $('.last_salary').each(function(k, v) {
            var workday = Number($('input[name="data[' + k + '][workdays]"]').val());
            var basic_salary = Number($('input[name="data[' + k + '][basic_salary]"]').val());
            var allowance = Number($('input[name="data[' + k + '][allowance]"]').val());
            var commission = Number($('input[name="data[' + k + '][commission]"]').val());
            var insurrance = Number($('input[name="data[' + k + '][insurrance]"]').val());
            var amercement = Number($('input[name="data[' + k + '][amercement]"]').val());
            var advance_money = Number($('input[name="data[' + k + '][advance_money]"]').val());
            var standard_days = Number($('input[name="standard_days"]').val());
            var last_salary = (basic_salary * (workday / standard_days)) + commission + allowance - insurrance -
                amercement -
                advance_money;
            last_salary = Math.ceil(last_salary);
            $(this).html(formatNumber(last_salary));
            $('input[name="data[' + k + '][last_salary]"]').attr('value', last_salary);

        });

    </script>
@endsection
