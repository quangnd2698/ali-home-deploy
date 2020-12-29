@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="src/inputs/bootstrap-material-design.min.css" type="text/css">
@endsection
@section('content')

    <!-- Export Datatable start -->
    <form action="{{ route('attendances.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-box mb-30">
            <div class="pb-20 col-12" style="width: 100%">
                <br>
                <div style="width: 100%; text-align: center; font-size: 30px; ">
                    Bảng chấm công tháng {{$month}}
                </div>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3">
                        <input class="col-10 btn btn-outline-success" type="submit" value="Cập nhật" id="submit"
                        @cannot('isAdmin')
                            {{'disabled'}}
                        @endcannot
                        >
                    </div>
                </div>
            </div>
            <div class="pd-20" style="overflow-x: scroll">
                <table class="table table-bordered nowrap table-hover" style="min-width: 2000px">
                    <thead>
                        <tr>
                            <th style="background: linear-gradient(to bottom left, yellow, #00CC00)" rowspan="2">
                                <p style="width: 100%; text-align: right">Ngày</p>
                                {{-- <br> --}}
                                <p  style="width: 100%; text-align: left; margin-bottom: 0%">Nhân Viên</p>
                            </th>
                            <th style="background-color: yellow">1</th>
                            <th style="background-color: yellow" >2</th>
                            <th style="background-color: yellow" >3</th>
                            <th style="background-color: yellow" >4</th>
                            <th style="background-color: yellow" >5</th>
                            <th style="background-color: yellow" >6</th>
                            <th style="background-color: yellow" >7</th>
                            <th style="background-color: yellow" >8</th>
                            <th style="background-color: yellow" >9</th>
                            <th style="background-color: yellow" >10</th>
                            <th style="background-color: yellow" >11</th>
                            <th style="background-color: yellow" >12</th>
                            <th style="background-color: yellow" >13</th>
                            <th style="background-color: yellow" >14</th>
                            <th style="background-color: yellow" >15</th>
                            <th style="background-color: yellow" >16</th>
                            <th style="background-color: yellow" >17</th>
                            <th style="background-color: yellow" >18</th>
                            <th style="background-color: yellow" >19</th>
                            <th style="background-color: yellow" >20</th>
                            <th style="background-color: yellow" >21</th>
                            <th style="background-color: yellow" >22</th>
                            <th style="background-color: yellow" >23</th>
                            <th style="background-color: yellow" >24</th>
                            <th style="background-color: yellow" >25</th>
                            <th style="background-color: yellow" >26</th>
                            <th style="background-color: yellow" >27</th>
                            <th style="background-color: yellow" >28</th>
                            <th style="background-color: yellow" >19</th>
                            <th style="background-color: yellow" >30</th>
                            <th style="background-color: yellow" >31</th>
                        </tr>
                        <tr>
                            @for ($i = 0; $i < 31; $i++)
                            <th 
                            style="@if (in_array($date->modify('+1 day')->format('D'),['Sun', 'Sat']))
                                {{'background-color: red'}}
                                @else {{'background-color: #AAAAAA'}}
                            @endif"
                            >
                            {{$date->format('D')}}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff)
                        <tr>
                            <td style="background-color: #00CC00" >{{$staff->name}}</td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_1]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_1 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_1 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_1 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_1 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_2]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_2 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_2 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_2 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_2 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_3]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_3 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_3 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_3 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_3 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_4]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_4 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_4 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_4 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_4 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_5]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_5 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_5 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_5 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_5 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_6]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_6 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_6 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_6 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_6 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_7]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_7 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_7 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_7 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_7 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_8]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_8 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_8 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_8 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_8 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_9]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_9 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_9 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_9 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_9 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_10]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_10 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_10 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_10 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_10 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_11]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_11 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_11 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_11 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_11 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_12]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_12 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_12 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_12 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_12 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_13]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_13 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_13 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_13 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_13 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_14]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_14 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_14 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_14 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_14 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_15]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_15 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_15 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_15 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_15 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_16]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_16 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_16 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_16 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_16 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_17]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_17 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_17 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_17 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_17 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_18]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_18 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_18 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_18 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_18 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_19]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_19 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_19 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_19 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_19 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_20]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_20 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_20 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_20 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_20 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_21]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_21 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_21 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_21 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_21 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_22]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_22 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_22 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_22 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_22 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_23]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_23 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_23 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_23 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_23 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_24]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_24 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_24 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_24 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_24 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_25]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_25 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_25 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_25 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_25 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_26]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_26 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_26 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_26 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_26 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_27]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_27 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_27 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_27 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_27 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_28]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_28 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_28 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_28 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_28 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_29]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_29 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_29 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_29 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_29 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_30]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_30 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_30 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_30 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_30 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                            <td style="padding: 3px 2px 2px 3px">
                                <select class="custom-select col-12 form-control attendance" name="attendance[{{$staff->id}}][day_31]" style="padding: 0% 0% 0% 30%;">
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_31 == 0)
                                        {{'selected'}}
                                    @endif value="0"></option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_31 == 'W')
                                        {{'selected'}}
                                    @endif  value="W">W</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_31 == 'M')
                                        {{'selected'}}
                                    @endif value="M">M</option>
                                    <option @if ($staff->getAttendance() && $staff->getAttendance()->day_31 == 'A')
                                        {{'selected'}}
                                    @endif value="A">A</option>
                                </select>
                            </td>
                        </tr>
                        <input type="text" name="attendance[{{$staff->id}}][staff_id]" value="{{$staff->id}}" hidden>
                        @endforeach
                    </tbody>
                </table>
                <input type="text" id="check" value="@can('isAdmin'){{1}}@endcan" hidden>
            </div>
            
        </div>
    </form>
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
        
        $(document).ready(function() {
            $('body').bootstrapMaterialDesign();
        });
        $('.attendance').change(function() {
            var value = $(this).val();
            if (value == 'W') {
                $(this).parent().css('background-color', '#00CCFF');
            }else if (value == 'M') {
                $(this).parent().css('background-color', '#FFFFCC');
            }else if (value == 'A') {
                $(this).parent().css('background-color', '#FFCC66');
            } else {
                $(this).parent().css('background-color', '');
            }
        });
        $( document ).ready(function() {
            $('.attendance').each(function( k, v ) {
                var value = $(this).val();
                if (value == 'W') {
                    $(this).parent().css('background-color', '#00CCFF');
                }else if (value == 'M') {
                    $(this).parent().css('background-color', '#FFFFCC');
                }else if (value == 'A') {
                    $(this).parent().css('background-color', '#FFCC66');
                } else {
                    $(this).parent().css('background-color', '');
                }
            });
            var check = $('#check').val();
            if (check != 1) {
                $('.attendance').prop('disabled', 'disabled');
            }
        });
    </script>
    
@endsection
