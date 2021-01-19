@extends('client.index')
@section('content')

    {{-- <div id="content"> --}}
        <div id="content" style="min-height: 500px; margin-bottom: 20px">
            <div class="container">

                <div class="col-12" style="margin-top: 10%">
                    <h3>Giao hàng miễn phí trong khu vực</h3>
                    <br>
                </div>
                <div class="row col-12">
                    <div class="col-1"></div>
                    <div class="col-10 row pd-20" style="border: 2px solid gold">
                        <div class="col-4 row" style="border-right: 2px solid black;">
                            <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-history"></i></div>
                            <div class="col-9">
                                <h5>Thời gian áp dụng</h5>
                                <h6>Áp dụng mọi lúc</h6>
                            </div>

                        </div>
                        <div class="col-4 row" style="border-right: 2px solid black; margin-left: 5px">
                            <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-life-ring"></i></i></div>
                            <div class="col-9">
                                <h5>Đối tượng áp dụng</h5>
                                <h6>Mọi khách hàng tại showroom
                                    hoặc trực tuyến của Ali-home</h6>
                            </div>

                        </div>
                        <div class="col-4 row" style="margin-left: 5px">
                            <div style="color: goldenrod" class="col-3"><i class="fa fa-3x fa-rocket"></i></div>
                            <div class="col-9">
                                <h5>Phạm vi chương trình</h5>
                                <h6>Áp dụng cho đơn hàng giao tại
                                    Hà Tĩnh và các vùng lân cận.</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="col-12" style="margin-top: 5px">
                    <br>
                    <h3>Các chương trình tích điểm cho khách hàng thân thiết</h3>
                    <br>
                </div>
                <div class="col-12">

                    <p style="margin-left:48px"><span style="font-size:18px"><span
                                style="font-family:Calibri,sans-serif">Đối với y&ecirc;u cầu của cửa h&agrave;ng về chức
                                năng t&iacute;ch điểm: Khi kh&aacute;ch h&agrave;ng thực hiện mua h&agrave;ng hệ thống sẽ
                                cộng điểm mua sắm cho kh&aacute;ch h&agrave;ng.</span></span></p>

                    <p style="margin-left:48px"><span style="font-size:18px"><span
                                style="font-family:Calibri,sans-serif">Điểm mua h&agrave;ng sẽ được t&iacute;nh dựa
                                tr&ecirc;n gi&aacute; trị của đơn h&agrave;ng đ&atilde; mua như sau:&nbsp;Điểm mua sắm =
                                gi&aacute; trị đơn h&agrave;ng / 10000 vnđ.</span></span></p>

                    <p style="margin-left:48px">&nbsp;</p>

                    <p style="margin-left:48px"><span style="font-size:18px"><strong><span
                                    style="font-family:Calibri,sans-serif">Sử dụng điểm như thế n&agrave;o
                                    ?</span></strong></span></p>
                                    <p style="margin-left:48px">&nbsp;</p>
                    <p style="margin-left:48px"><span style="font-size:18px"><span
                                style="font-family:Calibri,sans-serif">Điểm sẽ được d&ugrave;ng để giảm gi&aacute; cho
                                c&aacute;c đơn h&agrave;ng lần sau v&agrave; ph&acirc;n loại kh&aacute;ch
                                h&agrave;ng.</span></span></p>

                    <p style="margin-left:48px"><span style="font-size:18px"><span
                                style="font-family:Calibri,sans-serif">Với mỗi 1 điểm người d&ugrave;ng c&oacute; thể đổi
                                400 vnđ.</span></span></p>

                    <p style="margin-left:48px"><span style="font-size:18px"><span
                                style="font-family:&quot;Calibri&quot;,sans-serif">VD: ở lần mua trước người mua A đ&atilde;
                                mua đơn h&agrave;ng 20 triệu =&gt; A c&oacute; 2000 điểm, lần n&agrave;y người A quay lại
                                mua h&agrave;ng, A c&oacute; thể đổi 2000 điểm của m&igrave;nh lấy 800.000 vnđ hoặc tiếp tục
                                t&iacute;ch điểm.</span></span></p>

                    <p style="margin-left:48px">&nbsp;</p>

                    <p style="margin-left:48px"><span style="font-size:18px"><strong><span
                                    style="font-family:Calibri,sans-serif">C&aacute;ch ph&acirc;n loại kh&aacute;ch
                                    h&agrave;ng:</span></strong></span><span style="font-size:18px"><strong><span
                                    style="font-family:Calibri,sans-serif">.</span></strong></span></p>
                                    <p style="margin-left:48px">&nbsp;</p>
                    <p style="margin-left:48px"><span style="font-size:18px"><span
                                style="font-family:Calibri,sans-serif">Dựa v&agrave;o tổng số điểm m&agrave; người đ&oacute;
                                đ&atilde; đạt được để xếp ph&acirc;n loại kh&aacute;c h&agrave;ng.</span></span></p>

                    <ul>
                        <li style="margin-left: 72px;"><span style="font-size:18px"><span
                                    style="font-family:Calibri,sans-serif">Số điểm &lt; 1000 : kh&aacute;ch h&agrave;ng
                                    b&igrave;nh thường =&gt; kh&ocirc;ng c&oacute; ưu đ&atilde;i.</span></span></li>
                        <li style="margin-left: 72px;"><span style="font-size:18px"><span
                                    style="font-family:Calibri,sans-serif">1000 &lt; số điểm &lt; 2500 : kh&aacute;ch
                                    h&agrave;ng tiềm năng =&gt; giảm 1% gi&aacute; trị mỗi đơn h&agrave;ng.</span></span>
                        </li>
                        <li style="margin-left: 72px;"><span style="font-size:18px"><span
                                    style="font-family:Calibri,sans-serif">2500&nbsp; &lt; số điểm &lt; 7000 : kh&aacute;ch
                                    h&agrave;ng th&acirc;n thiết =&gt; giảm 2% gi&aacute; trị mỗi đơn
                                    h&agrave;ng.</span></span></li>
                        <li style="margin-left: 72px;"><span style="font-size:18px"><span
                                    style="font-family:Calibri,sans-serif">7000 &lt; số điểm &lt; 15000: kh&aacute;ch
                                    h&agrave;ng ưu t&uacute; =&gt; giảm 3% gi&aacute; trị mỗi đơn h&agrave;ng.</span></span>
                        </li>
                        <li style="margin-left: 72px;"><span style="font-size:18px"><span
                                    style="font-family:&quot;Calibri&quot;,sans-serif">số điểm &gt; 15000 kh&aacute;ch
                                    h&agrave;ng vip =&gt; giảm 4 % gi&aacute; trị mỗi đơn h&agrave;ng</span></span></li>
                    </ul>

                    <p style="margin-left:48px">&nbsp;</p>








                </div>
            </div>
        </div>

    @endsection
    @section('script')

        <script>
        </script>
    @endsection
