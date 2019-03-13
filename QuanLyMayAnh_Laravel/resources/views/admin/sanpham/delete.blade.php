@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Xóa sản phẩm</h1>
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
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_sanpham as $sp)
                                        <tr class="odd gradeX">
                                            <td>{{ $sp->id }}</td>
                                            <td>{{ $sp->TenSP }}</td>
                                            <td>{{ $sp->TenNSX }}</td>
                                            <td>{{ $sp->TenLoai }}</td>     
                                            @if ($sp->Trangthai == 1)
                                                <td>Hiện có</td>
                                                <td><a href="admin/sanpham/delete/{{ $sp->id }}"><i class="fa fa-trash fa-fw"></i> Xóa</a></td>
                                            @else
                                                <td><span style="color:red">Đã xóa</span></td>
                                                <td><a href="admin/sanpham/khoiphuc/{{ $sp->id }}"><i class="fa fa-rotate-left fa-fw"></i> Khôi phục</a></td>
                                            @endif
                                        </tr>
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