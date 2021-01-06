<div class="form-group row @if ($errors->has('name')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Tên</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('name')) {{'form-control-danger'}} @endif" 
            name="name" type="text" placeholder="Johnny Brown"
            @if(isset($admin))
                value="{{$admin->name}}"
            @endif>
        @if ($errors->has('name'))
            <p style="color: red">{{ $errors->first('name') }}</p>
        @endif
    </div>
</div>
<div class="form-group row @if ($errors->has('email')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Email</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('email')) {{'form-control-danger'}} @endif"
        name="email" placeholder="abc@example.com" type="email"
        @if(isset($admin))
            value="{{$admin->email}}"
        @endif>
        @if ($errors->has('email'))
            <p style="color: red">{{ $errors->first('email') }}</p>
        @endif
    </div>
</div>

<div class="form-group row @if ($errors->has('address')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Địa chỉ</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('address')) {{'form-control-danger'}} @endif"
        name="address" type="text" placeholder="Hà nội - Việt Nam"
            @if(isset($admin))
                value="{{$admin->address}}"
            @endif>
        @if ($errors->has('address'))
            <p style="color: red">{{ $errors->first('address') }}</p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Giới Tính</h6></label>
    <div class="col-sm-12 col-md-8">
        <div class="custom-control custom-radio mb-5">
            <input type="radio" id="customRadio1" value="male" name="gender" class="custom-control-input" checked>
            <label class="custom-control-label" for="customRadio1">Nam</label>
        </div>
        <div class="custom-control custom-radio mb-5=">
            <input type="radio" id="customRadio2" value="female" name="gender" class="custom-control-input" 
            @if (isset($admin) && $admin->gender == 'female') {{'checked'}} @endif>
            <label class="custom-control-label" for="customRadio2">Nữ</label>
        </div>
    </div>
</div>
<div class="form-group row @if ($errors->has('phone')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Số Điện Thoại</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('phone')) {{'form-control-danger'}} @endif"
            name="phone" type="tel"
            @if(isset($admin))
                value="{{$admin->phone}}"
            @endif>
        @if ($errors->has('phone'))
            <p style="color: red">{{ $errors->first('phone') }}</p>
        @endif
    </div>
</div>
<div class="form-group row @if ($errors->has('password')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Mật Khẩu</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('password')) {{'form-control-danger'}} @endif"
            name="password" type="password"
            @if(isset($admin))
                value="{{$admin->password}}"
            @endif>
        @if ($errors->has('password'))
            <p style="color: red">{{ $errors->first('password') }}</p>
        @endif
    </div>
</div>

<div class="form-group row" id="div_confirm">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Xác Nhận Mật Khẩu</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control"
            name="confirm_password" value="" type="password">

        <div class="form-control-feedback" id="text_confirm"></div>
    </div>
</div>

<div class="form-group row @if ($errors->has('date_of_birth')) {{'has-danger'}} @endif">
    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label"><h6>Ngày Sinh</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('date_of_birth')) {{'form-control-danger'}} @endif date-picker"
            name="date_of_birth" placeholder="Choose Date anf time" type="text"
            @if(isset($admin))
                value="{{$admin->date_of_birth}}"
            @endif>
        @if ($errors->has('date_of_birth'))
            <p style="color: red">{{ $errors->first('date_of_birth') }}</p>
        @endif
    </div>
</div>

<div class="form-group row @if ($errors->has('email')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Chức Vụ</h6></label>
    <div class="col-sm-12 col-md-8">
        <select class="custom-select form-control" name="permission">
            <option value="">Chọn loại nhân viên</option>
            @if(isset($admin) && $admin->permission === 1) <option value="1" selected>Chủ cửa hàng</option> @endif
            <option value="2" @if(isset($admin) && $admin->permission == 2) {{'selected'}} @endif>Nhân viên bán hàng</option>
            <option value="3" @if(isset($admin) && $admin->permission == 3) {{'selected'}} @endif>Nhân viên kho</option>
            <option value="4" @if(isset($admin) && $admin->permission == 4) {{'selected'}} @endif>Nhân viên thị trường</option>
            {{-- <option value="ceramic" @if(isset($admin) && $admin->permission = '2') {{'selected'}} @endif>Nhân viên </option> --}}
        </select>
        @if ($errors->has('permission'))
        <p style="color: red">{{ $errors->first('permission') }}</p>
    @endif
    </div>
   
</div>

<div class="form-group row @if ($errors->has('basic_salary')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Lương cơ bản</h6></label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('basic_salary')) {{'form-control-danger'}} @endif"
        name="basic_salary" type="number"
            @if(isset($admin))
                value="{{$admin->basic_salary}}"
            @endif>
        @if ($errors->has('basic_salary'))
            <p style="color: red">{{ $errors->first('basic_salary') }}</p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-12 col-md-2 col-form-label"><h6>Ảnh</h6></label>
    <div class="form-group col-md-9" id="form_gr">
        <div class="col-sm-12 col-md-8">
            <input type="file" class="custom-file-input" name="image" id="image"
            @if(isset($admin))
                value="{{$admin->image}}"
            @endif>
            <label class="custom-file-label"> Chọn ảnh </label>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label"></label>
    <div class="col-sm-12 col-md-3" id="div_avatar">
        <img id="img_avartar" class="img-thumbnail" style="width: 200px" 
        @if(isset($admin)) {{$admin->image}}
            src = "images/admins/{{$admin->image}}"
        @else
            src = "images/admins/avatar.jpg"
        @endif >
    </div>
</div>
<br>
<div class="row justify-content-md-center col-sm-12">
    <input style class="col-sm-12 col-md-2 btn btn-primary" type="submit" value="Lưu" id="submit">
</div>