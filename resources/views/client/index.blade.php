<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ali-Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <base href="{{ asset('client') }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="client/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="client/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="client/https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="client/vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- owl carousel-->
    <link rel="stylesheet" href="client/vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="client/vendor/owl.carousel/assets/owl.theme.default.css">

    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="client/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="client/css/custom.css">
    @yield('style')
    <!-- Favicon and apple touch icons-->
    {{-- <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon"> --}}
    <link rel="icon" type="image/png" sizes="32x32" href="client/img/favicon.png">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="client/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="client/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        <style>
    a {
        color: #333;
    }

.header-title {
    padding: 5px 10px;
    background: #dadada;
    font-weight: bold;
    width: 500px;
    }

.tt-menu {
    text-align: left;
}

</style>
</head>

<body>
    <div id="all">
        <!-- Top bar-->
        @include('sweetalert::alert')
        @include('client/header')
        <!-- Navbar End-->
        @yield('content')
        
        <!-- FOOTER -->
        @include('client/footer')
    </div>
    <!-- Javascript files-->
    <script src="client/vendor/jquery/jquery.min.js"></script>
    <script src="client/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="client/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="client/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="client/vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="client/vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="client/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="client/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="client/js/jquery.parallax-1.1.3.js"></script>
    <script src="client/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="client/vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <script src="client/js/front.js"></script>
    <script src="client/typeahead.bundle.min.js"></script>
    <script src="src/jquery.cookie.js"></script>
    <script>

        $.cookie("cart_product", ,{ expires: 7, path: '/' });
        $.cookie("count_product", ,{ expires: 7, path: '/' });

    </script>
    <script>
        $(document).ready(function($) {
        var engine1 = new Bloodhound({
            remote: {
                url: '/search/product_name?value=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        // var engine2 = new Bloodhound({
        //     remote: {
        //         url: '/search/product_code?value=%QUERY%',
        //         wildcard: '%QUERY%'
        //     },
        //     datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        //     queryTokenizer: Bloodhound.tokenizers.whitespace
        // });

        $(".search-input").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, [
            {
                source: engine1.ttAdapter(),
                name: 'students-name',
                display: function(data) {
                    return data.name;
                },
                templates: {
                    empty: [
                        // '<div class="header-title" style="width=500px;">Tên sản phẩm</div><div style="width=500px;" class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="header-title"></div><div class="list-group search-results-dropdown"></div>'
                    ],
                    suggestion: function (data) {
                        return "<a href='product_details/"+data.id+"' class='btn list-group-item list-group-item-action'><div class='row'><div class='col-4'><img style='width: 50px; height: 50px;' src='images/products/product1.jpg' alt=''></div><div class='col-8'><h6>" + data.product_name + "</h6><p>" + data.product_code + "<span style='margin-left: 15%'>" + data.sale_price + "</span></p></div></div></a>";
                    }
                }
            },
        ]);
    });
    </script>
    @yield('script')
</body>

</html>
