<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/eb_general.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">    
        <link rel="shortcut icon" href="http://uamt.fei.stuba.sk/web/misc/favicon.ico" type="image/vnd.microsoft.icon" />

		<script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::asset('js/additional_js.js') }}"></script>
		
		<title> ÚAMT - {{ $title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('additional_headers')
	</head>
	<body>
    <div id="alert-div">
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
    </div>
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
                    <div class="logo">
                        <img id="logoIMG" class="logo-lg" src="{{ URL::asset('images/logo/logo_skratkove_transparentne_na_modre_pozadie.png') }}" alt="logo">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
					<li><a href="{{ url('/news') }}" class="navbarItem">@lang('menu.news')</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">@lang('menu.about')<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/history') }}" class="navbarItem sectItem">@lang('menu.history')</a></li>
                            <li><a href="{{ url('/management') }}" class="navbarItem sectItem">@lang('menu.management')</a></li>
                            <li><a href="{{ url('/institutes') }}" class="navbarItem sectItem">@lang('menu.departments')</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/staff') }}" class="navbarItem">@lang('menu.staff')</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">@lang('menu.study')<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/admission') }}" class="navbarItem sectItemS">@lang('menu.applicants')</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="{{ url('/bachelor') }}" class="dropdown-toggle" aria-haspopup="false" aria-expanded="true" >@lang('menu.bc_study')<b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem" >
                                    <li><a href="{{ url('/thesis') }}/{{ 1 }}" >@lang('menu.bc_themes')</a></li>
									<li><a href="{{ url('/subjects') }}/{{ 1 }}" >@lang('menu.subjects')</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown">
                                <a href="{{ url('/master') }}" class="dropdown-toggle" aria-haspopup="false" aria-expanded="true" >@lang('menu.ing_study')<b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem" >
                                    <li><a href="{{ url('/thesis') }}/{{ 2 }}" >@lang('menu.ing_themes')</a></li>
									<li><a href="{{ url('/subjects') }}/{{ 2 }}" >@lang('menu.subjects')</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/doctoral') }}" class="navbarItem sectItemS">@lang('menu.phd_study')</a></li>
                            <li><a href="{{ url('/schedule-subject') }}" class="navbarItem sectItemS">@lang('menu.schedule')</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('menu.research')<b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="{{ url('/projects') }}" class="navbarItem">@lang('menu.projects')</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menu.research_fields')<b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem">
                                    <li><a href="{{ url('/ekart') }}" >@lang('menu.e_cart')</a></li>
                                    <li><a href="{{ url('/autonom-vehicle') }}" >@lang('menu.a_vehicle')</a></li>
                                    <li><a href="{{ url('/led-cube') }}" >@lang('menu.cube')</a></li>
                                    <li><a href="{{ url('/biomechatronic') }}" >@lang('menu.biomechatronics')</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('menu.activities')<b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="{{ url('/photo-gallery') }}" class="navbarItem">@lang('menu.photogalery')</a></li>
                            <li><a href="{{ url('/videos') }}" class="navbarItem">@lang('menu.videos')</a></li>
                            <li><a href="{{ url('/media') }}" class="navbarItem">@lang('menu.media')</a></li>
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">@lang('menu.web_pages')<b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem2 navbarItem" >
                                    <li><a href="http://www.e-mobilita.fei.stuba.sk/" >@lang('menu.e_mobility')</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/contact') }}" class="navbarItem">@lang('menu.contact')</a></li>
                    @if(isLogged())
					<li><a href="{{ url('/documents-admin') }}" class="navbarItem">Intranet</a></li> 
                    @endif
					<li class="dropdown navbarIconSm">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown"><span class="fa fa-globe"></span></a>
                        <ul class="dropdown-menu">
							@foreach(config('languages') as $l => $lang)
								<li><a href="{{ url('/ml') }}/{{ $l }}" class="navbarItem"><span class="fa fa-flag"></span> {{ $lang }}</a></li>
							@endforeach
                        </ul>
                    </li>
                    <li><a href ="{{ url('/login') }}" class="navbarItem" ><span class="fa fa-power-off" ></span ></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="general-content">
	   @yield('content')
    </div>
    <footer class="nb-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">STU</h2>
                        <p> <i class="fa fa-info-circle" aria-hidden="true"></i> <a target="_blank" href="http://is.stuba.sk"> AIS STU </a> </p>
                        <p> <i class="fa fa-envelope" aria-hidden="true"></i> <a target="_blank" href="https://webmail.stuba.sk">@lang('footer.email')</a> </p>
                        <p> <i class="fa fa-database" aria-hidden="true"></i> <a target="_blank" href="https://kis.cvt.stuba.sk/i3/epcareports/epcarep.csp?ictx=stu&language=1">@lang('footer.evidence')</a> </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">FEI</h2>
                        <p> <i class="fa fa-cutlery" aria-hidden="true"></i> <a target="_blank" href="https://www.jedalen.stuba.sk/WebKredit">@lang('footer.canteen')</a></p>
                        <p> <i class="fa fa-calendar" aria-hidden="true"></i> <a target="_blank" href="http://aladin.elf.stuba.sk/rozvrh">@lang('footer.timetable')</a> </p>
                        <p> <i class="fa fa-cube" aria-hidden="true"></i> <a target="_blank" href="http://elearn.elf.stuba.sk/moodle">Moodle FEI</a> </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">Social</h2>
                        <p> <i class="fa fa-facebook-square" aria-hidden="true"></i> <a target="_blank" href="https://www.facebook.com/UAMTFEISTU">Facebook</a></p>
                        <p> <i class="fa fa-youtube-play" aria-hidden="true"></i> <a target="_blank" href="https://www.youtube.com/channel/UCo3WP2kC0AVpQMIiJR79TdA">YouTube</a></p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">@lang('footer.other')</h2>
                        <p> <i class="fa fa-black-tie" aria-hidden="true"></i> <a target="_blank" href="http://www.sski.sk/webstranka"> SSKI </a> </p>
                        <p> <i class="fa fa-eye" aria-hidden="true"></i> <a target="_blank" href="http://okocasopis.sk">@lang('footer.magazine')</a> </p>
                    </div>
                </div>
            </div>
        </div>

        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>© @lang('footer.copyright') 2017/2018</p>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
    </footer>
	</body>
</html>