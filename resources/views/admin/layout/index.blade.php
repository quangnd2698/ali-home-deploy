<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Ali Home</title>
    <base href="{{ asset('') }}">
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"> --}}
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    @yield('style')
    <style>
        .bottomright {
            position: fixed;
            bottom: 80px;
            right: 16px;
            /* left: 300px; */
            font-size: 18px;
        }

    </style>
</head>

<body>
    <script>
        function playAudio(params) {
            var myAudio = new Audio('thongBao.mp3');
            myAudio.play();
        }
    </script>
    @include('admin/layout/header')
    @include('sweetalert::alert')
    @include('admin/layout/side_bar')
    <div class="mobile-menu-overlay"></div>

    <div class="main-container" id="main">
        <button onclick="playAudio()" >clcik</button>
        <div class="pd-ltr-20 xs-pd-20-10" style="padding-top: 0px">
            <div class="min-height-200px">
                @yield('content')
            </div>
        </div>
    </div>
    @if (Auth::guard('admins')->user()->attendanceNow == true)
    <div class="bottomright" id="bottomright">
    </div>
    @endif

    {{-- @include('admin/layout/footer') --}}

    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="src/typeahead.bundle.min.js"></script>
    <script src="src/jquery.cookie.js"></script>
    <script src="vendors/scripts/dashboard.js"></script>
    <script src="jquery.titlealert.js"></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('fb3717ac7c9f78d14f18', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {
			var text = '<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false" style="margin-bottom: 10px; width: 300px;"><div class="toast-header"><svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect fill="#007aff" width="100%" height="100%" /></svg><strong class="mr-auto">Đơn hàng mới</strong><small>'+data.text.created_at+'</small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><a href="<?php echo route("orders.index")?>"><div class="toast-body"><p>'+ data.text.name +'<span style="color:red; margin-left: 20px">'+ data.text.cost +'VNĐ</span></p></div></a></div>'
			$("#bottomright").append(text);
			$('.toast').toast('show');
            playAudio();
            $.titleAlert('Đơn hàng mới');
            // alert
        });
        // document.title = "blah"
    </script>
    @yield('script')
</body>

</html>	
