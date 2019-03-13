@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Xóa User</h1>
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
                        Danh sách user
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Tên</th>
                                        <th>Tài khoản</th>
                                        <th>Email</th>
                                        <th>Quyền</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_user as $u)
                                        <tr class="odd gradeX">
                                            <td>{{ $u->id }}</td>
                                            <td>{{ $u->TenKH }}</td>
                                            <td>{{ $u->username }}</td>
                                            <td>{{ $u->email }}</td>
                                            @if($u->DacQuyen == 1)
                                                <td>Admin</td>
                                            @else
                                                <td>User</td>
                                            @endif
                                            @if ($u->Trangthai == 1)
                                                <td>Đang sử dụng</td>
                                                <td><a href="admin/user/delete/{{ $u->id }}"><i class="fa fa-trash fa-fw"></i> Xóa</a></td>
                                            @else
                                                <td><span style="color:red">Đã xóa</span></td>
                                                <td><a href="admin/user/khoiphuc/{{ $u->id }}"><i class="fa fa-rotate-left fa-fw"></i> Khôi phục</a></td>
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