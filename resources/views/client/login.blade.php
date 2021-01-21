<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
    <link rel="icon" type="image/png" sizes="32x32" href="client/img/favicon.png">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
    <meta name="author" content="leamug">
    <title>Đăng nhập</title>
    <link href="css/style.css" rel="stylesheet" id="style">
    <!-- Bootstrap core Library -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /*author:starttemplate*/
/*reference site : starttemplate.com*/
body {
  /* background-image:url('client/background.jpg'); */
  background-position:center;
  background-size:cover;
  
  -webkit-font-smoothing: antialiased;
  /* font: normal 14px Roboto,arial,sans-serif; */
  /* font-family: 'Dancing Script', cursive!important; */
}

.container {
    padding: 110px;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #ffffff!important;
    opacity: 1; /* Firefox */
    font-size:18px!important;
}
.form-login {
    width: 500px;
    background-color: rgba(0,0,0,0.55);
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    color:white;
    box-shadow:0 1px 0 #cfcfcf;
}
.form-control{
    background:transparent!important;
    color:white!important;
    
}
h1{
    color:white!important;
}
h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}

.form-control {
    border-radius: 10px;
}
.text-white{
    font-size: 48px!important;
    color: black!important;
}
.wrapper {
    text-align: center;
}
.footer p{
    font-size: 18px;
}
    </style>
</head>
<body>

<!-- Page Content -->
<div class="container">
    {{-- <div class="row"> --}}
        <div class="col-md-offset-3 col-md-4 text-center">
            {{-- <h1 class='text-white'>Đăng nhập</h1> --}}
            <div class="form-login"></br>
                <form action="{{ route('users.sign_in')}}" method="post">
                    @csrf
                    <h4>Đăng nhập</h4>
                    </br>
                    <input type="text" id="phone" name="phone" class="form-control input-sm chat-input" placeholder="Số điện thoại"/>
                    </br></br>
                    <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="Mật khẩu"/>
                    </br></br>
                    <div class="wrapper">
                        <span class="group-btn">
                            <button class="btn btn-danger btn-md">Đăng nhập <i class="fa fa-sign-in"></i></button>
                        </span>
                    </div>
                    @if(session('thongbaoloi'))
                    <div class="alert alert-danger">
                        {{session('thongbaoloi')}}
                    </div>
                    @endif
                </form>
                <div class="text-center">Chưa có tài khoản <a style="color: yellow" href="{{route('users.sign_up')}}">Đăng ký</a></div>
                <div class="text-center"><a style="color: black" href="{{route('users.reset_pass')}}">Quên mật khẩu</a></div>
            </div>
        </div>
    {{-- </div> --}}
    </br></br></br>
    <!--footer-->
    <!--//footer-->
</div>
</body>
</html>
