@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzone.css">
    <link rel="stylesheet" type="text/css" href="src/avatar.scss">
@endsection
@section('content')
{{-- {{$admin}} --}}
<div>
    <a href="admin">Admin</a>/ <a href="admin/admins">Nhân viên</a>/<a href="admin/admins/{{$admin->id}}/edit"> Thông tin</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <a href="{{route('admins.edit', $admin->id)}}" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
            </div>
            <h5 class="text-center h5 mb-0">{{$admin->name}}</h5>
            <p class="text-center text-muted font-14">{{$admin->position}}</p>
            <div class="profile-info">
                <h4 class="mb-20 h5 text-blue">Thông tin cá nhân</h4>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <ul>
                            <li>
                                <span>Email:</span>
                                {{$admin->email}}
                            </li>
                            <li>
                                <span>Số điện thoại:</span>
                                {{$admin->phone}}
                            </li>
                            <li>
                                <span>Địa chỉ:</span>
                                {{$admin->address}}
                            </li>
                        </ul>
                    </div>
                    <div class="col-5">
                        <ul>
                            <li>
                                <span>Ngày sinh:</span>
                                {{$admin->date_of_birth}}
                            </li>
                            <li>
                                <span>Giới tính:</span>
                                {{$admin->gender}}
                            </li>
                            <li>
                                <span>Ngày tạo:</span>
                                {{$admin->created_at}}
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="col-2">
                        <ul>
                            <li>
                                <a href="" class="btn btn-success"> Sửa thôn</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                
            </div>
        </div>
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