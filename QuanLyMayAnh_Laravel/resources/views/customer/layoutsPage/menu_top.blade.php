<section class="navbar main-menu">
    <div class="navbar-inner main-menu">				
        <a href="websales/home" class="logo pull-left"><img src="customer_asset/logo/logo.png" class="site_logo" alt=""></a>
        <nav id="menu" class="pull-right">
            <ul>
                <li><a>Loại</a>					
                    <ul>
                        @if(isset($danhmuc_menuTop))
                            @foreach($danhmuc_menuTop as $dmTop)
                                <li><a href="websales/danhmuc/{{$dmTop->id}}">{{ $dmTop->TenLoai }}</a></li>									
                            @endforeach
                        @endif
                    </ul>
                </li>																	
                <li><a>Nhà sản xuất</a>
                    <ul>
                        @if(isset($nsx_menuTop))
                            @foreach($nsx_menuTop as $nsxTop)						
                                <li><a href="websales/nsx/{{$nsxTop->id}}">{{ $nsxTop->TenNSX }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>					
            </ul>
        </nav>
    </div>
</section>