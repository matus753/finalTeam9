<?php

require_once __DIR__ . '/config.php';

function new_connection() {
        $hostname = "localhost";
        $username = "tim9";
        $password = "tim9";
        $dbname = "final";

        $conn = new mysqli($hostname, $username, $password, $dbname);

        if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
        }
        mysqli_set_charset($conn, "utf8");

        return $conn;
}

function loginLDAP($login, $password){
    $ldap_server = "ldap.stuba.sk";

    //Valid if user have access to Intranet
    $conn = new_connection();
    $sql = "SELECT * FROM staff WHERE ldapLogin='$login'";
    $result = $conn->query($sql);
    /*if ($result->num_rows != 1){
        print "failure: no access rights<br>\n";
        return false;
    }*/

    //LDAP login
    if($connect=@ldap_connect($ldap_server)){ // if connected to ldap server

        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

        // bind to ldap connection
        if(($bind=@ldap_bind($connect)) == false){
            print "bind:__FAILED__<br>\n";
            return false;
        }

        // search for user
        if (($res_id = ldap_search( $connect,
                "dc=stuba, dc=sk",
                "uid=$login")) == false) {
            print "failure: search in LDAP-tree failed<br>";
            return false;
        }

        if (( $entry_id = ldap_first_entry($connect, $res_id))== false) {
            print "failure: entry of searchresult couln't be fetched<br>\n";
            return false;
        }

        if (( $user_dn = ldap_get_dn($connect, $entry_id)) == false) {
            print "failure: user-dn coulnd't be fetched<br>\n";
            return false;
        }

        /* Authentifizierung des User */
        if (($link_id = ldap_bind($connect, $user_dn, $password)) == false) {
            print "failure: username, password didn't match: $user_dn<br>\n";
            return false;
        }
        try{
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION["role"] =  "11000";//$row["role"];
            $_SESSION["user"] =  $login;
            @ldap_close($connect);
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    } else {                                  // no conection to ldap server
        echo "no connection to '$ldap_server'<br>\n";
    }

    echo "failed: ".ldap_error($connect)."<BR>\n";

    @ldap_close($connect);
    return(false);
}
function loadHead(){
    echo    '<meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="../css/eb_general.css">
                <link href="../css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">';
}

function loadLanguageNavbar($isIntranet = false){
/*    header('Cache-control: private'); // IE 6 FIX*/
    if(isSet($_GET['lang']))
    {
        $lang = $_GET['lang'];
// register the session and set the cookie
        $_SESSION['lang'] = $lang;
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else if(isSet($_SESSION['lang']))
    {
        $lang = $_SESSION['lang'];
    }
    else if(isSet($_COOKIE['lang']))
    {
        $lang = $_COOKIE['lang'];
    }
    else
    {
        $lang = 'sk';
    }
    switch ($lang) {
        case 'en':
            loadNavbarEN($isIntranet);
            break;
        case 'sk':
            loadNavbarSK($isIntranet);
            break;
        default:
            loadNavbarSK($isIntranet);
    }
}


function loadNavbarSK($isIntranet = false){
    $last = $_SESSION['page'];
    $lastAll = explode('?',$last);
    $last = $lastAll[0];
    $all = explode("/", $last);
    if (!$isIntranet){
        $lastPage = $all[3];
        $pathENfile = '../en/' . $lastPage;
        $pathSK = $_SERVER['HTTP_HOST'] .$last;
        if (!file_exists($pathENfile)) {
            $pathEN = $_SERVER['HTTP_HOST'] . '/' . $all[1] . '/en/index.php';
            echo '<script>console.log("' . $pathEN . '")</script>';
        } else {
            $pathEN = $_SERVER['HTTP_HOST'] . '/' . $all[1] . '/en/' . $lastPage;

            echo '<script>console.log("' . $pathEN . '")</script>';
        }
        $upDir = '';
    } else{
        $pathSK = $_SERVER['HTTP_HOST'] .$last.'?lang=sk';
        $pathEN = $_SERVER['HTTP_HOST'] .$last.'?lang=en';
        $upDir = '../sk/';
    }

    echo '    <nav class="navbar navbar-default navbar-fixed-top" id="navbar-custom">
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
                        <img id="logoIMG" src="../images/logo/logo_skratkove_transparentne_na_modre_pozadie.png" width="167" alt="logo">
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
                    <!--<li><a href="#" class="navbarItem">O nás</a></li>-->
                    <li><a href="'.$upDir.'staff.php" class="navbarItem">Pracovníci</a></li>
                    <li><a href="#" class="navbarItem">Štúdium</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Výskum <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="'.$upDir.'projects.php" class="navbarItem">Projekty</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Výskumné oblasti <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem">
                                    <li><a href="#" >Elektrická motokára</a></li>
                                    <li><a href="#" >Autonómne vozidlo 6×6</a></li>
                                    <li><a href="#" >3D LED kocka</a></li>
                                    <li><a href="#" >Biomechatronika</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="'.$upDir.'news.php" class="navbarItem">Aktuality</a></li>
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
                    <li><a href="'.$upDir.'contact.php" class="navbarItem">Kontakt</a></li>';
    if(isset($_SESSION['role'])) {
        echo '<li><a href="'.$upDir.'../intra/profil.php" class="navbarItem">Intranet</a></li>';
    }
                echo '<li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.'http://'.$pathSK.'" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  SK</a></li>
                            <li><a href="'.'http://'.$pathEN.'" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  EN</a></li>
                        </ul>
                    </li>';
    if(!isset($_SESSION['role'])) {
        echo '<li><a href = "http://'. $_SERVER['HTTP_HOST'] . '/' . $all[1] . "/sk/login.php"  . '" class="navbarItem" ><span class="glyphicon glyphicon-user" ></span ></a></li>';
    } else {
        echo '<li><a href = "http://'. $_SERVER['HTTP_HOST'] . '/' . $all[1] . "/sk/logout.php"  . '" class="navbarItem" ><span class="glyphicon glyphicon-off" ></span ></a></li>';
    }

    echo            '</ul>
            </div>
        </div>
    </nav>';
}


function loadLanguageFooter($isIntranet = false){
    /*    header('Cache-control: private'); // IE 6 FIX*/
    if(isSet($_GET['lang']))
    {
        $lang = $_GET['lang'];
// register the session and set the cookie
        $_SESSION['lang'] = $lang;
        //setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else if(isSet($_SESSION['lang']))
    {
        $lang = $_SESSION['lang'];
    }
    else if(isSet($_COOKIE['lang']))
    {
        $lang = $_COOKIE['lang'];
    }
    else
    {
        $lang = 'sk';
    }
    switch ($lang) {
        case 'en':
            loadFooterEN();
            break;
        case 'sk':
            loadFooterSK();
            break;
        default:
            loadFooterSK();
    }
}

function loadFooterSK(){
        echo '<div class="push"></div><footer class="footer">
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
          <li class="ib-highlited">© 2017 Tim 9<li>
        </ul>
    </div>
    </div>
  </div>
</div>
</footer>';
}

function loadFooterEN(){
    echo '<div class="push"></div><footer class="footer">
    <div class="container-fluid">    
  <div class="row small bottom">
    <div class="col-lg-offset-2" style="padding-top: 10px;">
      <div class="col-md-3">
        <ul class="list-unstyled">
          <li class="ib-highlited">STU<li>
          <li> <a target="_blank" href="http://is.stuba.sk"> AIS STU </a> </li>
                        <li> <a target="_blank" href="https://www.jedalen.stuba.sk/WebKredit"> STU Canteen </a> </li>
                        <li> <a target="_blank" href="https://webmail.stuba.sk"> Webmail STU </a> </li>
                        <li> <a target="_blank" href="https://kis.cvt.stuba.sk/i3/epcareports/epcarep.csp?ictx=stu&language=1"> STU publication registry </a> </li>
        </ul>
      </div>
      <div class="col-md-3">
        <ul class="list-unstyled">
          <li class="ib-highlited">FEI<li>
          <li> <a target="_blank" href="http://aladin.elf.stuba.sk/rozvrh"> FEI timetable </a> </li>
                        <li> <a target="_blank" href="http://elearn.elf.stuba.sk/moodle"> Moodle FEI </a> </li>              
        </ul>
      </div>
      <div class="col-md-3">
        <ul class="list-unstyled">
          <li class="ib-highlited">Other<li>
          <li> <a target="_blank" href="http://www.sski.sk/webstranka"> SSKI </a> </li>
                        <li> <a target="_blank" href="http://okocasopis.sk"> OKO magazine </a> </li>
                        <li> <a target="_blank" href="https://www.facebook.com/UAMTFEISTU"> Facebook </a> </li>
                        <li> <a target="_blank" href="https://www.youtube.com/channel/UCo3WP2kC0AVpQMIiJR79TdA"> YouTube </a> </li>						        
        </ul>
      </div>
      <div class="col-md-3" style="padding-top: 80px; ">
        <ul class="list-unstyled">
          <li class="ib-highlited">© 2017 Tim 9<li>
        </ul>
    </div>
    </div>
  </div>
</div>
</footer>';
}

function loadJScripts(){
    echo '<script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/ib-footer-resize.js"></script>';
}

function generatePageByDirectory($page){
    if (!file_exists("../intranet/$page")) {
        mkdir("../intranet/$page", 0777, true);
         while (!file_exists("../intranet/$page")) sleep(1);
    }
    $directories = scandir("../intranet/$page");
    foreach ($directories as $key => $value) {
        if($value !== '.' && $value !== '..') {
            echo '<a data-toggle="collapse" href="#'.$value.'" class="list-group-item" data-parent="#accordion"><li class="lock">' . $value . '</li></a>';
            $files = scandir("../intranet/$page/$value");
            echo '<div id="'.$value.'" class="panel-collapse collapse" style="padding: 25px; padding-bottom: 40px"><div class="list-group action-list-group">';
            foreach ($files as $key2 => $val) {
                if($val !== '.' && $val !== '..') {
                    echo '<li class="list-group-item"><a class="list-group-link" href="../intranet/' . $page . '/' . $value . '/' . $val . '" download="' . $val . '">' . $val . '</a><span class="pull-right">
                           <a class="btn btn-sm btn-default" onclick="deleteRecord(true,' . "'../intranet/" . $page .  '/' . $value . '/' . $val ."')\"" . '><span class="glyphicon glyphicon-remove"></a></span></span></li>';
                }
            }

            $conn = new_connection();
            $sql = "SELECT * FROM url WHERE page = '$page' AND category =  '$value'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item"><a class="list-group-link" target="_blank" href="' . $row["url"] .'">' . $row["url"] . '</a><span class="pull-right">
                           <a class="btn btn-sm btn-default" onclick="deleteRecord(false,' .  $row["id"] .')"><span class="glyphicon glyphicon-remove"></a></span></span></li>';
                }
            }
            echo "</div>";

            echo '<form enctype="multipart/form-data" method="post" action="" style="margin-top:20px">
                    <div class="col-xs-4" id="choice" >
                        <input type="text" name="dir" style="display: none" value="'. $value . '"/>
                        <input name="myfile" type="file"  class="form-control" onchange="fileUpload(this,'."'". $value . 'btn' . "'" .')"/>
                    </div>
                    <div class="col-xs-1" >
                        <input type="submit" value="Upload" name="submit" id="'. $value . 'btn' . '" class="btn btn-primary" disabled="disabled"/>
                    </div>
                    <div class="col-xs-1"></div>
                </form>';
            echo '<form method="post" action="" style="margin-top:20px">
                    <div class="col-xs-4" id="choice" >
                        <input type="text" name="dir" style="display: none" value="'. $value . '"/>
                        <input name="url" type="text" class="form-control" placeholder="Vložte url" onchange="urlUpload(this.value,'."'". $value . 'btn2' . "'" .')"/>
                    </div>
                    <div class="col-xs-1" >
                        <input type="submit" value="Upload" name="submit" class="btn btn-primary" id="'. $value . 'btn2' . '" class="btn btn-primary" disabled="disabled"/>
                    </div>
                </form>';
            echo "</div>";
        }
    }
}

function saveUrl($page, $category, $url){
    updateSql("INSERT INTO url VALUES (NULL,'$page','$category','$url');");

}

function updateSql($sql){
    $conn = new_connection();
    if ($conn->query($sql) !== TRUE) {
        die(json_encode(array('message' => 'SQL-ERROR', 'code' => 500)));
    }
}

function loadNavbarEN($isIntranet = false){
    $last = $_SESSION['page'];
    $lastAll = explode('?',$last);
    $last = $lastAll[0];
    $all = explode("/", $last);
    if (!$isIntranet){

		$all = explode("/", $last);
		$lastPage = $all[3];
		$pathSK = $_SERVER['HTTP_HOST'] .'/'.$all[1].'/sk/'.$lastPage;
        $pathEN = $_SERVER['HTTP_HOST'] .$last;
        $upDir = "";
	}else{
        $pathSK = $_SERVER['HTTP_HOST'] .$last.'?lang=sk';
        $pathEN = $_SERVER['HTTP_HOST'] .$last.'?lang=en';
        $upDir = "../en/";
    }

    echo '    <nav class="navbar navbar-default navbar-fixed-top" id="navbar-custom">
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
                        <img id="logoIMG" src="../images/logo/logo_skratkove_transparentne_na_modre_pozadie.png" width="167" alt="logo">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="emNavbar">
                <ul class="nav navbar-nav navbar-right scrollable-menu">
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">About us <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.$upDir.'aboutUs.php#section1" id="navSec1" class="navbarItem sectItem">History</a></li>
                            <li><a href="'.$upDir.'aboutUs.php#section2" id="navSec2" class="navbarItem sectItem">Head of Institute</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="'.$upDir.'aboutUs.php#section3" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Oddelenia <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem4" >
                                    <li><a href="'.$upDir.'aboutUs.php#section3" id="navSec31" class="sectItem">Department of Mechanics and Mechatronics (OAMM)</a></li>
                                    <li><a href="'.$upDir.'aboutUs.php#section32" id="navSec32" class="sectItem">Department of Information, Communication and Control Systems  (OIKR)</a></li>
                                    <li><a href="'.$upDir.'aboutUs.php#section33" id="navSec33" class="sectItem">Department of Electronics, Microcomputers and PLC (OEMP)</a></li>
                                    <li><a href="'.$upDir.'aboutUs.php#section34" id="navSec34" class="sectItem">Department of E-mobility, Automation and Drives (OEAP)</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!--<li><a href="#" class="navbarItem">About us</a></li>-->
                    <li><a href="'.$upDir.'staff.php" class="navbarItem">Staff</a></li>
                    <li><a href="#" class="navbarItem">Study</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Research <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="'.$upDir.'projects.php" class="navbarItem">Projects</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Research topics <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem5" >
                                    <li><a href="#" >Electric kart</a></li>
                                    <li><a href="#" >Off-line vehicle 6×6</a></li>
                                    <li><a href="#" >3D LED cube</a></li>
                                    <li><a href="#" >Biomechatronics</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="'.$upDir.'news.php" class="navbarItem">News</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Activities <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="'.$upDir.'photo.php" class="navbarItem">Photos</a></li>
                            <li><a href="'.$upDir.'video.php" class="navbarItem">Video</a></li>
                            <li><a href="'.$upDir.'media.php" class="navbarItem">Media</a></li>
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Our thematic web sites <b class="caret"></b></a>
                                <ul class="dropdown-menu submenuItem2 navbarItem" >
                                    <li><a href="http://www.e-mobilita.fei.stuba.sk/" >Electromobility</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li><a href="'.$upDir.'contact.php" class="navbarItem">Contact</a></li>';
    if(isset($_SESSION['role'])) {
        echo '<li><a href="'.$upDir.'../intra/profil.php" class="navbarItem">Intranet</a></li>';
    }
    echo    '<li class="dropdown">
                        <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.'http://'.$pathSK.'" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  SK</a></li>
                            <li><a href="'.'http://' . $pathEN. '" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  EN</a></li>
                        </ul>
                    </li>
                    <li>';
    if(!isset($_SESSION['role'])) {
        echo '<li><a href = "http://'. $_SERVER['HTTP_HOST'] . '/' . $all[1] . "/en/login.php"  . '" class="navbarItem" ><span class="glyphicon glyphicon-user" ></span ></a></li>';
    } else {
        echo '<li><a href = "http://'. $_SERVER['HTTP_HOST'] . '/' . $all[1] . "/en/logout.php"  . '" class="navbarItem" ><span class="glyphicon glyphicon-off" ></span ></a></li>';
    }

    echo            '</ul>
            </div>
        </div>
    </nav>';
}

function isUser(){
    if(isset($_SESSION["role"])) {
        if ($_SESSION["role"][0] == 1 || $_SESSION["role"][4] == '1')
            return true;
    }
    return false;
}

function isHr(){
    if(isset($_SESSION["role"])) {
        if ($_SESSION["role"][1] == '1' || $_SESSION["role"][4] == '1')
            return true;
    }
    return false;
}

function isReporter(){
    if(isset($_SESSION["role"])) {
        if($_SESSION["role"][2] == '1' || $_SESSION["role"][4] == '1')
            return true;
    }
    return false;
}

function isEditor(){
    if(isset($_SESSION["role"])) {
        if ($_SESSION["role"][3] == '1' || $_SESSION["role"][4] == '1')
            return true;
    }
    return false;
}

function isAdmin(){
    if(isset($_SESSION["role"])) {
        if ($_SESSION["role"][4] == '1')
            return true;
    }
    return false;
}

function generate401Html(){
    echo '<!DOCTYPE html>
            <html>
            <head>
                <title>401 Unauthorized | ÚAMT FEI STU</title>';
    loadHead();

    echo    '<style>
                .cover{display:table-cell;vertical-align:middle;padding:0 20px}
                .lead{color:silver;font-size:21px;line-height:1.4}
            </style></head>
            <body>';
    loadLanguageNavbar();

    echo "<div id=\"emPAGEcontent\">
    <div class=\"container\">
    <div class=\"cover\">
        <h1>Unauthorized <small>Error 401</small></h1>
        <p class=\"lead\">The requested resource requires an authentication.</p>
    </div>
    </div>
    </div>";
    loadLanguageFooter();
    loadJScripts();
    echo '</body>';
    echo '</html>';
}