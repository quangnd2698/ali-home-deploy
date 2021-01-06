@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzone.css">
    <link rel="stylesheet" type="text/css" href="src/avatar.scss">
@endsection
@section('content')
{{-- {{$admin}} --}}
<div>
    <a href="admin">Admin</a>/ <a href="admin/admins">Nhân viên</a>/<a href="admin/admins/{{$admin->id}}/edit">Sửa</a>
</div>
<div class="pd-30 card-box mb-10">
    <div class="clearfix" >
        <div class="pull-center" style="text-align: center">
            <h2 class="h1">Sửa Thông Tin Nhân Viên</h2>
        </div>
        
    </div>
    <a href="{{route('admins.index')}}">
        <button class="btn btn-danger" style="margin-right: 100px;">
            <i class="icon-copy fa fa-backward" aria-hidden="true"></i>
            Back 
        </button>
    </a>
    <div style="margin-left: 13%; margin-top: 50px">
        <form action="{{route('admins.update', $admin->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.admins.form')
        </form>
    </div>
</div>

@endsection
@section('script')
<script src="src/plugins/dropzone/src/dropzone.js"></script>
<script src="vendors/scripts/advanced-components.js"></script>
<script src="src/plugins/switchery/switchery.min.js"></script>
<script src="src/avatar.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#img_avartar').attr('src', e.target.result);
            }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $('input[name="image"]').change(function(){
        readURL(this);
    });

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

    (function($) {
    $.fn.checkFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {

            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();

                }

            });

        });
    };

})(jQuery);

$(function() {
    $('#image').checkFileType({
        allowedExtensions: ['jpg', 'jpeg', 'png'],
        success: function() {
            // alert('Success');
        },
        error: function() {
            $('#image').val('');
            alert('file had chose not is jpg, jpeg or png');

        }
    });

});
</script>
@endsection