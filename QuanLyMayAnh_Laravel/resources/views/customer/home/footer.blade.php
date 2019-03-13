<section id="footer-bar">
    <div class="row">
        <div class="span3">
            <h4>WebSales</h4>
            <ul class="nav">
                <li><a href="websales/home">Trang chính</a></li>
                <li><a href="websales/giohang">Giỏ hàng</a></li>
                <li><a href="websales/dangnhap">Đăng nhập</a></li>							
            </ul>					
        </div>
        <div class="span4">
            <h4>Tài khoản</h4>
            <ul class="nav">
                @if (Auth::check())
                    <li><a href="websales/thongtincanhan">Tài khoản của tôi</a></li>
                @else
                    <li><a href="websales/dangnhap">Tài khoản của tôi</a></li>
                @endif
                <li><a href="websales/dangky">Đăng ký</a></li>
            </ul>
        </div>
        <div class="span5">
            <p class="logo"><img src="customer_asset/logo/logo.png" class="site_logo" alt=""></p>
            <p>Chúng tôi luôn hướng mục tiêu đến với khách hàng là sự hoàn thiện tốt nhất. Đừng bỏ qua những sản phẩm tốt nhất mà chúng tối đang có.</p>
            <br/>
            <span class="social_icons">
                <a class="facebook" href="#">Facebook</a>
                <a class="twitter" href="#">Twitter</a>
                <a class="skype" href="#">Skype</a>
                <a class="vimeo" href="#">Vimeo</a>
            </span>
        </div>					
    </div>	
</section>