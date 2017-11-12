<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/eb_general.css">
		<link href="{{ url('stranka/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		
		<script src="{{ url('stranka/resources/assets/js/jquery.js') }}"></script>
        <script src="{{ url('stranka/resources/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('stranka/resources/assets/js/ib-footer-resize.js') }}"></script>
		
	</head>
	<body>
	<!-- @yield menu -->
	@yield('content')
	
	</body>
	<footer>
		<p>TO DO FOOTER</p>
	</footer>
</html>