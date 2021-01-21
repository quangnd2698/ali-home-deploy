<div class="form-group row @if ($errors->has('name')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">Tên</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('name')) {{'form-control-danger'}} @endif" 
            name="name" type="text" placeholder="Johnny Brown"
            @if(isset($user))
                value="{{$user->name}}"
            @endif>
        @if ($errors->has('name'))
            <p style="color: red">{{ $errors->first('name') }}</p>
        @endif
    </div>
</div>
<div class="form-group row @if ($errors->has('email')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('email')) {{'form-control-danger'}} @endif"
        name="email" placeholder="abc@example.com" type="email"
        @if(isset($user))
            value="{{$user->email}}"
        @endif>
        @if ($errors->has('email'))
            <p style="color: red">{{ $errors->first('email') }}</p>
        @endif
    </div>
</div>

<div class="form-group row @if ($errors->has('address')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label" >Địa Chỉ</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('address')) {{'form-control-danger'}} @endif"
        name="address" type="text" placeholder="Hà nội - Việt Nam"
            @if(isset($user))
                value="{{$user->address}}"
            @endif>
        @if ($errors->has('address'))
            <p style="color: red">{{ $errors->first('address') }}</p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-12 col-md-2 col-form-label">Giới Tính</label>
    <div class="col-sm-12 col-md-8">
        <div class="custom-control custom-radio mb-5">
            <input type="radio" id="customRadio1" value="male" name="gender" class="custom-control-input" checked>
            <label class="custom-control-label" for="customRadio1">Nam</label>
        </div>
        <div class="custom-control custom-radio mb-5=">
            <input type="radio" id="customRadio2" value="female" name="gender" class="custom-control-input" 
            @if (isset($user) && $user->gender == 'female') {{'checked'}} @endif>
            <label class="custom-control-label" for="customRadio2">Nữ</label>
        </div>
    </div>
</div>
<div class="form-group row @if ($errors->has('phone')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">Số Điện Thoại</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('phone')) {{'form-control-danger'}} @endif"
            name="phone" type="tel"
            @if(isset($user))
                value="{{$user->phone}}"
            @endif>
        @if ($errors->has('phone'))
            <p style="color: red">{{ $errors->first('phone') }}</p>
        @endif
    </div>
</div>
<div class="form-group row @if ($errors->has('password')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">Mật Khẩu</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('password')) {{'form-control-danger'}} @endif"
            name="password" type="password"
            @if(isset($user))
                value="{{$user->password}}"
            @endif>
        @if ($errors->has('password'))
            <p style="color: red">{{ $errors->first('password') }}</p>
        @endif
    </div>
</div>

<div class="form-group row" id="div_confirm">
    <label class="col-sm-12 col-md-2 col-form-label">Xác Nhận Mật Khẩu</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control"
            name="confirm_password" value="" type="password">

        <div class="form-control-feedback" id="text_confirm"></div>
    </div>
</div>

<div class="form-group row @if ($errors->has('date_of_birth')) {{'has-danger'}} @endif">
    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Ngày Sinh</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('date_of_birth')) {{'form-control-danger'}} @endif date-picker"
            name="date_of_birth" placeholder="Choose Date anf time" type="text"
            @if(isset($user))
                value="{{$user->date_of_birth}}"
            @endif>
        @if ($errors->has('date_of_birth'))
            <p style="color: red">{{ $errors->first('date_of_birth') }}</p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>
    <div class="form-group col-md-9" id="form_gr">
        <div class="col-sm-12 col-md-8">
            <input type="file" class="custom-file-input" name="avatar" id="image"
            @if(isset($user))
                value="{{$user->avatar}}"
            @endif>
            <label class="custom-file-label"> Chọn Ảnh </label>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label"></label>
    <div class="col-sm-12 col-md-3" id="div_avatar">
        <img id="img_avartar" class="img-thumbnail" style="width: 200px" 
        @if(isset($user) && $user->avatar) {{$user->avatar}}
            src = "images/users/{{$user->avatar}}"
        @else
            src = "images/admins/avatar.jpg"
        @endif>
    </div>
</div>
<br>
<div class="row justify-content-md-center col-sm-12">
    <input style class="col-sm-12 col-md-2 btn btn-primary" type="submit" value="Lưu" id="submit">
    <button class="col-sm-2 btn btn-info" style="margin-left: 40px" >
        <i class="icon-copy ion-refresh"></i>
        Reset
    </button>
</div>