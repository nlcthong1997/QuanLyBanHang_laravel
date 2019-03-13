@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User</h1>
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
                        Danh sách User
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
                                        <th>SĐT</th>
                                        <th>Địa chỉ</th>
                                        <th>Quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_user as $user)
                                        @if($user->Trangthai == 1)
                                            <tr class="odd gradeX">
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->TenKH }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td class="center">{{ $user->email }}</td>
                                                <td class="center">{{ $user->SDT }}</td>
                                                <td class="center">{{ $user->DiaChi }}</td>
                                                @if($user->DacQuyen == 1)
                                                    <td class="center">Admin</td>
                                                @else
                                                    <td>User</td>
                                                @endif
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