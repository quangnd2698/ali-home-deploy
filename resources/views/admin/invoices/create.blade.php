@extends('admin.layout.index')
@section('style')
<style>
    a {
        color: #333;
    }

.header-title {
    padding: 5px 10px;
    background: #dadada;
    font-weight: bold;
    width: 700px;
    }

.tt-menu {
    text-align: left;
}

</style>
@endsection
@section('content')
<script>
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    function getPointUse(item){

        var point_use = ($('input[name="point_used"]').length) ? Number($('input[name="point_used"]').val()) : 0;
        var percent = Number($('input[name="preferential"]').val());
        var total_cost = $('input[name="total_cost"]').val();
        // alert(data);
        var last_cost = Math.ceil(total_cost*((100-percent)/100) - (point_use*400));
        $('input[name="last_cost"]').val(last_cost);
        $('#last_money').text(formatNumber(last_cost) + " VNĐ");
        // alert(last_cost);
    }
    function sumTotal()
    {
        var total = 0;
        $('.total_price').each( function(k, v){
            total += Number($(this).val());
        });
        $('#total_cost').val(total);
        getPointUse()
        $('#cost_temporary').text(formatNumber(total)+ ' VNĐ')
    }
    function del(item) {
        var id = $(item).attr("id");
        $('#tr'+id).hide();
        $('#tr'+id).children().children().prop('disabled', true);
        $('#tr'+id).children().children().val(null);
        // var listProductSelected = $.cookie("list_product") ?? null;
        // var array = Array(listProductSelected)
        // // alert(Array(listProductSelected));
        // var index = listProductSelected.indexOf(id);
        // alert(listProductSelected.slice(0,index);
        // if (index > -1) {
        //     listProductSelected.splice(index, 1);
        // }
        sumTotal();
    }

    function totalPrice(id)
    {
        var quantity = $('input[name="details['+id+'][quantity_product]"]').val();
        var price = $('input[name="details['+id+'][price_product]"]').val();
        var total_price = quantity * price;
        $('input[name="details['+id+'][total_price]"]').val(total_price);
        sumTotal();
        $('#total_price-'+id).text(formatNumber(total_price));
    }
    
    function stt()
    {
        var stt = 0;
        $('.stt').each(function(){
            stt++
            $(this).html(stt);
        });
    }

    function getProduct(item, id)
    {
        if ($(item).is(':checked')) {
            var p_code = $('#product-code-'+id).text();
            var p_name = $('#product-name-'+id).text();
            var p_price = Number($('#product-price-'+id).val());
            var p_quantity = Number( $('#product-quantity-'+id).text())
            
            var text = '<tr id="product_had_selected-'+ id +'"><td  style="padding: 0%;" class="stt"><input type="text" value="'+ id +'" class="form-control" name="details['+ id +'][id]" hidden ></td><td style="padding: 0%; width: 30%;"><input type="text" class="form-control" value="'+p_name+'" name="details['+ id +'][product_name]" hidden>'+p_name+'</td><td style="padding: 0%; width: 20%;">'+p_code+'<input type="text" class="form-control " value="'+p_code+'" name="details['+id+'][product_code]" hidden></td><td style="padding: 0%; width: 10%;"><input type="number" class="form-control" name="details['+ id +'][quantity_product]" min="0" max="'+p_quantity+'" value="1" onchange="totalPrice('+ id +')"></td><td style="padding: 0%; width: 20%;">'+formatNumber(p_price)+'<input type="number" value="'+p_price+'" class="form-control" name="details['+id+'][price_product]" min="0" hidden></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control total_price" value="'+p_price+'" name="details['+id+'][total_price]" hidden><b id="total_price-'+id+'">'+formatNumber(p_price)+'</b></td><td style="padding: 0%; width: 20%;" style="padding: 2px;width: 15px;" ><button type="button" style="padding: 5px 10px 5px 10px" onclick="del(this)" id="'+id+'" class="btn btn-danger"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td></tr>';
            $('#table_import_body').append(text);
            stt();
            sumTotal();
        } else {
            $('#product_had_selected-'+id).remove();
            stt();
            sumTotal();
        }
    }
</script>
<div class="pd-20 card-box mb-10">
    <div class="flex-center position-ref full-height col-10" style="width: 700px;margin-top: 5px">
        <div class="content col-12" style="width: 700px">
            <form class=" col-12" role="search" style="width: 700px;">
                <input type="search" style="width: 700px;" name="q" class="form-control search-input col-12" placeholder="Tìm kiếm theo tên, mã sản phẩm" autocomplete="off">
            </form>
        </div>
    </div>
    <div style=" margin-top: 10px;">
        <div class=" card" >
            <form  action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.invoices.form')
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="vendors/scripts/datatable-setting.js"></script>
<script src="src/avatar.js"></script>
<script>
    // var count = $('#count_product').val();
    // $('#add_product').click( function(){
    //     count ++;
    //     var text = '<tr id="tr'+count + '"><td style="padding: 0%;">'+ count +'</td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control" name="details['+ count + '][product_name]"></td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control " name="details[' + count +'][product_code]"></td><td style="padding: 0%; width: 10%;"><input type="text" class="form-control" name="details['+ count +'][unit]"></td><td style="padding: 0%; width: 10%;"><input type="number" class="form-control" name="details['+ count +'][quantity_product]" min="0" onchange="totalPrice('+ count +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control" name="details['+ count +'][price_product]" min="0" onchange="totalPrice('+ count +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control total_price" name="details['+ count +'][total_price]"></td><td style="padding: 2px" ><button type="button" id="'+ count +'" style="padding: 5px 10px 5px 10px" class="btn btn-danger" onclick="del(this)"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td></tr>'
    //     $('#table_import_body').append(text);
    //     $('#count_product').val(count);
    // });
    
    function getPromotion() {
        var phone = $('input[name="customer_phone"').val();
        $.get("admin/orders/prices/"+phone, function(data) {
            $("#km").html(data[0]);
            $('input[name="preferential"]').val(data[2]);
        });
    }
    $(window).on("load", function() { 
        getPromotion();
    });

    $.cookie("list_product", { path: '/admin/invoices' });
    function addProduct(data) {
        var count = $('#count_product').val();
        var listProductSelected = $.cookie("list_product") ?? null;
        if (listProductSelected.indexOf(data.id) == -1) {

            listProductSelected += ','
            listProductSelected += data.id; 
            // alert(data.id);
            count ++;
            var text = '<tr class="tr_num" id="tr'+data.id + '"><td>'+ count +'</td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control" name="details['+ data.id + '][product_name]" value="'+ data.product_name+'" readonly></td><td style="padding: 0%; width: 20%;"><input type="text" class="form-control " name="details[' +data.id +'][product_code]" value="'+ data.product_code+'" readonly></td><td style="padding: 0%; width: 10%;"><input type="number" class="form-control" name="details['+ data.id +'][quantity_product]" min="0" value="1" onchange="totalPrice('+ data.id +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control" name="details['+ data.id +'][price_product]" min="0" value="'+ data.sale_price+'" readonly onchange="totalPrice('+ count +')"></td><td style="padding: 0%; width: 20%;"><input type="number" class="form-control total_price" name="details['+ data.id +'][total_price]" readonly ></td><td style="padding: 2px" ><button type="button" id="'+ data.id +'" style="padding: 5px 10px 5px 10px" class="btn btn-danger" onclick="del(this)"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button></td></tr>'
            $('#table_import_body').append(text);
            $('#count_product').val(count);
            totalPrice(data.id);
            $.cookie("list_product", listProductSelected, { path: '/admin/invoices' });
        
        }

    }

    $('#sub').click(function(){
        
        $.removeCookie("list_product", { path: '/admin/invoices' });
    });

    $(document).ready(function($) {
        var engine1 = new Bloodhound({
            remote: {
                url: '/search/product_name?value=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        // var engine2 = new Bloodhound({
        //     remote: {
        //         url: '/search/product_code?value=%QUERY%',
        //         wildcard: '%QUERY%'
        //     },
        //     datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        //     queryTokenizer: Bloodhound.tokenizers.whitespace
        // });

        $(".search-input").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, [
            {
                source: engine1.ttAdapter(),
                name: 'students-name',
                display: function(data) {
                    return data.name;
                },
                templates: {
                    empty: [
                        // '<div class="header-title" style="width=500px;">Tên sản phẩm</div><div style="width=500px;" class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="header-title"></div><div class="list-group search-results-dropdown"></div>'
                    ],
                    suggestion: function (data) {
                        // var product = $.makeArray(data);
                        // alert(JSON.stringify(data))
                        // JSON.stringify(data)
                        // var list = ;
                        return "<a onclick='addProduct("+JSON.stringify(data)+")' class='btn list-group-item list-group-item-action'><div class='row'><div class='col-4'><img style='width: 50px; height: 50px;' src='images/products/product1.jpg' alt=''></div><div class='col-8'><h6>" + data.product_name + "</h6><p>" + data.product_code + "<span style='margin-left: 15%'>" + data.sale_price + "</span></p></div></div></a>";
                        // return "<br><a onclick='addProduct("+list+")'>"+data.id+"</a><br>"
// <a onclick="addProduct('+data+')" class="btn"><div class="row"><div class="col-4"><img style="width: 50px; height: 50px;" src="images/products/product1.jpg" alt=""></div><div class="col-8"><h6>'+data.product_name+'</h6><p>'+data.product_code+'<span>'+data.sale_price+'</span></p></div></div></a>
                    }
                }
            }, 
            // {
            //     source: engine2.ttAdapter(),
            //     name: 'students-email',
            //     display: function(data) {
            //         return data.email;
            //     },
            //     templates: {
            //         empty: [
            //             '<div class="header-title"></div>Mã sản phẩm<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            //         ],
            //         header: [
            //             '<div class="header-title"></div><div class="list-group search-results-dropdown"></div>'
            //         ],
            //         suggestion: function (data) {
            //             return "<a onclick='addProduct("+ JSON.stringify(data) +")' class='btn list-group-item list-group-item-action'><div class='row'><div class='col-4'><img style='width: 50px; height: 50px;' src='images/products/product1.jpg' alt=''></div><div class='col-8'><h6>" + data.product_name + "</h6><p>" + data.product_code + "<span style='margin-left: 15%'>" + data.sale_price + "</span></p></div></div></a>";
            //         }
            //     }
            // }
        ]);
    });
</script>
@endsection