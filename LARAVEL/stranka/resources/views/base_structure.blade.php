<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/eb_general.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">    

        <script src=" {{ URL::asset('js/scripty_upButton.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/ib-footer-resize.js') }}"></script>
		<script src="{{ URL::asset('js/additional_js.js') }}"></script>
		
		<title> ÚAMT - {{ $title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('additional_headers')
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
                    <div class="logo">
                        <img id="logoIMG" class="logo-lg" src="{{ URL::asset('images/logo/logo_skratkove_transparentne_na_modre_pozadie.png') }}" alt="logo">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
					<li><a href="{{ url('/news') }}" class="navbarItem">Aktuality</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">O nás <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/history') }}" id="navSec1" class="navbarItem sectItem">História</a></li>
                            <li><a href="{{ url('/management') }}" id="navSec2" class="navbarItem sectItem">Vedenie ústavu</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Oddelenia <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem3" >
                                    <li><a href="{{ url('/institutes') }}" id="navSec31" class="sectItem">Oddelenie aplikovanej mechaniky a mechatroniky (OAMM)</a></li>
                                    <li><a href="{{ url('/institutes') }}" id="navSec32" class="sectItem">Oddelenie informačných, komunikačných a riadiacich systémov (OIKR)</a></li>
                                    <li><a href="{{ url('/institutes') }}" id="navSec33" class="sectItem">Oddelenie elektroniky, mikropočítačov a PLC systémov (OEMP)</a></li>
                                    <li><a href="{{ url('/institutes') }}" id="navSec34" class="sectItem">Oddelenie E-mobility, automatizácie a pohonov (OEAP)</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/staff') }}" class="navbarItem">Pracovníci</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Štúdium <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/admission') }}" class="navbarItem sectItemS">  Pre uchádzačov o štúdium</a></li>
                            <li><a href="{{ url('/bachelor') }}" class="navbarItem sectItemS">  Bakalárske štúdium</a></li>
                            <li><a href="{{ url('/master') }}" class="navbarItem sectItemS">  Inžinierske štúdium</a></li>
                            <li><a href="{{ url('/doctoral') }}" class="navbarItem sectItemS">  Doktorandské štúdium</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Výskum <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="{{ url('/projects') }}" class="navbarItem">Projekty</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Výskumné oblasti <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem">
                                    <li><a href="{{ url('/ekart') }}" >Elektrická motokára</a></li>
                                    <li><a href="{{ url('/autonom-vehicle') }}" >Autonómne vozidlo 6×6</a></li>
                                    <li><a href="{{ url('/led-cube') }}" >3D LED kocka</a></li>
                                    <li><a href="{{ url('/biomechatronic') }}" >Biomechatronika</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aktivity <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="{{ url('/photo-gallery') }}" class="navbarItem">Fotogaléria</a></li>
                            <li><a href="{{ url('/videos') }}" class="navbarItem">Videá</a></li>
                            <li><a href="{{ url('/media') }}" class="navbarItem">Média</a></li>
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Naše témetické web stránky <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem2 navbarItem" >
                                    <li><a href="http://www.e-mobilita.fei.stuba.sk/" >Elektromobilita</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/contact') }}" class="navbarItem">Kontakt</a></li>
					<li><a href="{{ url('/intranet') }}" class="navbarItem">Intranet</a></li> 
					<li class="dropdown navbarIconSm">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown"><span class="fa fa-globe"></span></a>
                        <ul class="dropdown-menu">
							@foreach(config('languages') as $l => $lang)
								<li><a href="{{ url('/ml') }}/{{ $l }}" class="navbarItem"><span class="fa fa-flag"></span> {{ $lang }}</a></li>
							@endforeach
                        </ul>
                    </li>
					<li><a href ="#USER_Profile_show_this_icon_after_login" class="navbarItem" ><span class="fa fa-user" ></span ></a></li>   
					<li><a href ="{{ url('/login') }}" class="navbarItem" ><span class="fa fa-power-off" ></span ></a></li>
				</ul>
            </div>
        </div>
    </nav>

	
	@yield('content')
<?php debug( session()->all() ); ?>
	<div class="push"></div>
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
                        <h2 class="title">Ostatné</h2>
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