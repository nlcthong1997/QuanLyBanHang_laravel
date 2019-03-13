@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm sản phẩm</h1>
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
                            Thêm sản phẩm
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <form role="form" action="admin/sanpham/add" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input class="form-control" name="tensp">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('tensp') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nhà sản xuất</label>
                                        <select class="form-control" name="idNSX">
                                            @foreach($list_nsx as $nsx)
                                                @if($nsx->Trangthai == 1)
                                                    <option value="{{ $nsx->id }}">{{ $nsx->TenNSX }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <select class="form-control" name="idDanhmuc">
                                            @foreach($list_danhmuc as $danhmuc)
                                                @if($danhmuc->Trangthai == 1)
                                                    <option value="{{ $danhmuc->id }}">{{ $danhmuc->TenLoai }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Đánh giá</label>
                                        <textarea class="form-control" rows="3" name="danhgia"></textarea>
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('danhgia') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết sản phẩm</label>
                                        <textarea class="form-control" rows="3" name="chitiet" id="ckeditor"></textarea>
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('chitiet') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Giá bán</label>
                                        <input class="form-control onlyNumber" name="gia">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('gia') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input class="form-control onlyNumber" name="soluong">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('soluong') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh lớn</label>
                                        <input type="file" name="anhlon">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('anhlon') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh nhỏ</label>
                                        <input type="file" name="anhnho">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('anhnho') }} </span>
                                            </p>
                                        @endif
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

<!-- trình soạn thảo -->
@section('script')
    <script type="text/javascript" language="javascript" src="admin_asset/js/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');

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