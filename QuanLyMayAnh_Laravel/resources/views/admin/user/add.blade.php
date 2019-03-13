@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm User</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(session('notification'))
                            <span style="color:green">{{ session('notification') }}<span>
                        @else
                            Thêm user
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <form role="form" action="admin/user/add" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label>Tài khoản *</label>
                                        <input class="form-control" name="username">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('username') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input class="form-control" name="email" placeholder="email@example.com">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('email') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu *</label>
                                        <input class="form-control" type="password" name="password">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('password') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Tên người dùng *</label>
                                        <input class="form-control" name="tenkh">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('tenkh') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Ngày sinh</label>
                                                <select class="form-control" name="ngaysinh" id="ngaysinh">
                                                    @for($i = 1; $i <= 31; $i++)
                                                        <option>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Tháng sinh</label>
                                                <select class="form-control" name="thangsinh" id="thangsinh">
                                                    @for($i = 1; $i <= 12; $i++)
                                                        <option>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Năm sinh</label>
                                                <select class="form-control" name="namsinh" id="namsinh">
                                                    @for($i = $now_year; $i >= $begin_year; $i--)
                                                        <option>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ *</label>
                                        <textarea class="form-control" rows="3" name="diachi"></textarea>
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('diachi') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại *</label>
                                        <input class="form-control onlyNumber" name="dienthoai">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('dienthoai') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Quyền</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="dacquyen" id="dacquyen_admin" value="1" checked>Admin
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="dacquyen" id="dacquyen_user" value="0">User
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-default">Thêm</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
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