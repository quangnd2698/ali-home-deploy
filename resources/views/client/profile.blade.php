@extends('client.index')
@section('style')
    <style>
        body{
  margin-top: auto;
    background-color: #f1f1f1;
  }
  .border{
    border-bottom:1px solid #F1F1F1;
    margin-bottom:10px;
  }
  .main-secction{
    box-shadow: 10px 10px 10px;
  }
  .image-section{
    padding: 0px;
  }
  .image-section img{
    width: 100%;
    height:250px;
    position: relative;
  }
  .user-image{
    position: absolute;
    margin-top:-50px;
  }
  .user-left-part{
    margin: 0px;
  }
  .user-image img{
    width:100px;
    height:100px;
  }
  .user-profil-part{
    padding-bottom:30px;
    background-color:#FAFAFA;
  }
  .follow{    
    margin-top:70px;   
  }
  .user-detail-row{
    margin:0px; 
  }
  .user-detail-section2 p{
    font-size:12px;
    padding: 0px;
    margin: 0px;
  }
  .user-detail-section2{
    margin-top:10px;
  }
  .user-detail-section2 span{
    color:#7CBBC3;
    font-size: 20px;
  }
  .user-detail-section2 small{
    font-size:12px;
    color:#D3A86A;
  }
  .profile-right-section{
    padding: 20px 0px 10px 15px;
    background-color: #FFFFFF;  
  }
  .profile-right-section-row{
    margin: 0px;
  }
  .profile-header-section1 h1{
    font-size: 25px;
    margin: 0px;
  }
  .profile-header-section1 h5{
    color: #0062cc;
  }
  .req-btn{
    height:30px;
    font-size:12px;
  }
  .profile-tag{
    padding: 10px;
    border:1px solid #F6F6F6;
  }
  .profile-tag p{
    font-size: 12px;
    color:black;
  }
  .profile-tag i{
    color:#ADADAD;
    font-size: 20px;
  }
  .image-right-part{
    background-color: #FCFCFC;
    margin: 0px;
    padding: 5px;
  }
  .img-main-rightPart{
    background-color: #FCFCFC;
    margin-top: auto;
  }
  .image-right-detail{
    padding: 0px;
  }
  .image-right-detail p{
    font-size: 12px;
  }
  .image-right-detail a:hover{
    text-decoration: none;
  }
  .image-right img{
    width: 100%;
  }
  .image-right-detail-section2{
    margin: 0px;
  }
  .image-right-detail-section2 p{
    color:#38ACDF;
    margin:0px;
  }
  .image-right-detail-section2 span{
    color:#7F7F7F;
  }

  .nav-link{
    font-size: 1.2em;    
  }
  
    </style>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 image-section">
            <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg">
        </div>
        <div class="row user-left-part col-12">
            <div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
                <div class="row ">
                    <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                        <img src="@if (isset($user->avatar))
                            {{'images/users'. $user->avatar}}
                        @else
                            https://www.jamf.com/jamf-nation/img/default-avatars/generic-user-purple.png"
                        @endif
                            class="rounded-circle">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                        <button id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#contact" class="btn btn-success btn-block follow">Sửa thông tin</button> 
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
                <div class="row profile-right-section-row col-12">
                    <div class="col-md-12 profile-header">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
                                <h1>{{$user->name}}</h1>
                                <hr>
                                <h5> Cấp bậc: {{$user->rank}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><i class="fa fa-user-circle"></i> Thông tin cá nhân</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i class="fa fa-user-circle"></i> Lịch sử mua hàng</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#edit" role="tab" data-toggle="tab"><i class="fa fa-user-circle"></i> Chỉnh sửa thông tin</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active" id="profile">
                                                <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Số điện thoại</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>{{$user->phone}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Địa chỉ</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>{{$user->address}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Email</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>{{$user->email}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Giới tính</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>{{$user->gender}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Ngày sinh</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>{{$user->date_of_birth}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Số điểm đang có</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>{{$user->point}}</p>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="buzz">
                                            {{-- <div class="row"> --}}
                                                
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>stt</th>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Ngày mua</th>
                                                            <th>Giá trị</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($user->invoice as $key => $invoice)
                                                        <tr>
                                                            <td>{{$key}}</td>
                                                            <td>{{$invoice->invoice_code}}</td>
                                                            <td>{{$invoice->created_at}}</td>
                                                            <td>{{$invoice->last_cost}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            {{-- </div> --}}
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="edit">
                                            <form action="{{route('users.profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row @if ($errors->has('name')) {{'has-danger'}} @endif">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Tên</label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input class="form-control @if ($errors->has('name')) {{'form-control-danger'}} @endif" 
                                                            name="name" type="text" placeholder="Johnny Brown"
                                                            @if(isset($user))
                                                                value="{{$user->name}}"
                                                            @endif>
                                                        @if ($errors->has('name'))
                                                            <p style="color: red">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row @if ($errors->has('address')) {{'has-danger'}} @endif">
                                                    <label class="col-sm-12 col-md-2 col-form-label" >Địa Chỉ</label>
                                                    <div class="row col-8">
                                                        <div class="col-12">
                                                            <input class="form-control @if ($errors->has('address')) {{'form-control-danger'}} @endif"
                                                            name="address" type="text" placeholder="số nhà"
                                                                @if(isset($user))
                                                                    value="{{$user->address}}"
                                                                @endif>
                                                            @if ($errors->has('address'))
                                                                <p style="color: red">{{ $errors->first('address') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Giới Tính</label>
                                                    <div class="col-sm-12 col-md-8 row">
                                                        <div class="custom-control custom-radio col" style="margin-left: 55px">
                                                            <input type="radio" id="customRadio1" value="male" name="gender" class="custom-control-input" checked>
                                                            <label class="custom-control-label" for="customRadio1">Nam</label>
                                                        </div>
                                                        <div class="custom-control custom-radio col">
                                                            <input type="radio" id="customRadio2" value="female" name="gender" class="custom-control-input" 
                                                            @if (isset($user) && $user->gender == 'female') {{'checked'}} @endif>
                                                            <label class="custom-control-label" for="customRadio2">Nữ</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row @if ($errors->has('password')) {{'has-danger'}} @endif">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Mật Khẩu</label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input class="form-control @if ($errors->has('password')) {{'form-control-danger'}} @endif"
                                                            name="password" type="password"
                                                            @if(isset($user))
                                                                value="{{$user->password}}"
                                                            @endif>
                                                        @if ($errors->has('password'))
                                                            <p style="color: red">{{ $errors->first('password') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row @if ($errors->has('date_of_birth')) {{'has-danger'}} @endif">
                                                    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Ngày Sinh</label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input class="form-control @if ($errors->has('date_of_birth')) {{'form-control-danger'}} @endif date-picker"
                                                            name="date_of_birth" placeholder="Choose Date anf time" type="text"
                                                            @if(isset($user))
                                                                value="{{$user->date_of_birth}}"
                                                            @endif>
                                                        @if ($errors->has('date_of_birth'))
                                                            <p style="color: red">{{ $errors->first('date_of_birth') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <br>
                                                <div class="row justify-content-md-center col-sm-12">
                                                    <input style class="col-sm-12 col-md-2 btn btn-primary" type="submit" value="Sửa" id="submit">
                                                </div>
                                            </form>
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

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contact">Contactarme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p for="msj">Se enviará este mensaje a la persona que desea contactar, indicando que te quieres comunicar con el. Para esto debes de ingresar tu información personal.</p>
                </div>
                <div class="form-group">
                    <label for="txtFullname">Nombre completo</label>
                    <input type="text" id="txtFullname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txtEmail">Email</label>
                    <input type="text" id="txtEmail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txtPhone">Teléfono</label>
                    <input type="text" id="txtPhone" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" (click)="openModal()" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

    @endsection
    @section('script')

        <script>
        </script>
    @endsection
