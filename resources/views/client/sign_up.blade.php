<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" sizes="32x32" href="client/img/favicon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Sign Up</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 750px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
</head>
<body>
<div class="signup-form">
    
    <form action="{{route('users.sign_up.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Đăng ký</h2>
		{{-- <p class="hint-text">Create your account. It's free and only takes a minute.</p> --}}
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
                <div class="form-group row @if ($errors->has('email')) {{'has-danger'}} @endif">
                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-8">
                        <input class="form-control @if ($errors->has('email')) {{'form-control-danger'}} @endif"
                        name="email" placeholder="abc@example.com" type="email"
                        @if(isset($user))
                            value="{{$user->email}}"
                        @endif>
                        @if ($errors->has('email'))
                            <p style="color: red">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row @if ($errors->has('address')) {{'has-danger'}} @endif">
                    <label class="col-sm-12 col-md-2 col-form-label" >Địa Chỉ</label>
                    <div class="row col-8">
                        <div class="col-6">
                            <input class="form-control @if ($errors->has('address')) {{'form-control-danger'}} @endif"
                            name="address" type="text" placeholder="số nhà"
                                @if(isset($user))
                                    value="{{$user->address}}"
                                @endif>
                            @if ($errors->has('address'))
                                <p style="color: red">{{ $errors->first('address') }}</p>
                            @endif
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="province" name="province">
                                <option  value="Hà Tĩnh" selected>Hà Tĩnh</option>
                                @isset($provinces)
                                @foreach ($provinces as $province)
                                <option onclick="getDistricts()" value="{{$province->name}}">{{$province->name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row @if ($errors->has('address')) {{'has-danger'}} @endif">
                    <label class="col-sm-12 col-md-2 col-form-label" ></label>
                    <div class="row col-8">
                        <div class="col-6">
                            <select class="form-control" id="district" name="district">
                                <option  value="Cẩm Xuyên" selected>Cẩm Xuyên</option>
                                @isset($districts)
                                @foreach ($districts as $district)
                                <option onclick="getWards({{$district->id}})" value="{{$district->name}}">{{$district->name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="ward" name="ward">
                                @isset($wards)
                                @foreach ($wards as $ward)
                                <option  value="{{$ward->name}}">{{$ward->name}}</option>
                                @endforeach
                                @endisset
                            </select>
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
                <div class="form-group row @if ($errors->has('phone')) {{'has-danger'}} @endif">
                    <label class="col-sm-12 col-md-2 col-form-label">Số Điện Thoại</label>
                    <div class="col-sm-12 col-md-8">
                        <input class="form-control @if ($errors->has('phone')) {{'form-control-danger'}} @endif"
                            name="phone" type="tel"
                            @if(isset($user))
                                value="{{$user->phone}}"
                            @endif>
                        @if ($errors->has('phone'))
                            <p style="color: red">{{ $errors->first('phone') }}</p>
                        @endif
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
                
                <div class="form-group row" id="div_confirm">
                    <label class="col-sm-12 col-md-2 col-form-label">Xác Nhận Mật Khẩu</label>
                    <div class="col-sm-12 col-md-8">
                        <input class="form-control"
                            name="confirm_password" value="" type="password">
                
                        <div class="form-control-feedback" id="text_confirm"></div>
                    </div>
                </div>
                
                <div class="form-group row @if ($errors->has('date_of_birth')) {{'has-danger'}} @endif">
                    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Ngày Sinh</label>
                    <div class="col-sm-12 col-md-8">
                        <input class="form-control @if ($errors->has('date_of_birth')) {{'form-control-danger'}} @endif date-picker"
                            name="date_of_birth" placeholder="Tháng/ngày/năm" type="text"
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
                    <input style class="col-sm-12 col-md-2 btn btn-primary" type="submit" value="Đăng ký" id="submit">
                </div>
        
    </form>
	<div class="text-center">Already have an account? <a href="user_login">Đăng nhập</a></div>
</div>
<script src="vendors/scripts/advanced-components.js"></script>
<script>
    $('#province').change(function () {
                var name = $(this).val();
                // alert(name);
                getDistricts(name)
            })
            function getDistricts(name) {
                $.get("ajax/districts/"+name, function(data) {
                    $('#district').html(data[0]);
                    $('#ward').html(data[1]);
                });
            }

            $('#district').change(function () {
                var name = $(this).val();
                // alert(name);
                getWards(name)
            })
            function getWards(name) {
                $.get("ajax/wards/"+name, function(data) {
                    $('#ward').html(data);
                });
            }

    $('input[name="confirm_password"]').keyup(function() {
        var confirm_password = $('input[name="confirm_password"]').val();
        $('#text_confirm').text('Xác nhận mật khẩu không khớp');
        $('input[name="confirm_password"]').attr('class', 'form-control form-control-danger');
        $('#div_confirm').attr('class', 'form-group row has-danger');
        $('#submit').prop( "disabled", true );
        var password = $('input[name="password"]').val();
        if (confirm_password === password) {
            $('input[name="confirm_password"]').attr('class', 'form-control form-control-success');
            $('#text_confirm').hide();
            $('#div_confirm').attr('class', 'form-group row');
            $('#submit').prop( "disabled", false );
        }
    });
</script>
</body>
</html>