<!DOCTYPE html>
<?php
    require_once __DIR__ . "/projects_functions.php";
    require_once __DIR__ . "/config.php";  
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/scripty_projects.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/eb_general.css">
    <link rel="stylesheet" href="css/style_projects.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <title>Projects | UAMT</title>
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
                <a class="navbar-brand navbar-brand-logo" href="#">
                    <div class="logo">
                        <img id="logoIMG" src="./images/logo/logo_skratkove_transparentne_na_modre_pozadie.png" width="167">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
                    <li><a href="#" class="navbarItem">O nás</a></li>
                    <li><a href="#" class="navbarItem">Pracovníci</a></li>
                    <li><a href="#" class="navbarItem">Štúdium</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Výskum <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="#" class="navbarItem">Projekty</a></li>
<!--                            <li class="divider"></li>-->
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Výskumné oblasti </a>
                                <ul class="dropdown-menu submenuItem" >
                                    <li><a href="#" >Elektrická motokára</a></li>
                                    <li><a href="#" >Autonómne vozidlo 6×6</a></li>
                                    <li><a href="#" >3D LED kocka</a></li>
                                    <li><a href="#" >Biomechatronika</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#" class="navbarItem">Aktuality</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aktivity <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="#" class="navbarItem">Fotogaléria</a></li>
                            <li><a href="#" class="navbarItem">Videá</a></li>
                            <li><a href="#" class="navbarItem">Média</a></li>
                            <!--                            <li class="divider"></li>-->
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Naše témetické web stránky </a>
                                <ul class="dropdown-menu submenuItem2 navbarItem" >
                                    <li><a href="http://www.e-mobilita.fei.stuba.sk/" >Elektromobilita</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li><a href="#" class="navbarItem">Kontakt</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="navbarItem">SK</a></li>
                            <li><a href="#" class="navbarItem">EN</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      
     <!-- Page Content -->
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"> 
                    <h1>Projekty</h1>
                    
                    <hr>
                    <h2>Medzinárodné projekty</h2>
                    <?php zobraz_projekty("Program"); ?>
                    <h2>VEGA projekty</h2>
                    <?php zobraz_projekty("VEGA"); ?>
                    <h2>APVV projekty</h2>
                    <?php zobraz_projekty("APVV"); ?>
                    <h2>KEGA projekty</h2>
                    <?php zobraz_projekty("KEGA"); ?>
                    <h2>Iné domáce projekty</h2>
                    <?php zobraz_projekty("Iné"); ?> 
                </div>
            </div>
        </div>
        
      <!-- jQuery -->
      <script src="js/jquery.js"></script>
      <script src="js/navbarTouch.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
    </body>
</html>