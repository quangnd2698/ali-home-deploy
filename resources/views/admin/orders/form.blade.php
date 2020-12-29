{{-- <div class="form-group row @if ($errors->has('customer_name')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">Tên khách hàng</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('customer_name')) {{'form-control-danger'}} @endif" 
            name="customer_name" type="text" placeholder="Johnny Brown"
            @if(isset($order))
                value="{{$order->customer_name}}"
            @endif>
        @if ($errors->has('customer_name'))
            <p style="color: red">{{ $errors->first('customer_name') }}</p>
        @endif
    </div>
</div>
<div class="form-group row @if ($errors->has('customer_address')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">Địa chỉ</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('customer_address')) {{'form-control-danger'}} @endif"
        name="customer_address" placeholder="abc@example.com" type="customer_address"
        @if(isset($order))
            value="{{$order->customer_address}}"
        @endif>
        @if ($errors->has('customer_address'))
            <p style="color: red">{{ $errors->first('customer_address') }}</p>
        @endif
    </div>
</div>

<div class="form-group row @if ($errors->has('customer_phone')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label" >Số điện thoại</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('customer_phone')) {{'form-control-danger'}} @endif"
        name="customer_phone" type="text" placeholder="Hà nội - Việt Nam"
            @if(isset($order))
                value="{{$order->customer_phone}}"
            @endif>
        @if ($errors->has('customer_phone'))
            <p style="color: red">{{ $errors->first('customer_phone') }}</p>
        @endif
    </div>
</div> --}}
{{-- <div class="form-group row">
    <label class="col-sm-12 col-md-2 col-form-label">Gender</label>
    <div class="col-sm-12 col-md-8">
        <div class="custom-control custom-radio mb-5">
            <input type="radio" id="customRadio1" value="male" name="gender" class="custom-control-input" checked>
            <label class="custom-control-label" for="customRadio1">Male</label>
        </div>
        <div class="custom-control custom-radio mb-5=">
            <input type="radio" id="customRadio2" value="female" name="gender" class="custom-control-input" 
            @if (isset($order) && $order->gender == 'female') {{'checked'}} @endif>
            <label class="custom-control-label" for="customRadio2">Female</label>
        </div>
        <div class="custom-control custom-radio mb-5">
            <input type="radio" id="customRadio3" value="other" name="gender" class="custom-control-input"
            @if (isset($order) && $order->gender == 'other') {{'checked'}} @endif>
            <label class="custom-control-label" for="customRadio3">Other</label>
        </div>
    </div>
</div> --}}
{{-- <div class="form-group row">
    <label class="col-sm-12 col-md-2 col-form-label">Sản phẩm</label>
    <div class="col-sm-12 col-md-8">
        <select id="product" name="product" class="custom-select2 form-control" multiple="multiple" style="width: 100%;">
            @foreach ($products as $product)
            <option value="{{$product->id}}" label="{{$product->price}}">{{$product->product_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row @if ($errors->has('total_prices')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">total_prices</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('total_prices')) {{'form-control-danger'}} @endif"
            name="total_prices" type="tel"
            @if(isset($order))
                value="{{$order->total_prices}}"
            @endif>
        @if ($errors->has('total_prices'))
            <p style="color: red">{{ $errors->first('total_prices') }}</p>
        @endif
    </div>
</div>
<div class="form-group row @if ($errors->has('preferential')) {{'has-danger'}} @endif">
    <label class="col-sm-12 col-md-2 col-form-label">preferential</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control @if ($errors->has('preferential')) {{'form-control-danger'}} @endif"
            name="preferential"
            @if(isset($order))
                value="{{$order->preferential}}"
            @endif>
        @if ($errors->has('preferential'))
            <p style="color: red">{{ $errors->first('preferential') }}</p>
        @endif
    </div>
</div>

<div class="form-group row" id="div_confirm">
    <label class="col-sm-12 col-md-2 col-form-label">cost</label>
    <div class="col-sm-12 col-md-8">
        <input class="form-control"
            name="cost" value="" type="password">

        <div class="form-control-feedback" id="text_confirm"></div>
    </div>
</div> --}}
<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Tên</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control" 
                    name="customer_name" type="text" placeholder="Johnny Brown">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Số điện thoại</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control" name="customer_phone" id="phone" onchange="getPromotion()">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">địa chỉ</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control" name="customer_address">
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="pd-20 card-box height-100-p">
            <h4 class="mb-20 h4">Hóa Đơn</h4>
            <ul class="list-group list-group-flush">
                @foreach ($carts as $cart)
                <li class="list-group-item">Sản Phẩm: {{$cart->product->product_name}}</li>
                <li class="list-group-item price">Giá: {{$cart->product->price}}</li>
                <li class="list-group-item price">Số lượng: {{$cart->quantity}}</li>
                @endforeach
                <hr style="background-color: red">
                <li class="list-group-item">Tạm tính: {{number_format($totalPrice, 0, ',', '.')}} vnđ</li>
                <li class="list-group-item">Khuyến mại:
                    <div class="row" id="km"></div>
                </li>
                <li class="list-group-item"><div class="row">
                    <p class="col-4">Thành tiền:</p>
                    <h5 class="col-3" style="color: red" id="last_money">{{number_format($totalPrice, 0, ',', '.')}}</h5> VNĐ
                </li>
            </ul>
        </div>
    </div>
</div>
<input type="text" name="products_id" hidden>
<input type="number" hidden name="point_used">
<input type="text" hidden name="cost">
<input type="number" hidden name="preferential">
<div class="row justify-content-md-center col-sm-12">
    <input style class="col-sm-12 col-md-2 btn btn-primary" type="submit" value="Submit" id="submit">
    <button class="col-sm-2 btn btn-info" style="margin-left: 40px" >
        <i class="icon-copy ion-refresh"></i>
        Reset
    </button>
</div>