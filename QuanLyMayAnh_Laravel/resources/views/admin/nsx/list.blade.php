@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhà sản xuất</h1>
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
                        Danh sách nhà sản xuất
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Tên</th>
                                        <th>Logo</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_nsx as $nsx)
                                    <tr class="odd gradeX">
                                        <td class="center">{{ $nsx->id }}</td>
                                        <td class="center">{{ $nsx->TenNSX }}</td>
                                        <td class="center"></td>
                                        <td class="center">
                                            @if($nsx->Trangthai == 1)
                                                {{ "Hiện có" }}
                                            @else
                                                <span style="color:red">{{ "Đã xóa" }}</span>
                                            @endif
                                        </td>
                                        @if($nsx->Trangthai == 1)
                                            <td><a href="admin/nsx/edit/{{ $nsx->id }}"><i class="fa fa-edit fa-fw"></i> Chỉnh sửa</a></td>
                                            <td><a href="admin/nsx/delete/{{ $nsx->id }}"><i class="fa fa-trash fa-fw"></i> Xóa</a></td>
                                        @else
                                            <td></td>
                                            <td><a href="admin/nsx/khoiphuc/{{ $nsx->id }}"><i class="fa fa-rotate-left fa-fw"></i> Khôi phục</a></td>
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