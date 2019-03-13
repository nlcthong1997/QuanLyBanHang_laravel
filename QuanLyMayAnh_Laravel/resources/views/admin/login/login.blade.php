<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login - Admin</title>
        <base href="{{ asset('') }}">
        <!-- Bootstrap Core CSS -->
        <link href="admin_asset/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="admin_asset/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="admin_asset/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="admin_asset/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            @if (session('notification'))
                                <h3 class="panel-title" style="color:red">{{ session('notification') }}</h3>
                            @else
                                <h3 class="panel-title">Xin mời đăng nhập</h3>
                            @endif
                        </div>
                        <div class="panel-body">
                            <form role="form" action="admin/login" method="post">
                                {!! csrf_field() !!}
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Tài khoản" name="username" autofocus>
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('username') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
                                        @if(count($errors) > 0)
                                            <p class="help-block">
                                                <span style="color:red"> {{ $errors->first('password') }} </span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember_password" type="checkbox" value="Remember Me">Nhớ mật khẩu
                                        </label>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="admin_asset/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="admin_asset/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="admin_asset/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="admin_asset/js/startmin.js"></script>

    </body>
</html>
