<div class="span3 col">
    <div class="block">	
        <ul class="nav nav-list">
            <li class="nav-header">Loại sản phẩm</li>
            @foreach($danhmuc_menu as $dm_menu)
                @if(isset($sanpham))
                    @if($dm_menu->id == $sanpham->id_Loai)
                        <li class="active"><a href="websales/danhmuc/{{ $dm_menu->id }}">{{ $dm_menu->TenLoai }}</a></li>
                    @else
                        <li><a href="websales/danhmuc/{{ $dm_menu->id }}">{{ $dm_menu->TenLoai }}</a></li>
                    @endif
                @else
                    <li><a href="websales/danhmuc/{{ $dm_menu->id }}">{{ $dm_menu->TenLoai }}</a></li>
                @endif
            @endforeach
        </ul>
        <br/>
        <ul class="nav nav-list below">
            <li class="nav-header">Nhà sản xuất</li>
            @foreach($nsx_menu as $nsx_menu)
                @if(isset($sanpham))
                    @if($nsx_menu->id == $sanpham->id_NSX)
                        <li class="active"><a href="websales/nsx/{{ $nsx_menu->id }}">{{ $nsx_menu->TenNSX }}</a></li>
                    @else
                        <li><a href="websales/nsx/{{ $nsx_menu->id }}">{{ $nsx_menu->TenNSX }}</a></li>
                    @endif
                @else
                    <li><a href="websales/nsx/{{ $nsx_menu->id }}">{{ $nsx_menu->TenNSX }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="block">
        <h4 class="title">
            <span class="pull-left"><span class="text">Có thể bạn quan tâm</span></span>
            <span class="pull-right">
                <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
            </span>
        </h4>
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="active item">
                    <ul class="thumbnails listing-products">
                        @foreach($sp_menu_rand_active as $sp_m_r_a)
                            <li class="span3">
                                <div class="product-box">
                                    <span class="sale_tag"></span>												
                                    <a href="websales/chitiet/{{ $sp_m_r_a->id }}"><img alt="" src="upload/sanpham/{{ $sp_m_r_a->id }}/small.jpg"></a><br/>
                                    <a href="websales/chitiet/{{ $sp_m_r_a->id }}" class="title">{{ $sp_m_r_a->TenSP }}</a><br/>
                                    <a href="websales/chitiet/{{ $sp_m_r_a->id }}" class="category">Số lượng: {{ $sp_m_r_a->SoLuong }}</a>
                                    <p class="price">{{ number_format($sp_m_r_a->Gia) }} VND</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @foreach($sp_menu_rand as $sp_rd)
                    <div class="item">
                        <ul class="thumbnails listing-products">
                            <li class="span3">
                                <div class="product-box">												
                                    <a href="websales/chitiet/{{ $sp_rd->id }}"><img alt="" src="upload/sanpham/{{ $sp_rd->id }}/small.jpg"></a><br/>
                                    <a href="websales/chitiet/{{ $sp_rd->id }}" class="title">{{ $sp_rd->TenSP }}</a><br/>
                                    <a href="websales/chitiet/{{ $sp_rd->id }}" class="category">Số lượng: {{ $sp_rd->SoLuong }}</a>
                                    <p class="price">{{ number_format($sp_rd->Gia) }} VND</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="block">								
        <h4 class="title"><strong>Top</strong> Bán chạy</h4>								
        <ul class="small-product">
            @foreach($sanpham_menu_topSale as $sp_top)
                <li>
                    <a href="websales/chitiet/{{ $sp_top->id }}" title="{{ $sp_top->TenSP }}">
                        <img src="upload/sanpham/{{ $sp_top->id }}/small.jpg" alt="image">
                    </a>
                    <a href="websales/chitiet/{{ $sp_top->id }}">{{ $sp_top->TenSP }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>