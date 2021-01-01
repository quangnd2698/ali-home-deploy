@extends('admin.layout.index')
@section('style')
<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('content')
{{-- <div class="main-container"> --}}
    {{-- <div class="pd-ltr-20"> --}}
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="vendors/images/banner-img.png" alt="">
                </div>
                <div class="col-md-8">
                        <div class="weight-600 font-30 text-blue" style="text-align: center">Thống kê</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="widget-data col-12">
                            <div class="h4 mb-0" style="text-align: center">{{$data['count_invoice']}}</div>
                            <div class="weight-600 font-25" style="text-align: center">Đơn hàng thành công</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="widget-data col-12">
                            <div class="h4 mb-0" style="text-align: center">{{$data['count_product']}}</div>
                            <div class="weight-600 font-14" style="text-align: center">Sản phẩm</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="widget-data col-12">
                            <div class="h4 mb-0" style="text-align: center">{{$data['count_user']}}</div>
                            <div class="weight-600 font-14" style="text-align: center">Thành viên</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="widget-data col-12">
                            <div class="h4 mb-0" style="text-align: center">{{$data['count_admin']}}</div>
                            <div class="weight-600 font-14" style="text-align: center">Nhân viên</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="bg-white pd-20 card-box mb-30">
					<div id="chart4"></div>
				</div>
            </div>
            <div class="col-xl-4 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Tỷ lệ doanh thu theo sản phẩm</h2>
                    <div id="chart5"></div>
                </div>
            </div>
        </div>
        <div class="card-box mb-30">
            <h2 class="h4 pd-20">Top sản phẩm bán chạy nhất</h2>
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Product</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lần mua</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['products'] as $product)
                    <tr>
                        <td class="table-plus">
                            <img @if($product->images->first()) src="images/products/{{$product->images->first()->name}}" @else src="images/products/product.jpg" @endif width="70" height="70" alt="">
                        </td>
                        <td>
                            <h5 class="font-16">{{$product->product_code}}</h5>
                        </td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->count_buy}}</td>
                        <td>{{$product->sale_price}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>

@endsection
@section('script')
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
    <script src="vendors/scripts/highchart-setting.js"></script>
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="vendors/scripts/apexcharts-setting.js"></script>
    <script>
        var sales = <?= json_encode($data['sales']) ?>;
        var sale_now = sales.now;
        var sale_pre1 = sales.pre1;
        var sale_pre2 = sales.pre2;
        var sale_pre3 = sales.pre3;

        var month = <?= json_encode($data['month']) ?>;
        var now = month.now;
        var pre1 = month.pre1;
        var pre2 = month.pre2;
        var pre3 = month.pre3;
        // var s = 1;
        Highcharts.chart('chart4', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Biểu đồ lợi nhuận 4 tháng gần nhât'
            },
            subtitle: {
                text: 'Dựa theo thống kê hóa đơn'
            },
            xAxis: {
                categories: [
                'Tháng ' + pre3,
                'Tháng' + pre2,
                'Tháng' + pre1,
                'Tháng' + now
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Doanh Thu (Triệu)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tất cả',
                data: [sale_pre3.all, sale_pre2.all, sale_pre1.all, sale_now.all]

            }, {
                name: 'Gạch men',
                data: [sale_pre3.ceramic, sale_pre2.ceramic, sale_pre1.ceramic, sale_now.ceramic]

            }, {
                name: 'TBVS',
                data: [sale_pre3.tbvs, sale_pre2.tbvs, sale_pre1.tbvs, sale_now.tbvs]

            }]
        });

        var price_type = <?= json_encode($data['price_type']) ?>;
        // chart 5
        Highcharts.chart('chart5', {
            title: {
                text: 'Dựa trên thống kê hóa đơn'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                ['gạch lát', price_type.gach_lat, false],
                ['gạch ốp', price_type.gach_op, false],
                ['gạch bong', price_type.gach_bong, false],
                ['gạch trang trí', price_type.gach_trang_tri, false],
                ['gạch vỉa hè', price_type.gach_via_he, false],
                ['gạch giả gỗ', price_type.gach_gia_go, false],
                ['bồn cầu', price_type.bon_cau, true, true],
                ['PKNT', price_type.PKNT, false],
                ['TBNL', price_type.TBNL, false]
                ],
                showInLegend: true
            }]
        });
    </script>
@endsection
