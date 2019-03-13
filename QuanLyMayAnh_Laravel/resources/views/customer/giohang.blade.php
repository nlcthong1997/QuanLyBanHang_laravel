@extends('customer.layoutsPage.index')

@section('content')
<section class="header_text sub">
<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
	<h4><span>Giỏ hàng</span></h4>
</section>
<section class="main-content">
	<div class="row">						
		<div class="span9">
            <table class="table table-striped shop_attributes">	
                <tbody>
                    <tr class="">
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>
                            @if(session('giohang'))
                                <a style="cursor:pointer;" class="xoatatca_sp">Xóa tất cả</a>
                            @endif
                        </th>
                    </tr>
                    @if(isset($giohang))
                        @foreach($giohang as $masp => $thongtinsp)
                            <tr class="alt tr_giohang">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $thongtinsp['ten_sp'] }}</td>
                                <td>
                                    <input type="text" class="span1 onlyNumber thaydoi_soluong" value="{{ $thongtinsp['so_luong'] }}">
                                    <input type="hidden" class="masp_them" value="{{ $masp }}">
                                </td>
                                <td>
                                    <span class="gia_thaydoi">{{ number_format($thongtinsp['gia_sp']* $thongtinsp['so_luong']) }}</span>
                                </td>
                                <td>
                                    <a style="cursor:pointer;" class="xoa_sp">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tổng tiền:</td>
                            <td>
                                <span id="tongtien">
                                    @if(session('tongtien_giohang'))
                                        {{ number_format(session('tongtien_giohang')) }} VND
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if(Auth::check())
                                    @if((int)session('tongtien_giohang') != 0)
                                        <button style="margin-bottom: 2%;" class="btn btn-inverse" id="thanhtoan">Thanh toán</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="row">
                <div class="span3"></div>
                <div class="span4">
                    <span style="color:green" id="notification_s"></span>
                    <span style="color:red" id="notification_l"></span>
                </div>
            </div>
        </div>
		@include('customer.layoutsPage.menu_right_page')
	</div>
</section>
@endsection

@section('script')
    <script>
        $('.onlyNumber').keydown(function (e) {
            // Allow: backspace, space, tab, ',', '.'
            if ($.inArray(e.keyCode, [8, 32, 9, 188, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // Let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $('.thaydoi_soluong').change(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var pos = $(this).closest('tr');
            var soluong_new = pos.find('.thaydoi_soluong').val();
            var masp = pos.find('.masp_them').val();
            var data = {
                _token: CSRF_TOKEN, 
                id_sp: masp,
                soluong_new: soluong_new,
            }
            $.ajax({
                type: 'POST',
                url: 'websales/capnhatgiohang',
                data: data
            }).done(function (kq) {                
                function formatNumber(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                }

                var obj_kq = JSON.parse(kq);
                if (obj_kq[0] == -1) {
                    pos.remove();
                } else {
                    pos.find('.gia_thaydoi').text(formatNumber(obj_kq[0]));
                }
                $('#tongsl').text("("+ obj_kq[2] +")");
                $('#tongtien').text(formatNumber(obj_kq[1]) + ' VND');
            });
        });

        $('.xoa_sp').click(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var pos = $(this).closest('tr');
            var masp = pos.find('.masp_them').val();
            var data = {
                _token: CSRF_TOKEN, 
                id_sp: masp,
            }
            $.ajax({
                type: 'POST',
                url: 'websales/xoa1spGiohang',
                data: data
            }).done(function (kq) {    
                function formatNumber(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                }

                var obj_kq = JSON.parse(kq);            
                $('#tongsl').text("("+ obj_kq[1] +")");
                pos.remove();
                $('#tongtien').text(formatNumber(obj_kq[0]) + ' VND');
            });
        });

        $('.xoatatca_sp').click(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
            var data = {
                _token: CSRF_TOKEN,
            }
            $.ajax({
                type: 'POST',
                url: 'websales/xoaGiohang',
                data: data
            }).done(function (kq) {                
                $('#tongsl').text("("+ 0 +")");
                $('#tongtien').text('0 VND');
                $('.xoatatca_sp').text('');
                $('.tr_giohang').remove();
            });
        });
        
        $('#thanhtoan').click(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
            var data = {
                _token: CSRF_TOKEN,
            }
            $.ajax({
                type: 'POST',
                url: 'websales/thanhtoan',
                data: data
            }).done(function (kq) {
                if (kq == 1) {
                    $('#tongsl').text("("+ 0 +")");
                    $('#tongtien').text('0 VND');
                    $('.xoatatca_sp').text('');
                    $('.tr_giohang').remove();
                    $('#notification_s').text('Đơn hàng của bạn đang được xử lý và giao đến bạn.')
                } else {
                    setTimeout(function() {
                        $('#notification_l').text('Đã xảy ra lỗi. Thanh toán thất bại!.');
                        setTimeout(function() {
                            $('#notification_l').text('');
                        }, 2000)
                    }, 10);
                }
            });
        });
    </script>
@endsection