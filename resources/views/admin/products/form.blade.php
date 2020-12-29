{{-- <h5>Thông tin sản phẩm</h5> --}}
<section>
    <div class="row" style="margin-left: 5%">
        <div class="col-md-6">
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('product_code')) {{'has-danger'}} @endif">
                    <label>Mã sản phẩm </label>
                    <input type="text" class="form-control @if ($errors->has('product_code')) {{'form-control-danger'}} @endif"
                        name="product_code" placeholder="mã tự động: SP-001"
                        @if(isset($product))
                        value="{{$product->product_code}}"
                    @endif>
                    @if ($errors->has('product_code'))
                        <p style="color: red">{{ $errors->first('product_code') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('product_name')) {{'has-danger'}} @endif">
                    <label>Tên sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                    <input type="text" class="form-control @if ($errors->has('product_name')) {{'form-control-danger'}} @endif"
                        name="product_name"
                    @if(isset($product))
                        value="{{$product->product_name}}"
                    @endif>
                    @if ($errors->has('product_name'))
                        <p style="color: red">{{ $errors->first('product_name') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group col-md-9 @if ($errors->has('product_type')) {{'has-danger'}} @endif">
                <label>Loại sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                <select class="custom-select form-control" name="product_type" id="product_type">
                    <option value="">Chọn loại sản phẩm</option>
                    <option value="ceramic" @if(isset($product) && $product->product_type == 'ceramic') {{'selected'}} @endif>Gạch</option>
                    <option value="TBVS" @if(isset($product) && $product->product_type == 'TBVS') {{'selected'}} @endif>Thiết bị vệ sinh</option>
                </select>
                @if ($errors->has('product_type'))
                    <p style="color: red">{{ $errors->first('product_type') }}</p>
                @endif
            </div>
            <div class="form-group col-md-9 @if ($errors->has('type_code')) {{'has-danger'}} @endif">
                <label>Dòng sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                {{-- <div class="row col-12"> --}}
                    <select class="custom-select form-control col-12" name="type_code" id="type_code">
                        <option value="">Chọn dòng sản phẩm</option>
                        <option @if(isset($product) && $product->type_code == 'gach-lat') {{'selected'}} @endif value="gach-lat">Gạch lát nền</option>
                        <option @if(isset($product) && $product->type_code == 'gach-op') {{'selected'}} @endif value="gach-op">Gạch ốp tường</option>
                        <option @if(isset($product) && $product->type_code == 'gach-bong') {{'selected'}} @endif value="gach-bong">Gạch bông</option>
                        <option @if(isset($product) && $product->type_code == 'gach-trang-tri') {{'selected'}} @endif value="gach-trang-tri">Gạch trang trí</option>
                        <option @if(isset($product) && $product->type_code == 'gach-via-he') {{'selected'}} @endif value="gach-via-he">Gạch vỉa hè</option>
                        <option @if(isset($product) && $product->type_code == 'gach-gia-go') {{'selected'}} @endif value="gach-gia-go">Gạch giả gỗ</option>
                        <option @if(isset($product) && $product->type_code == 'bon-cau') {{'selected'}} @endif value="bon-cau">Bồn cầu</option>
                        <option @if(isset($product) && $product->type_code == 'PKNT') {{'selected'}} @endif value="PKNT">Phụ kiện nhà tắm</option>
                        <option @if(isset($product) && $product->type_code == 'TBNL') {{'selected'}} @endif value="TBNL">Thiết bị nóng lạnh</option>

                        {{-- @foreach ($models as $model)
                        <option value="{{$model->type_code}}" @if(isset($product) && $product->type_code = $model->type_code) {{'selected'}} @endif>{{$model->product_model}}</option>
                        @endforeach --}}
                    </select>
                
                @if ($errors->has('type_code'))
                    <p style="color: red">{{ $errors->first('type_code') }}</p>
                @endif
                
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('producer')) {{'has-danger'}} @endif">
                    <label>Nhà sản xuất <span style="color: red; font-size: 20px">*</span></label>
                    <div class="row col-12">
                        <select class="custom-select form-control col-11" name="producer" id="product_type">
                            {{-- <option @if(isset($product) && isset($product->producer)) {{'selected'}} @endif value="">{{$product->producer}}</option> --}}
                            @foreach ($brands as $brand)
                            <option value="{{$brand->brand_name}}" @if(isset($product) && $product->producer == $brand->brand_name) {{'selected'}} @endif>{{$brand->brand_name}}</option>
                            @endforeach
                        </select>
                        <div class="col-1">
                            <button type="button" data-toggle="modal" data-target="#bd-example-modal-lg-brand" class="btn btn-success" style="padding: 4px"><i class="fa fa-2x fa-plus-square"></i></button>
                        </div>
                    </div>
                    @if ($errors->has('producer'))
                        <p style="color: red">{{ $errors->first('producer') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
            <label class="weight-600">Kích thước</label>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size1" name="size" class="custom-control-input">
                        <label class="custom-control-label" for="size1">10x10</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size2" name="size" class="custom-control-input" value="20x20"
                        @if(isset($product) && $product->size == '20x20')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size2">20x20</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size3" name="size" class="custom-control-input" value="30x30"
                        @if(isset($product) && $product->size == '30x30')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size3">30x30</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size4" name="size" class="custom-control-input" value="40x40"
                        @if(isset($product) && $product->size == '40x40')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size4">40x40</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size5" name="size" class="custom-control-input" value="50x50"
                        @if(isset($product) && $product->size == '50x50')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size5">50x50</label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size6" name="size" class="custom-control-input" value="60x60"
                        @if(isset($product) && $product->size == '60x60')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size6">60x60</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size7" name="size" class="custom-control-input" value="10x40"
                        @if(isset($product) && $product->size == '10x40')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size7">10x40</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size8" name="size" class="custom-control-input" value="10x40"
                        @if(isset($product) && $product->size == '10x40')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size8">10x40</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size9" name="size" class="custom-control-input" value="20x30"
                        @if(isset($product) && $product->size == '20x30')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size9">20x30</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="size10" name="size" class="custom-control-input" value="30x60"
                        @if(isset($product) && $product->size == '30x60')
                            {{'checked'}}
                        @endif>
                        <label class="custom-control-label" for="size10">30x60</label>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('material')) {{'has-danger'}} @endif">
                    <label>Chất liệu </label>
                    <input type="text" class="form-control @if ($errors->has('material')) {{'form-control-danger'}} @endif"
                        name="material"
                    @if(isset($product))
                        value="{{$product->material}}"
                    @endif>
                    @if ($errors->has('material'))
                        <p style="color: red">{{ $errors->first('material') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('color')) {{'has-danger'}} @endif">
                    <label>Màu sắc </label>
                    <input type="text" class="form-control @if ($errors->has('color')) {{'form-control-danger'}} @endif"
                        name="color"
                    @if(isset($product))
                        value="{{$product->color}}"
                    @endif>
                    @if ($errors->has('color'))
                        <p style="color: red">{{ $errors->first('color') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('surface')) {{'has-danger'}} @endif">
                    <label>Bề mặt </label>
                    <input type="text" class="form-control @if ($errors->has('surface')) {{'form-control-danger'}} @endif"
                        name="surface"
                    @if(isset($product))
                        value="{{$product->surface}}"
                    @endif>
                    @if ($errors->has('surface'))
                        <p style="color: red">{{ $errors->first('surface') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('uses_for')) {{'has-danger'}} @endif">
                    <label>Chức Năng </label>
                    <input type="text" name="uses_for" class="form-control @if ($errors->has('uses_for')) {{'form-control-danger'}} @endif"
                    @if(isset($product))
                    value="{{$product->uses_for}}"
                    @endif>
                    @if ($errors->has('uses_for'))
                        <p style="color: red">{{ $errors->first('uses_for') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('quantity_in_one_box')) {{'has-danger'}} @endif">
                    <label>Số đơn vị/ hộp </label>
                    <input type="number" name="quantity_in_one_box"
                        class="form-control @if ($errors->has('quantity_in_one_box')) {{'form-control-danger'}} @endif"
                        @if(isset($product))
                        value="{{$product->quantity_in_one_box}}"
                    @endif>
                    @if ($errors->has('quantity_in_one_box'))
                        <p style="color: red">{{ $errors->first('quantity_in_one_box') }}</p>
                    @endif
                </div>
            </div>
            
            {{-- <div class="col-md-9">
                <div class="form-group @if ($errors->has('quantity')) {{'has-danger'}} @endif">
                    <label>Số lượng <span style="color: red; font-size: 20px">*</span></label>
                    <input type="number" name="quantity"
                        class="form-control @if ($errors->has('quantity')) {{'form-control-danger'}} @endif"
                        @if(isset($product))
                        value="{{$product->quantity}}"
                    @endif>
                    @if ($errors->has('quantity'))
                        <p style="color: red">{{ $errors->first('quantity') }}</p>
                    @endif
                </div>
            </div> --}}
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('import_price')) {{'has-danger'}} @endif">
                    <label>Giá vốn <span style="color: red; font-size: 20px">*</span></label>
                    <input type="number" name="import_price"
                        class="form-control @if ($errors->has('import_price')) {{'form-control-danger'}} @endif"
                        @if(isset($product))
                        value="{{$product->import_price}}"
                    @endif>
                    @if ($errors->has('import_price'))
                        <p style="color: red">{{ $errors->first('import_price') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('sale_price')) {{'has-danger'}} @endif">
                    <label>Giá bán <span style="color: red; font-size: 20px">*</span></label>
                    <input type="number" name="sale_price"
                        class="form-control @if ($errors->has('sale_price')) {{'form-control-danger'}} @endif"
                        @if(isset($product))
                        value="{{$product->sale_price}}"
                    @endif>
                    @if ($errors->has('sale_price'))
                        <p style="color: red">{{ $errors->first('sale_price') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group @if ($errors->has('sale_on_web')) {{'has-danger'}} @endif">
                    <label>Bán trên Website </label>
                    <div class="custom-control custom-checkbox mb-5">
                        <input type="checkbox" name="sale_on_web" class="custom-control-input"
                            @if(isset($product) && $product->sale_on_web = '')
                            @else {{'checked'}}
                            @endif
                            id="customCheck1">
                        <label class="custom-control-label" for="customCheck1"></label>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label>Mô tả </label>
                    <textarea name="description" class="form-control">@if(isset($product)){{$product->description}}@endif</textarea>
                @if ($errors->has('description'))
                        <p style="color: red">{{ $errors->first('description') }}</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div style="margin-left: 5%">
        <div class="form-group">
            <label class="col-md-2 col-form-label">Thêm hình ảnh</label>
            <div class="form-group col-md-10" id="form_gr">
                <div class="custom-file" style="display: block;" id="selected">
                    <input type="file" class="custom-file-input" name="images[0]" id="0" onchange="getFilename(this)">
                    <label class="custom-file-label"> chose image </label>
                    {{-- <button class="custom-file-label"></button>
                    --}}
                </div>
            </div>
            <div class="col-md-10">
                <div class=" bd-example bd-example-images row" id="parent">
                    @if (isset($product->images))
                        @foreach ($product->images as $image)
                        <div class="col-3" id="image-{{$image->id}}"><img src= "images/products/{{$image->name}}" alt="..." class="img-thumbnail" style="height: 200px; width: 200px" >
                            <div>
                                <button type="button" class="btn btn-danger col-12" onclick="removeImagePlus({{$image->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center col-sm-12" style="margin-top: 100px">
        <input style class="col-sm-12 col-md-2 btn btn-primary" type="submit" value="Submit" id="submit">
    </div>
</section>
<div class="modal fade bs-example-modal-lg"  id="bd-example-modal-lg-product_model" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Thêm dòng sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{-- <form action="" method="post" style="margin-left: 10%"> --}}
                    @csrf
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Tên dòng sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                            <input type="text" name="product_model"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Mã dòng <span style="color: red; font-size: 20px">*</span></label>
                            <input type="text" name="type_code_model"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label>Loại sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                        <select class="custom-select form-control" name="product_type_model">
                            <option value="">Chọn loại sản phẩm</option>
                            <option value="ceramic" >Gạch</option>
                            <option value="TBVS">Thiết bị vệ sinh</option>
                        </select>
                    </div>
                    <button type="button"  onclick="storeProductModel()" class="btn btn-success col-12">Tạo</button>
                {{-- </form> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="submit_models" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg"  id="bd-example-modal-lg-brand" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Thêm hãng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{-- <form action="" method="post" style="margin-left: 10%"> --}}
                    @csrf
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Tên hãng <span style="color: red; font-size: 20px">*</span></label>
                            <input type="text" name="brand_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label>Loại sản phẩm <span style="color: red; font-size: 20px">*</span></label>
                        <select class="custom-select form-control" name="brand_type">
                            <option value="">Chọn loại sản phẩm</option>
                            <option value="ceramic" >Gạch</option>
                            <option value="TBVS">Thiết bị vệ sinh</option>
                        </select>
                    </div>
                    <button type="button"  onclick="storeBrand()" class="btn btn-success col-12">Tạo</button>
                {{-- </form> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

