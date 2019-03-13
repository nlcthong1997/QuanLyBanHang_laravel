@extends('customer.layoutsPage.index')

@section('content')
<section class="google_map">
    <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.519613909221!2d106.64825301447678!3d10.77145766223155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ebfc83d33a5%3A0xad4da1730b43a51b!2zMTQ0IMOCdSBDxqEsIFBoxrDhu51uZyA5LCBUw6JuIELDrG5oLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1552373069524" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
<section class="header_text sub">
<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
    <h4><span>Đăng ký tài khoản
        @if(session('notification_s'))
            <span style="color:green;">{{ session('notification') }}</span>
        @endif
        @if(session('notification_l'))
            <span style="color:red;">{{ session('notification') }}</span>
        @endif
    </span></h4>
</section>			
<section class="main-content">				
    <div class="row">
        <div class="span5"></div>
        <div class="span3">
            <form action="websales/dangky" method="post" class="form-stacked">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="control-group">
                        <label class="control-label">Tài khoản</label>
                        <div class="controls">
                            <input type="text" name="username" class="input-xlarge">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('username') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Tên hiển thị</label>
                        <div class="controls">
                            <input type="text" name="tenkh" class="input-xlarge">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('tenkh') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Email address:</label>
                        <div class="controls">
                            <input type="email" name="email" class="input-xlarge">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('email') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password:</label>
                        <div class="controls">
                            <input type="password" name="password" class="input-xlarge">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('password') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Điện thoại:</label>
                        <div class="controls">
                            <input type="text" name="dienthoai" class="input-xlarge onlyNumber">
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('dienthoai') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Địa chỉ:</label>
                        <div class="controls">
                            <textarea tabindex="3" class="input-xlarge" id="message" name="diachi" rows="7"></textarea>
                            @if(count($errors) > 0)
                                <p class="help-block">
                                    <span style="color:red"> {{ $errors->first('diachi') }} </span>
                                </p>
                            @endif
                        </div>
                    </div>						                            
                    <div class="control-group">
                        <p>Hãy đăng ký để bạn có thể mua hàng của chúng tôi. Điều đó thật tuyệt đúng không nào. |^_^|</p>
                    </div>
                    <hr>
                    <div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Tạo tài khoản"></div>
                </fieldset>
            </form>					
        </div>				
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
    </script>
@endsection