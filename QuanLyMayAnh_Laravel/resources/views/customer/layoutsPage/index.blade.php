
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
        <!-- provide the csrf token / use ajax post-->
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		
        <base href="{{ asset('') }}">

		<!-- bootstrap -->
		<link href="customer_asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="customer_asset/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="customer_asset/themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="customer_asset/themes/css/main.css" rel="stylesheet"/>
		<link href="customer_asset/themes/css/jquery.fancybox.css" rel="stylesheet"/>
				
		<!-- scripts -->
		<script src="customer_asset/themes/js/jquery-1.7.2.min.js"></script>
		<script src="customer_asset/bootstrap/js/bootstrap.min.js"></script>				
		<script src="customer_asset/themes/js/superfish.js"></script>	
		<script src="customer_asset/themes/js/jquery.scrolltotop.js"></script>
		<script src="customer_asset/themes/js/jquery.fancybox.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
        <!-- top bar -->
        @include('customer.layoutsPage.top_bar')
        
		<div id="wrapper" class="container">
            <!-- menu top -->
			@include('customer.layoutsPage.menu_top')
            
            <!-- content name page-->
			@yield('content')		
            
            <!-- footer -->
            @include('customer.layoutsPage.footer')

            <!-- copyright -->
            @include('customer.layoutsPage.copyright')
		</div>
		<script src="customer_asset/themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});
				
				$('#myCarousel-2').carousel({
                    interval: 2500
                });								
			});
		</script>

		@yield('script')
    </body>
</html>