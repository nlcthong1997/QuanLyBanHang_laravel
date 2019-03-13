<section class="main-content">
    <div class="row">
        <div class="span12">													
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">Sản phẩm <strong>xem nhiều nhất</strong></span></span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel" class="myCarousel carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails">
                                    @if(isset($sanpham_topView_active))
                                        @foreach($sanpham_topView_active as $sp_act)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <span class="sale_tag"></span>
                                                    <p><a href="websales/chitiet/{{$sp_act->id}}"><img src="upload/sanpham/{{ $sp_act->id }}/small.jpg" alt="" /></a></p>
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
                                <ul class="thumbnails">
                                    @if(isset($sanpham_topView_1))
                                        @foreach($sanpham_topView_1 as $sp_1)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <p><a href="websales/chitiet/{{$sp_1->id}}"><img src="upload/sanpham/{{ $sp_1->id }}/small.jpg" alt="" /></a></p>
                                                    <a href="websales/chitiet/{{$sp_1->id}}" class="title">{{ $sp_1->TenSP }}</a><br/>
                                                    <a href="websales/chitiet/{{$sp_1->id}}" class="category">Số lượng: {{ $sp_1->SoLuong }}</a>
                                                    <p class="price">{{ number_format($sp_1->Gia) }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="thumbnails">
                                    @if(isset($sanpham_topView_2))
                                        @foreach($sanpham_topView_2 as $sp_2)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <p><a href="websales/chitiet/{{$sp_2->id}}"><img src="upload/sanpham/{{ $sp_2->id }}/small.jpg" alt="" /></a></p>
                                                    <a href="websales/chitiet/{{$sp_2->id}}" class="title">{{ $sp_2->TenSP }}</a><br/>
                                                    <a href="websales/chitiet/{{$sp_2->id}}" class="category">Số lượng: {{ $sp_2->SoLuong }}</a>
                                                    <p class="price">{{ number_format($sp_2->Gia) }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>							
                    </div>
                </div>						
            </div>
            <br/>
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">Sản phẩm <strong>Bán chạy nhất</strong></span></span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel-2" class="myCarousel carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails">
                                    @if(isset($sanpham_topSale_active))
                                        @foreach($sanpham_topSale_active as $spS_act)											
                                            <li class="span3">
                                                <div class="product-box">
                                                    <span class="sale_tag"></span>
                                                    <p><a href="websales/chitiet/{{$spS_act->id}}"><img src="upload/sanpham/{{ $spS_act->id }}/small.jpg" alt="" /></a></p>
                                                    <a href="websales/chitiet/{{$spS_act->id}}" class="title">{{ $spS_act->TenSP }}</a><br/>
                                                    <a href="websales/chitiet/{{$spS_act->id}}" class="category">Số lượng: {{ $spS_act->SoLuong }}</a>
                                                    <p class="price">{{ number_format($spS_act->Gia) }}VND</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="thumbnails">
                                    @if(isset($sanpham_topSale_1))
                                        @foreach($sanpham_topSale_1 as $spS_1)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <p><a href="websales/chitiet/{{$spS_1->id}}"><img src="upload/sanpham/{{ $spS_1->id }}/small.jpg" alt="" /></a></p>
                                                    <a href="websales/chitiet/{{$spS_1->id}}" class="title">{{ $spS_1->TenSP }}</a><br/>
                                                    <a href="websales/chitiet/{{$spS_1->id}}" class="category">Số lượng: {{ $spS_1->SoLuong }}</a>
                                                    <p class="price">{{ number_format($spS_1->Gia) }}VND</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif																																
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="thumbnails">
                                    @if(isset($sanpham_topSale_2))
                                        @foreach($sanpham_topSale_2 as $spS_2)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <p><a href="websales/chitiet/{{$spS_2->id}}"><img src="upload/sanpham/{{ $spS_2->id }}/small.jpg" alt="" /></a></p>
                                                    <a href="websales/chitiet/{{$spS_2->id}}" class="title">{{ $spS_2->TenSP }}</a><br/>
                                                    <a href="websales/chitiet/{{$spS_2->id}}" class="category">Số lượng: {{ $spS_2->SoLuong }}</a>
                                                    <p class="price">{{ number_format($spS_2->Gia) }}VND</p>
                                                </div>
                                            </li>
                                        @endforeach	
                                    @endif																													
                                </ul>
                            </div>
                        </div>							
                    </div>
                </div>						
            </div>		
        </div>				
    </div>
</section>