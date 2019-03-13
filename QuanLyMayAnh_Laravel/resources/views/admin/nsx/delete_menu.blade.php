@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Xóa nhà sản xuất</h1>
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
                            Xóa nhà sản xuất
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <form role="form" action="admin/nsx/delete" method="post">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label>Tên nhà sản xuất</label>
                                        <select class="form-control" name="idNSX">
                                            @foreach($list_nsx as $l_nsx)
                                                @if($l_nsx->Trangthai == 1)
                                                    <option value="{{ $l_nsx->id }}">{{ $l_nsx->TenNSX }}</option>
                                                @endif    
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default">Xóa</button>
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