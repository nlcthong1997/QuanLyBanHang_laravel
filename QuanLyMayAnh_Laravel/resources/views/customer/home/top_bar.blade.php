<div id="top-bar" class="container">
    <div class="row">
        <div class="span4">
            <!-- <form method="POST" class="search_form">
                <input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
            </form> -->
        </div>
        <div class="span8">
            <div class="account pull-right">
                <ul class="user-menu">				
                    <li>
                        @if(Auth::check())
                            <a href="websales/thongtincanhan">{{ Auth::user()->TenKH }}</a>
                        @else
                            <a href="websales/dangnhap">Tài khoàn của tôi</a>        
                        @endif
                    </li>
                    @if(Auth::check())
                        <li><a href="websales/lichsumua">Lịch sử mua</a></li>
                        @if(Auth::user()->DacQuyen == 1)
                            <li><a href="admin/sanpham/list">Quản lý webside</a></li>
                        @endif
                    @endif
                    <li>
                        <a href="websales/giohang">Giỏ hàng
                            @if(session('tong_sp_giohang'))
                                ({{ session('tong_sp_giohang') }})
                            @endif
                        </a>
                    </li>
                    @if(!Auth::check())
                        <li><a href="websales/dangky">Đăng ký</a></li>
                    @endif
                    <li>
                        @if(Auth::check())
                            <a href="websales/dangxuat">Đăng xuất</a>
                        @else
                            <a href="websales/dangnhap">Đăng nhập</a>
                        @endif
                    </li>		
                </ul>
            </div>
        </div>
    </div>
</div>