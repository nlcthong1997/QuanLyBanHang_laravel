@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng</h1>
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
                        Danh sách đơn hàng
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày nhập hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($donhang))
                                        @foreach($donhang as $dh)
                                            <tr class="odd gradeX">
                                                <td>{{ $dh->id }}</td>
                                                <td>{{ $dh->NgayLap }}</td>
                                                <td></td>
                                                <td>{{ number_format($dh->TongTien) }} VND</td>
                                                <td>
                                                    @if($dh->TrangThai == 'chưa giao')
                                                        <span id="trangthaitext" style="color:red">{{ $dh->TrangThai }}</span>
                                                    @elseif($dh->TrangThai == 'đã giao')
                                                        <span id="trangthaitext" style="color:green">{{ $dh->TrangThai }}</span>
                                                    @else
                                                        <span id="trangthaitext" style="color:blue">{{ $dh->TrangThai }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" class="id_dh" value="{{ $dh->id }}">
                                                    <select class="trangthai">
                                                        @if($dh->TrangThai == 'chưa giao')
                                                            <option value="chưa giao" selected>chưa giao</option>
                                                            <option value="đang giao">đang giao</option>
                                                            <option value="đã giao">đã giao</option>
                                                        @elseif($dh->TrangThai == 'đã giao')
                                                            <option value="chưa giao">chưa giao</option>
                                                            <option value="đang giao">đang giao</option>
                                                            <option value="đã giao" selected>đã giao</option>
                                                        @else
                                                            <option value="chưa giao">chưa giao</option>
                                                            <option value="đang giao" selected>đang giao</option>
                                                            <option value="đã giao">đã giao</option>
                                                        @endif
                                                    </select>
                                                    <a class="capnhat"><i class="fa fa-edit fa-fw"></i> Cập nhật</a><span class="notification"></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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

@section('script')
    <script>
        $('.capnhat').click(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var pos = $(this).closest('tr');
            var data = {
                id_dh: pos.find('.id_dh').val(),
                trangthai: pos.find('.trangthai').val(),
                _token: CSRF_TOKEN
            }
            $.ajax({
                type: 'POST',
                url: 'admin/ajax/updateTrangthaiDonghang',
                data: data
            }).done(function (kq) {
                var obj_kq = JSON.parse(kq);
                if (obj_kq[0] == 1) {
                    setTimeout(function () {
                        pos.find('.notification').css({'color':'green'}).html('<i class="fa fa-check fa-fw"></i>');
                        setTimeout(function () {
                            pos.find('.notification').html('');
                        }, 1500)
                    }, 10);
                    if (obj_kq[1] == 'đã giao') {
                        pos.find('#trangthaitext').css({'color':'green'}).text(obj_kq[1]);
                    } else if (obj_kq[1] == 'chưa giao') {
                        pos.find('#trangthaitext').css({'color':'red'}).text(obj_kq[1]);
                    } else {
                        pos.find('#trangthaitext').css({'color':'blue'}).text(obj_kq[1]);
                    }
                } else {
                    setTimeout(function () {
                        pos.find('.notification').css({'color':'red'}).html('<i class="fa fa-remove fa-fw"></i>');
                        setTimeout(function () {
                            pos.find('.notification').html('');
                        }, 1500)
                    }, 10);
                }
            });
        });
    </script>
@endsection