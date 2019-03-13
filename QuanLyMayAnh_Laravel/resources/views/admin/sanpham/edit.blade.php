@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chỉnh sửa sản phẩm</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(session('notification'))
                            <span style="color: green">{{ session('notification') }}</span>
                        @else
                            Chỉnh sửa sản phẩm
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <form role="form" action="admin/sanpham/edit" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label>Chọn sản phẩm cần chình sửa</label>
                                        <select class="form-control" name="sanphamChon" id="sanphamChon">
                                            @foreach($list_sanpham as $sp)
                                                @if($sp->Trangthai == 1)
                                                    <option value="{{ $sp->id }}">{{ $sp->id }}. {{ $sp->TenSP }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <input class="form-control" type="hidden" name="idsp_edit" id="idsp_edit">
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input class="form-control" name="tensp_edit" id="tensp_edit">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('tensp_edit') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nhà sản xuất</label>
                                        <select class="form-control" name="nsx_edit" id="nsx_edit">
                                            @foreach($list_nsx as $nsx)
                                                <option value="{{ $nsx->id_NSX }}">{{ $nsx->TenNSX }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <select class="form-control" name="danhmuc_edit" id="danhmuc_edit">
                                            @foreach($list_danhmuc as $danhmuc)
                                                <option value="{{ $danhmuc->id_Loai }}">{{ $danhmuc->TenLoai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Đánh giá</label>
                                        <textarea class="form-control" rows="3" name="danhgia_edit" value="" id="danhgia_edit"></textarea>
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('danhgia_edit') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết sản phẩm</label>
                                        <textarea class="form-control" rows="3" name="chitiet_edit" value="" class="chitiet_edit" id="ckeditor"></textarea>
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('chitiet_edit') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Giá bán</label>
                                        <input class="form-control onlyNumber" type="number" name="giaban_edit" value="" id="giaban_edit">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('giaban_edit') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng còn</label>
                                        <input class="form-control onlyNumber" name="soluong_edit" value="" id="soluong_edit">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('soluong_edit') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh lớn</label>
                                        <input type="file" name="anhlon_edit">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh nhỏ</label>
                                        <input type="file" name="anhnho_edit">
                                    </div>
                                    <button type="submit" class="btn btn-default">Chỉnh sửa</button>
                                    <button type="reset" class="btn btn-default" id="btn_reset">Làm mới</button>
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

        $('#sanphamChon').change(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: 'admin/ajax/editSanpham',
                data: {_token: CSRF_TOKEN, id: $(this).val() },
            }).done(function (kq) {
                
                var obj_kq = JSON.parse(kq);
                
                $('#idsp_edit').val(obj_kq[0].id)
                $('#tensp_edit').val(obj_kq[0].TenSP);
                $('#nsx_edit').html(obj_kq[1]);
                $('#danhmuc_edit').html(obj_kq[2]);
                $('#danhgia_edit').val(obj_kq[0].DanhGia);
                CKEDITOR.instances.ckeditor.setData(obj_kq[0].ChiTiet);
                $('#giaban_edit').val(obj_kq[0].Gia);
                $('#soluong_edit').val(obj_kq[0].SoLuong);
            });
        });
        $('#btn_reset').click(function () {
            CKEDITOR.instances.ckeditor.setData('');
        });

    </script>
@endsection