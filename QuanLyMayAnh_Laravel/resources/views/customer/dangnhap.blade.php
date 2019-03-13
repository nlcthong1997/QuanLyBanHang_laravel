@extends('customer.layoutsPage.index')

@section('content')
<section class="header_text sub">
<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
    <h4><span>Đăng nhập
        @if(session('notification'))
            <span style="color:red;">{{ session('notification') }}</span>
        @endif
    </span></h4>
</section>			
<section class="main-content">				
    <div class="row">
        <div class="span5"></div>
        <div class="span3">					
            <form action="websales/dangnhap" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="next" value="/">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label">Tài khoản</label>
                        <div class="controls">
                            <input type="text" placeholder="Nhập tài khoản" name="username" id="username" class="input-xlarge">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('username') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Mật khẩu</label>
                        <div class="controls">
                            <input type="password" placeholder="Nhập mật khẩu" name="password" id="password" class="input-xlarge">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('password') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">    
                            <label>
                                <input style="margin-bottom: 2%;" type="checkbox" name="remember_password" id="remember_password"> &nbsp Nhớ mật khẩu
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <input tabindex="3" class="btn btn-inverse large" type="submit" value="Đăng nhập">
                        <hr>
                        <p class="reset"><a tabindex="4" href="websales/dangky" title="Recover your username or password">Đăng ký</a> nếu chưa có tài khoản.</p>
                    </div>
                </fieldset>
            </form>				
        </div>
    </div>
</section>
@endsection