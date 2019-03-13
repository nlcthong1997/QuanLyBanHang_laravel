@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Xóa danh mục</h1>
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
                            Xóa danh mục
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <form role="form" action="admin/danhmuc/delete" method="post">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <select class="form-control" name="idDanhmuc">
                                            @foreach($list_danhmuc as $l_danhmuc)
                                                @if($l_danhmuc->Trangthai == 1)
                                                    <option value="{{ $l_danhmuc->id }}">{{ $l_danhmuc->TenLoai }}</option>
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