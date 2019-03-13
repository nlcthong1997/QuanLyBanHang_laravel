@extends('admin.layouts.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm danh mục</h1>
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
                            Thêm danh mục
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <form role="form" action="admin/danhmuc/add" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input class="form-control" name="tendanhmuc">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('tendanhmuc') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file">
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