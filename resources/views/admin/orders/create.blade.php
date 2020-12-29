@extends('admin.layout.index')
@section('style')
@endsection
@section('content')

<div class="pd-30 card-box mb-10">
    <div class="clearfix" >
        <div class="pull-center" style="text-align: center; background-color: #FFCC66">
            <h2 class="h1">Create User</h2>
        </div>
        
    </div>
    <a href="{{route('orders.index')}}">
        <button class="btn btn-danger" style="margin-right: 100px;">
            <i class="icon-copy fa fa-backward" aria-hidden="true"></i>
            Back 
        </button>
    </a>
    <div style="margin-left: 13%; margin-top: 50px">
        <form action="{{route('orders.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.orders.form')
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="src/plugins/dropzone/src/dropzone.js"></script>
<script src="vendors/scripts/advanced-components.js"></script>
<script src="src/plugins/switchery/switchery.min.js"></script>
<script src="src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- bootstrap-touchspin js -->

<script>
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
$(window).on("load", function() { 
    getPromotion();
}); 
function getPromotion() {
    // alert(12);
    var phone = $('#phone').val();
    // alert(phone);
    $.get("admin/orders/prices/"+phone, function(data) {
        // alert(1);
        $("#km").html(data[0]);
        $("#last_money").html(formatNumber(data[1]));
        $('input[name="cost"]').val(data[1]);
    });
}

$('#submit').click(function(){
    var point_use = $('#point_use').val();
    var last_cost = $('#last_money').text();
    var preferential = $('#percent').text();
    $('input[name="point_used"]').val(point_use);
    // $('input[name="cost"]').val(last_cost);
    $('input[name="preferential"]').val(preferential);
});

function getPointUse(){
    var point_use = $('#point_use').val();
    // point_use += ','    
    var percent = $('#percent').text();
    var data = percent + ',' + point_use;
    // alert(data);
    $.get("admin/orders/last_money/"+data, function(data) {
        $("#last_money").html(formatNumber(data));
        $('input[name="cost"]').val(data);
    });
}
// $('#point_use').change(function() {
//     var point_use = $('#point_use').val();
//     alert(point_use);
//     // $.get("admin/orders/prices/"+phone, function(data) {
//     //     $("#km").html(data);
//     // });
// });
</script>
@endsection