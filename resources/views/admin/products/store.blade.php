@extends('admin.layout.index')
@section('style')
    <link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzone.css">
    <link rel="stylesheet" type="text/css" href="src/avatar.scss">
@endsection
@section('content')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            //$('#blah').attr('src', e.target.result);
            $('#parent').append('<img src= "' + e.target.result + '" alt="..." class="img-thumbnail" style="height: 200px; width: 200px" >')
            }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }


    function getFilename(input){
        readURL(input);
        var count = $(".custom-file-input").attr("id");
        count = Number(count);
        count ++; 
        console.log(count);
        $('.custom-file').hide();
        $('#form_gr').prepend('<div class="custom-file"><input type="file" class="custom-file-input" name="images['+ count + ']" id="' + count +'" onchange="getFilename(this)"> <label class="custom-file-label">Choose file</label>')
    };
</script>
<div class="pd-30 card-box mb-10">
    {{-- <div class="col-2">
        <div class="pull-right">
            <a href=" {{ route('admins.index') }}">
                <button class="btn btn-info" type="reset" value="reset">
                    <i class="icon-copy ion-ios-undo"></i>
                    Quay Lại
                </button>
            </a>
        </div>
    </div> --}}
    <div class="clearfix" >
        <div class="pull-center" style="text-align: center">
            <h2 class="h1">Create Admin</h2>
        </div>
        
    </div>
    <div style="margin-left: 15%; margin-top: 50px">
        <form >
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Name</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" type="text" placeholder="Johnny Brown">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Email</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" value="abc@example.com" type="email">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Address</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" type="text" placeholder="Hà nội - Việt Nam">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Gender</label>
                <div class="col-sm-12 col-md-9">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio1">Male</label>
                    </div>
                    <div class="custom-control custom-radio mb-5=">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">Female</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio3">Other</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Phone</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" value="" type="tel">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Password</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" value="" type="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-datetime-local-input" class="col-sm-12 col-md-1 col-form-label">Ngày sinh</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control datetimepicker" placeholder="Choose Date anf time" type="text">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Select</label>
                <div class="col-sm-12 col-md-9">
                    <select class="custom-select col-12">
                        <option selected="">Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Input Range</label>
                <div class="form-group col-md-9" id="form_gr">
                    <div class="custom-file" style="display: block;" id="selected">
                    <input type="file" class="custom-file-input" name="images[0]" id="0" onchange="getFilename(this)">
                    <label class="custom-file-label"> chose image </label>
                    {{-- <button class="custom-file-label"></button> --}}
                    </div>
                </div>
                <div class="col-md-10" style="border: double;border-radius: 15px 15px 15px 15px;">
                    <div class="bd-example bd-example-images"  id="parent">
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <input style class=" col-md-2 btn btn-primary" type="submit" value="Submit">
                <input class="col-sm-1 btn btn-info" style="margin-left: 40px" type="reset" value="Reset">
            </div>
        </form>
    </div>
</div>
<div class="avatar-wrapper">
	<img class="profile-pic" src="" />
	<div class="upload-button">
		<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
	</div>
	<input class="file-upload" type="file" accept="image/*"/>
</div>
@endsection
@section('script')
<script src="src/plugins/dropzone/src/dropzone.js"></script>
<script src="vendors/scripts/advanced-components.js"></script>
<script src="src/plugins/switchery/switchery.min.js"></script>
<script src="src/avatar.js"></script>
@endsection
