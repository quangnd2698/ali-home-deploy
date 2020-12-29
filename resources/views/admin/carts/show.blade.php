@extends('admin.layout.index')
@section('style')
<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')
    <!-- Export Datatable start -->
    <div class="page-header">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Product</th>
                                <th scope="col">Available</th>
                                <th scope="col" class="text-right">Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                                
                                <td>{{$cart->product->product_name}}</td>
                                <td>In stock</td>
                                <td class="text-right">{{$cart->product->price}}</td>
                                <td style="width: 10%">
                                    <input class="form-control" type="text" value="{{$cart->quantity}}" /></td>
                                <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-1">

            </div>
            <div class="col-12 row">
                <a href="{{route('orders.create')}}">mua hang</a>
            </div>
        </div>
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
    $(document).ready(function() {
        $('#product').change(function() {
            var phone = $(this).val();
            // alert(id_monhoc);
            $.get("orders/prices/"+phone, function(data) {
                $("#div_confirm").html(data);
            });
        });
    });
    </script>
@endsection
