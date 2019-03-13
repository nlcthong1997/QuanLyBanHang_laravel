<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- provide the csrf token / use ajax post-->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Admin</title>
        <base href="{{ asset('') }}">
        <!-- Bootstrap Core CSS -->
        <link href="admin_asset/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="admin_asset/css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="admin_asset/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="admin_asset/css/dataTables/dataTables.responsive.css" rel="stylesheet">

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

        <div id="wrapper">

            <!-- Navigation -->
            @include('admin.layouts.header')

            @yield('content')
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="admin_asset/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="admin_asset/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="admin_asset/js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="admin_asset/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="admin_asset/js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="admin_asset/js/startmin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>

        <!-- script global layout -->
        @yield('script');

    </body>
</html>