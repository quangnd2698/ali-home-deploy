<input type="text" name="invoice_type" value="import" hidden>
{{-- <div class="card-box"> --}}
   
    
    <table class="table table-bordered ">
        <thead>
            <th>stt</th>
            <th>Tên sản phẩm</th>
            <th>Mã sản phẩm</th>
            <th>Đơn vị</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
            <th></th>
        </thead>
        <tbody id="table_import_body">
            @if (isset($importInvoice))
            @foreach ($importInvoice->importInvoiceDetail as $key => $detail)
            <tr id="tr{{$key}}">
                <td>{{$key+1}}
                    <input type="number" value="{{$detail->id}}" name="details[{{$key}}][id]" hidden>
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="text" class="form-control" name="details[{{$key}}][product_name]" value="{{$detail->product_name}}">
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="text" class="form-control " name="details[{{$key}}][product_code]" value="{{$detail->product_code}}">
                </td>
                <td style="padding: 0%; width: 10%;">
                    <input type="text" class="form-control" name="details[{{$key}}][unit]" value="{{$detail->product_unit}}">
                </td>
                <td style="padding: 0%; width: 10%;">
                    <input type="number" class="form-control" name="details[{{$key}}][quantity_product]" min="0" onchange="totalPrice({{$key}})" value="{{$detail->quantity_product}}">
                    <input type="number" class="form-control" name="details[{{$key}}][quantity_old]" min="0" value="{{$detail->quantity_product}}" hidden>
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="number" class="form-control" name="details[{{$key}}][price_product]" min="0" onchange="totalPrice({{$key}})" value="{{$detail->price_product}}">
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="number" class="form-control total_price" name="details[{{$key}}][total_price]" value="{{$detail->total_price}}">
                </td>
                <td style="padding: 2px" ><button type="button" style="padding: 5px 10px 5px 10px" onclick="del(this)" id="{{$key}}" class="btn btn-danger"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td>
            </tr>
            @endforeach
            @else
            {{-- <tr id="tr1">
                <td>1</td>
                <td style="padding: 0%; width: 20%;">
                    <input type="text" class="form-control" name="details[1][product_name]">
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="text" class="form-control " name="details[1][product_code]">
                </td>
                <td style="padding: 0%; width: 10%;">
                    <input type="text" class="form-control" name="details[1][unit]">
                </td>
                <td style="padding: 0%; width: 10%;">
                    <input type="number" class="form-control" name="details[1][quantity_product]" min="0" onchange="totalPrice(1)">
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="number" class="form-control" name="details[1][price_product]" min="0" onchange="totalPrice(1)">
                </td>
                <td style="padding: 0%; width: 20%;">
                    <input type="number" class="form-control total_price" name="details[1][total_price]">
                </td>
                <td style="padding: 2px" ><button type="button" style="padding: 5px 10px 5px 10px" onclick="del(this)" id="1" class="btn btn-danger"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td>
            </tr> --}}
            @endif
            <tfoot>
                <th colspan="5">
                    {{-- <button type="button" id="add_product" class="btn btn-primary"><i class="icon-copy fa fa-plus-circle" aria-hidden="true"></i> Thêm sản phẩm</button> --}}
                    
                </th>
                <th> Tổng</th>
                <th colspan="2">
                    <input class="form-control" id="total_cost" type="number" name="total_cost" readonly
                    @if (isset($importInvoice))
                        value="{{$importInvoice->total_cost}}"
                    @endif>
                </th>
            </tfoot>
        </tbody>
    </table>
    <input type="number" id="count_product" hidden 
    @if (isset($importInvoice))
    value="{{count($importInvoice->importInvoiceDetail)}}"
    @else
        value="{{0}}"
    @endif>

{{-- </div> --}}

