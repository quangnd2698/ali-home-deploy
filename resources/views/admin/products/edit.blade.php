@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzone.css">
    <link rel="stylesheet" type="text/css" href="src/avatar.scss">
    <link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" href="src/inputs/bootstrap-material-design.min.css" type="text/css">
@endsection
@section('content')
<script>

    function removeImagePlus(id) {
        // alert(id);
        $('#image-'+ id).remove();
        var val = $('input[name="remove_images').val();
        if (val != '') {
            val = val + ',' + id;
        } else {
            val = val + id;
        }
        $('input[name="remove_images').val(val);
    }

    function removeImage(id) {
        $('#image-'+ id).remove();
        $('input[name="images['+ id +']"]').prop('disabled', true);
    }
    function readURL(input, count) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            //$('#blah').attr('src', e.target.result);
            $('#parent').append('<div class="col-3" id="image-'+ count +'"><img src= "' + e.target.result + '" alt="..." class="img-thumbnail" style="height: 200px; width: 200px" ><div><button type="button" class="btn btn-danger col-11" onclick="removeImage('+ count +')"><i class="fa fa-trash"></i></button></div></div>')
            }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }


    function getFilename(input){
        var data = null;
        var count = $(".custom-file-input").attr("id");
        readURL(input, count);
        count = Number(count);
        count ++; 
        // console.log(count);
        $('.custom-file').hide();
        $('#form_gr').prepend('<div class="custom-file"><input type="file" class="custom-file-input" name="images['+ count + ']" id="' + count +'" onchange="getFilename(this)"> <label class="custom-file-label">Choose file</label>')
    };

    
</script>
<div class="pd-30 card-box mb-10">
    <div class="clearfix" >
        <div class="pull-center" style="text-align: center">
            <h2 class="h1">Sửa Sản Phẩm</h2>
        </div>
        
    </div>
    <a href="{{route('products.index')}}">
        <button class="btn btn-danger" style="margin-right: 100px;">
            <i class="icon-copy fa fa-backward" aria-hidden="true"></i>
            Back 
        </button>
    </a>
        <div class="wizard-content" style="margin-top: 50px">
            <form  class="tab-wizard wizard-circle wizard vertical" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.products.form')
                <input type="text" name="remove_images" hidden>
            </form>
        </div>
</div>

@endsection
@section('script')
<script src="src/plugins/dropzone/src/dropzone.js"></script>
<script src="vendors/scripts/advanced-components.js"></script>
<script src="src/plugins/switchery/switchery.min.js"></script>
{{-- <script src="src/avatar.js"></script> --}}
<script src="src/plugins/jquery-steps/jquery.steps.js"></script>
<script src="vendors/scripts/steps-setting.js"></script>
</body>
<script>
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

$('a[href$="#finish"]').hide();
$(document).ready(function() {
            $('body').bootstrapMaterialDesign();
        });
</script>
@endsection