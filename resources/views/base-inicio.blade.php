<!DOCTYPE html>
<html lang="en" ng-app="GestionInterna">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content='{{ csrf_token() }}'>

    <title>.: Gestionlist :.</title>
	
	<!-- Fonts -->
	<link rel="shortcut icon" href="favicon.ico" />
	
	<!-- bootstrap modules style -->
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Iconos -->
	<link href="{{ asset('/bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
	
	<!-- theme Cliente -->
	<!-- FONT ICONS -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/assets/elegant-icons/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/thema-inicio/assets/app-icons/styles.css') }}">
	<!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->

	<!-- WEB FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic' rel='stylesheet' type='text/css'>

	<!-- CAROUSEL AND LIGHTBOX -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/owl.theme.css') }}">
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/nivo-lightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/nivo_themes/default/default.css') }}">

	<!-- ANIMATIONS -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/animate.min.css') }}">

	<!-- CUSTOM STYLESHEETS -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/styles.css') }}">

	<!-- COLORS | CURRENTLY USED DIFFERENTLY TO SWITCH FOR DEMO. IN ORIGINAL FILE ALL COLORS LINK IS COMMENTED EXCEPT BLUE -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/colors/blue.css') }}" title="blue">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/green.css') }}" title="green">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/orange.css') }}" title="orange">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/purple.css') }}" title="purple">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/slate.css') }}" title="slate">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/yellow.css') }}" title="yellow">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/red.css') }}" title="red">
	<link rel="alternate stylesheet" href="{{ asset('/thema-inicio/css/colors/blue-munsell.css') }}" title="blue-munsell">

	<!-- RESPONSIVE FIXES -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/css/responsive.css') }}">

	<!-- STYLE SWITCH STYLESHEET ONLY FOR DEMO -->
	<link rel="stylesheet" href="{{ asset('/thema-inicio/demo/demo.css') }}">

	<link href="{{ asset('/css/style-cliente.css') }}" rel="stylesheet">

</head>
<body>
	
	@yield('content')

    <!-- jquery modules -->
    <script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }}"></script>

   	<!-- bootstrap modules -->
    <script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	
	<!-- theme Cliente -->
	<!-- =========================
	     SCRIPTS 
	============================== -->
	<script src="{{ asset('/thema-inicio/js/smoothscroll.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/jquery.scrollTo.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/jquery.localScroll.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/nivo-lightbox.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/simple-expand.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/wow.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/jquery.stellar.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/retina-1.1.0.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/jquery.nav.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/matchMedia.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/jquery.fitvids.js') }}"></script>
	<script src="{{ asset('/thema-inicio/js/custom.js') }}"></script>
	<!-- =========================================================
	     STYLE SWITCHER | ONLY FOR DEMO NOT INCLUDED IN MAIN FILES
	============================================================== -->
	<script type="text/javascript" src="{{ asset('/thema-inicio/demo/styleswitcher.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/thema-inicio/demo/demo.js') }}"></script>

</body>
</html>
