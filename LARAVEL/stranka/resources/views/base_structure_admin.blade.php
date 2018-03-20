<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/intra_general.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">    

		<script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::asset('js/additional_js.js') }}"></script>
		
		<title> ÚAMT - {{ $title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('additional_headers_admin')
	</head>
	<body>
    @if(session()->has('err_code'))
        @if(session()->get('err_code')['type'] == 'success')
        <div id="alert" class="alert alert-success alert-dismissable fade in" style="position: fixed; z-index: 999999999999; top:8em; right:2em;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session()->get('err_code')['msg'] }}.
        </div>
        @elseif(session()->get('err_code')['type'] == 'warning')
        <div id="alert" class="alert alert-warning alert-dismissable fade in" style="position: fixed; z-index: 999999999999; top:8em; right:2em;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> {{ session()->get('err_code')['msg'] }}.
        </div>
        @elseif(session()->get('err_code')['type'] == 'error')
        <div id="alert" class="alert alert-danger alert-dismissable fade in" style="position: fixed; z-index: 999999999999; top:8em; right:2em;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session()->get('err_code')['msg'] }}.
        </div>
        @elseif(session()->get('err_code')['type'] == 'info')
        <div id="alert" class="alert alert-info alert-dismissable fade in" style="position: fixed; z-index: 999999999999; top:8em; right:2em;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Info!</strong> {{ session()->get('err_code')['msg'] }}.
        </div>
        @endif
    @endif
	<a id="return-to-top" onclick="scrollToTop()"><i class="fa fa-arrow-up"></i></a>
	<nav class="navbar navbar-default" id="navbar-custom">
        <div id="navbarContainer" class="container">
            <div class="navbar-header">
                <button id="collapsedButton" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#emNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-brand-logo" href="{{ url('/') }}">
                    <div class="navbarItem">
                        <img id="logoIMG" class="logo-lg" src="{{ URL::asset('images/logo/logo_skratkove_transparentne_na_modre_pozadie.png') }}" alt="logo">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
                    <li><a href="{{ url('/schedule-admin') }}" class="navbarItem">@lang('menu.schedule')</a></li>
					@if(has_permission('reporter')) <li><a href="{{ url('/news-admin') }}" class="navbarItem">@lang('menu.news')</a></li> @endif
                    @if(has_permission('reporter')) <li><a href="{{ url('/events-admin') }}" class="navbarItem">@lang('menu.events')</a></li> @endif
                    <li><a href="{{ url('/subjects-admin') }}" class="navbarItem">@lang('menu.subjects')</a></li>
                    <li><a href="{{ url('/attendance-admin') }}" class="navbarItem">@lang('menu.attendance')</a></li>
                    <li><a href="{{ url('/documents-admin') }}" class="navbarItem">@lang('menu.documents')</a></li>
                    @if(has_permission('editor')) <li><a href="{{ url('/projects-admin') }}" class="navbarItem">@lang('menu.projects')</a></li> @endif
                    @if(has_permission('admin')) <li><a href="{{ url('/staff-admin') }}" class="navbarItem">@lang('menu.staff')</a></li> @endif
                    @if(has_permission('hr')) <li><a href="{{ url('/media-admin') }}" class="navbarItem">@lang('menu.media')</a></li> @endif
                    @if(has_permission('reporter')) <li><a href="{{ url('/videos-admin') }}" class="navbarItem">@lang('menu.videos')</a></li> @endif
                    @if(has_permission('reporter')) <li><a href="{{ url('/photos-admin') }}" class="navbarItem">@lang('menu.photos')</a></li> @endif
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
                    <button id="confirmation-modal-cancel" class="btn btn-danger" data-dismiss="modal">@lang('menu.cancel')</button>
                    <button id="confirmation-modal-ok" class="btn btn-success">@lang('menu.ok')</button>
                </div>
            </div>
        </div>
    </div>
</html>