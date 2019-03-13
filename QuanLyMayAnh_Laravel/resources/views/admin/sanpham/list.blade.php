@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách sản phẩm</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        @include('admin.layouts.menutop')
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách sản phẩm
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Tên</th>
                                        <th>Nhà sản xuất</th>
                                        <th>Loại</th>
                                        <th>Đánh giá</th>
                                        <th>Giá (vnd)</th>
                                        <th>Số lượng còn</th>
                                        <th>Số lượng bán</th>
                                        <th>Lượt xem</th>
                                        <th>Ngày nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_sanpham as $sp)
                                        @if($sp->Trangthai == 1)
                                            <tr class="odd gradeX">
                                                <td>{{ $sp->id }}</td>
                                                <td>{{ $sp->TenSP }}</td>
                                                <td>{{ $sp->TenNSX }}</td>
                                                <td>{{ $sp->TenLoai }}</td>
                                                <td>{{ $sp->DanhGia }}</td>
                                                <td>{{ number_format($sp->Gia) }}</td>
                                                <td>{{ $sp->SoLuong }}</td>
                                                <td>{{ $sp->SoLuongDaBan }}</td>
                                                <td>{{ $sp->LuotXem }}</td>
                                                <td>{{ $sp->NgayNhap }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
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