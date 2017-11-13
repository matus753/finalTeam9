<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo URL::asset('css/eb_general.css'); ?>">
		<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		<title> ÚAMT - {{ $title }}</title>
		<script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/ib-footer-resize.js') }}"></script>
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top" id="navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#emNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-brand-logo" href="'.$upDir.'index.php">
                    <div class="logo">
                        <img id="logoIMG" src="{{ URL::asset('images/logo/logo_skratkove_transparentne_na_modre_pozadie.png') }}" width="167" alt="logo">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">O nás <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.$upDir.'aboutUs.php#section1" id="navSec1" class="navbarItem sectItem">História</a></li>
                            <li><a href="'.$upDir.'aboutUs.php#section2" id="navSec2" class="navbarItem sectItem">Vedenie ústavu</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="'.$upDir.'aboutUs.php#section3" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Oddelenia <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem3" >
                                    <li><a href="'.$upDir.'aboutUs.php#section3" id="navSec31" class="sectItem">Oddelenie aplikovanej mechaniky a mechatroniky (OAMM)</a></li>
                                    <li><a href="'.$upDir.'aboutUs.php#section32" id="navSec32" class="sectItem">Oddelenie informačných, komunikačných a riadiacich systémov (OIKR)</a></li>
                                    <li><a href="'.$upDir.'aboutUs.php#section33" id="navSec33" class="sectItem">Oddelenie elektroniky, mikropočítačov a PLC systémov (OEMP)</a></li>
                                    <li><a href="'.$upDir.'aboutUs.php#section34" id="navSec34" class="sectItem">Oddelenie E-mobility, automatizácie a pohonov (OEAP)</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="" class="navbarItem">Pracovníci</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Štúdium <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.$upDir.'study.php#section1" class="navbarItem sectItemS">  Pre uchádzačov o štúdium</a></li>
                            <li><a href="'.$upDir.'study.php#section2" class="navbarItem sectItemS">  Bakalárske štúdium</a></li>
                            <li><a href="'.$upDir.'study.php#section3" class="navbarItem sectItemS">  Inžinierske štúdium</a></li>
                            <li><a href="'.$upDir.'study.php#section4" class="navbarItem sectItemS">  Doktorandské štúdium</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Výskum <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="'.$upDir.'projects.php" class="navbarItem">Projekty</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Výskumné oblasti <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem">
                                    <li><a href="ekart.php" >Elektrická motokára</a></li>
                                    <li><a href="autonomVehicle.php" >Autonómne vozidlo 6×6</a></li>
                                    <li><a href="ledCube.php" >3D LED kocka</a></li>
                                    <li><a href="biomechatronic.php" >Biomechatronika</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="" class="navbarItem">Aktuality</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aktivity <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="'.$upDir.'photo.php" class="navbarItem">Fotogaléria</a></li>
                            <li><a href="'.$upDir.'video.php" class="navbarItem">Videá</a></li>
                            <li><a href="'.$upDir.'media.php" class="navbarItem">Média</a></li>
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Naše témetické web stránky <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem2 navbarItem" >
                                    <li><a href="http://www.e-mobilita.fei.stuba.sk/" >Elektromobilita</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="" class="navbarItem">Kontakt</a></li>
					<li><a href="" class="navbarItem">Intranet</a></li> 
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  SK</a></li>
                            <li><a href="" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  EN</a></li>
                        </ul>
                    </li>
					<li><a href = "" class="navbarItem" ><span class="glyphicon glyphicon-user" ></span ></a></li>   
					<li><a href = "" class="navbarItem" ><span class="glyphicon glyphicon-off" ></span ></a></li>
				</ul>
            </div>
        </div>
    </nav>
	
	@yield('content')
	
	<div class="push"></div><footer class="footer">
		<div class="container-fluid">    
			<div class="row small bottom">
				<div class="col-lg-offset-2" style="padding-top: 10px;">
					<div class="col-md-3">
						<ul class="list-unstyled">
							<li class="ib-highlited">STU<li>
							<li> <a target="_blank" href="http://is.stuba.sk"> AIS STU </a> </li>
							<li> <a target="_blank" href="https://www.jedalen.stuba.sk/WebKredit"> Jedáleň STU </a> </li>
							<li> <a target="_blank" href="https://webmail.stuba.sk"> Webmail STU </a> </li>
							<li> <a target="_blank" href="https://kis.cvt.stuba.sk/i3/epcareports/epcarep.csp?ictx=stu&language=1"> Evidencia publikácií STU </a> </li>
						</ul>
					</div>
					<div class="col-md-3">
						<ul class="list-unstyled">
						<li class="ib-highlited">FEI<li>
						<li> <a target="_blank" href="http://aladin.elf.stuba.sk/rozvrh"> Rozvrh hodín FEI </a> </li>
                        <li> <a target="_blank" href="http://elearn.elf.stuba.sk/moodle"> Moodle FEI </a> </li>              
					</ul>
					</div>
					<div class="col-md-3">
					<ul class="list-unstyled">
						<li class="ib-highlited">Ostatné<li>
						<li> <a target="_blank" href="http://www.sski.sk/webstranka"> SSKI </a> </li>
                        <li> <a target="_blank" href="http://okocasopis.sk"> Časopis OKO </a> </li>
                        <li> <a target="_blank" href="https://www.facebook.com/UAMTFEISTU"> Facebook </a> </li>
                        <li> <a target="_blank" href="https://www.youtube.com/channel/UCo3WP2kC0AVpQMIiJR79TdA"> YouTube </a> </li>						        
					</ul>
					</div>
					<div class="col-md-3" style="padding-top: 80px; ">
					<ul class="list-unstyled">
						<li class="ib-highlited">© Tímový projekt 2017/2018<li>
					</ul>
					</div>
				</div>
			</div>
		</div>
		</footer>
	</body>	
</html>