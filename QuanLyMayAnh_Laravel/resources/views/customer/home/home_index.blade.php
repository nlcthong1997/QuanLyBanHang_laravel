<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">

		<base href="{{ asset('') }}">

		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="customer_asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="customer_asset/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		
		<link href="customer_asset/themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="customer_asset/themes/css/flexslider.css" rel="stylesheet"/>
		<link href="customer_asset/themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="customer_asset/themes/js/jquery-1.7.2.min.js"></script>
		<script src="customer_asset/bootstrap/js/bootstrap.min.js"></script>				
		<script src="customer_asset/themes/js/superfish.js"></script>	
		<script src="customer_asset/themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<!-- top bar -->
		@include('customer.home.top_bar')

		<div id="wrapper" class="container">
			<!-- menu top -->
			@include('customer.home.menu_top')
			
			<!-- slider -->
			@include('customer.home.slider')
			
			<!-- text -->
			@include('customer.home.text')
			
			<!-- content -->
			@include('customer.home.content')

			<!-- menu quang cao -->
			@include('customer.home.menu_quang_cao')

			<!-- footer -->
			@include('customer.home.footer')

			<!-- coppy right -->
			@include('customer.home.coppyright')
		</div>

		<script src="customer_asset/themes/js/common.js"></script>
		<script src="customer_asset/themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
    </body>
</html>