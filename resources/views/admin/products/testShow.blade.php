@extends('admin.layout.index')
@section('style')
<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')
    <!-- Export Datatable start -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Product</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="product-wrap">
        <div class="product-list">
            <ul class="row">
                @foreach ($products as $product)
                <li class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product-box">
                        <div class="producct-img"><img src="vendors/images/product-img1.jpg" alt=""></div>
                        <div class="product-caption">
                            <h4><a href="#">{{$product->product_name}}</a></h4>
                            <div class="price">
                                <del>{{$product->price + 10000}}</del><ins>{{$product->price}}</ins>
                            </div>
                            <a href="{{route('carts.show', $product->id)}}" class="btn btn-outline-primary">Add To Cart</a>
                        </div>
                    </div>
                </li>
                @endforeach
            
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
