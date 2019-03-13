@extends('customer.layoutsPage.index')

@section('content')
<section class="header_text sub">
    <!-- <img class="pageBanner" src="" alt="New products" > -->
        <h4><span>Chi tiết sản phẩm</span></h4>
</section>

<section class="main-content">				
    <div class="row">						
        <div class="span9">
            <div class="row">
                <div class="span4">
                    <a href="upload/sanpham/{{ $sanpham->id }}/big.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="upload/sanpham/{{ $sanpham->id }}/big.jpg"></a>												
                    <ul class="thumbnails small">								
                        <li class="span1">
                            <a href="upload/sanpham/{{ $sanpham->id }}/small.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 2"><img src="upload/sanpham/{{ $sanpham->id }}/small.jpg" alt=""></a>
                        </li>								
                    </ul>
                </div>
                <div class="span5">
                    <h4><strong>{{ $sanpham->TenSP }} VND</strong></h4>
                    <!-- // -->
                    <input type="hidden" name="chitiet_hidden" id="chitiet_hidden" value="{{ $sanpham->ChiTiet }}">
                    <address id="address"></address>
                    <!-- // -->
                    <h5>Lượt xem: {{ $sanpham->LuotXem }}</h5>									
                    <h4><strong>Giá: {{ number_format($sanpham->Gia) }} VND</strong></h4>
                    <input type="hidden" name="id_sp" id="id_sp" value="{{ $sanpham->id }}">
                    <!-- // -->
                    Số lượng: &nbsp&nbsp
                    <input type="text" class="span1 onlyNumber" id="soluong_sp" placeholder="1">
                    <button style="margin-bottom: 2%;" class="btn btn-inverse" id="them_sp">Thêm vào giỏ</button>
                    <span id="notification"></span>
                </div>							
            </div>
            <div class="row">
                <div class="span9">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home">Đánh giá</a></li>
                        <li class=""><a href="#profile">Chi tiết</a></li>
                    </ul>							 
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">{{ $sanpham->DanhGia }}</div>
                        <div class="tab-pane" id="profile">
                            <!-- // jquery   -->
                        </div>
                    </div>							
                </div>						
                <div class="span9">	
                    <br>
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><strong>Sản phẩm</strong> cùng loại</span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel-1" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails listing-products">
                                    @if(!empty($sanpham_cungloai_active))
                                        @foreach($sanpham_cungloai_active as $sp_act)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <span class="sale_tag"></span>												
                                                    <a href="websales/chitiet/{{$sp_act->id}}"><img alt="" src="upload/sanpham/{{$sp_act->id}}/small.jpg"></a><br/>
                                                    <a href="websales/chitiet/{{$sp_act->id}}" class="title">{{ $sp_act->TenSP }}</a><br/>
                                                    <a href="websales/chitiet/{{$sp_act->id}}" class="category">Số lượng: {{ $sp_act->SoLuong }}</a>
                                                    <p class="price">{{ number_format($sp_act->Gia) }} VND</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif									
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="thumbnails listing-products">
                                    @if(!empty($sanpham_cungloai_active))
                                        @if(!empty($sanpham_cungloai))
                                            @foreach($sanpham_cungloai as $sp)
                                                <li class="span3">
                                                    <div class="product-box">
                                                        <span class="sale_tag"></span>												
                                                        <a href="websales/chitiet/{{$sp->id}}"><img alt="" src="upload/sanpham/{{$sp->id}}/small.jpg"></a><br/>
                                                        <a href="websales/chitiet/{{$sp->id}}" class="title">{{ $sp->TenSP }}</a><br/>
                                                        <a href="websales/chitiet/{{$sp->id}}" class="category">Số lượng: {{ $sp->SoLuong }}</a>
                                                        <p class="price">{{ number_format($sp->Gia) }}VND</p>
                                                    </div>
                                                </li>       
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
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

        $('#them_sp').click(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id_sp = $('#id_sp').val();
            var soluong_sp = $('#soluong_sp').val()
            if (soluong_sp == '' || soluong_sp == 0) {
                soluong_sp = 1;
            }
            var data = {
                _token: CSRF_TOKEN, 
                id_sp: id_sp,
                soluong_sp: soluong_sp,
            }
            $.ajax({
                type: 'POST',
                url: 'websales/themSPgiohang',
                data: data
            }).done(function (kq) {
                var obj_kq = JSON.parse(kq);
                setTimeout(function() {
			        $('#notification').html('<b>Đã thêm</b>').css('color', 'green');
                    setTimeout(function() {
                        $('#notification').html('');
                    }, 500)
                }, 10);
                $('#tongsl').text("("+ obj_kq[1] +")");
            });
        });

        $('document').ready( function () {
            var html = $('#chitiet_hidden').val();
            $('#address').html(html);
            $('#profile').html(html);
        });
    </script>
@endsection