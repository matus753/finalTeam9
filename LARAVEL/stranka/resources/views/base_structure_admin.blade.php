<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/eb_general.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">    

		<script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/ib-footer-resize.js') }}"></script>
		<script src="{{ URL::asset('js/additional_js.js') }}"></script>
		
		<title> ÚAMT - {{ $title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('additional_headers_admin')
	</head>
	<body>
	<a id="return-to-top" onclick="scrollToTop()"><i class="fa fa-arrow-up"></i></a>
	<nav class="navbar navbar-default" id="navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#emNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-brand-logo" href="{{ url('/') }}">
                    <div class="navbarItem">
                        <p class="navbarItem">Hlavná stránka (prerobiť odkaz)</p>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
					<li><a href="{{ url('/news-admin') }}" class="navbarItem">Aktuality</a></li>
                    <li><a href="{{ url('/projects-admin') }}" class="navbarItem">Projekty</a></li>
                    <li><a href="#TODO" class="navbarItem">Pracovníci</a></li>
                    <li><a href="{{ url('/media-admin') }}" class="navbarItem">Médiá</a></li>
                    <li><a href="#TODO" class="navbarItem">Videá</a></li>
                    <li><a href="#TODO" class="navbarItem">Fotky</a></li>
				</ul>
				</ul>
            </div>
        </div>
    </nav>

	<body>
	@yield('content_admin')	
	</body>

    <div class="modal fade" id="confirmation-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="confirmation-title" class="modal-title"></h3>
                </div>
                <div id="confirmation-body" class="modal-body" >
                </div>
                <div class="modal-footer">
                    <button id="confirmation-modal-cancel" class="btn btn-danger" data-dismiss="modal">Zrušiť</button>
                    <button id="confirmation-modal-ok" class="btn btn-success">Pokračovať</button>
                </div>
            </div>
        </div>
    </div>
</html>