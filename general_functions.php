<?php

include('config.php');

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
    if ($result->num_rows != 1){
        print "failure: no access rights<br>\n";
        return false;
    }

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
            $_SESSION["role"] =  $row["role"];
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
                <link rel="stylesheet" href="css/eb_general.css">
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">';
}

function loadNavbar(){
    echo '    <nav class="navbar navbar-default navbar-fixed-top" id="navbar-custom">
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
                        <img id="logoIMG" src="./images/logo/logo_skratkove_transparentne_na_modre_pozadie.png" width="167" alt="logo">
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
                            <li class="dropdown-submenu dropdown">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Výskumné oblasti <b class="caret"></b></a>
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
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle navbarItem" data-toggle="dropdown">Naše témetické web stránky <b class="caret"></b></a>
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
                            <li><a href="#" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  SK</a></li>
                            <li><a href="#" class="navbarItem"><span class="glyphicon glyphicon-flag"></span>  EN</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="navbarItem"><span class="glyphicon glyphicon-user"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>';
}

function loadJScripts(){
    echo '<script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>';
}

function generatePageByDirectory($page){
    $directories = scandir("intranet/$page");
    foreach ($directories as $key => $value) {
        if($value !== '.' && $value !== '..') {
            echo '<a data-toggle="collapse" href="#'.$value.'" class="list-group-item" data-parent="#accordion"><li class="lock">' . $value . '</li></a>';
            $files = scandir("intranet/$page/$value");
            echo '<div id="'.$value.'" class="panel-collapse collapse" style="padding: 25px; padding-bottom: 50px"><div class="list-group">';
            foreach ($files as $key2 => $val) {
                if($val !== '.' && $val !== '..') {
                    echo '<a class="list-group-item" href="intranet/' . $page . '/' . $value . '/' . $val . '" download="' . $val . '">' . $val . '</a>';
                }
            }

            $conn = new_connection();
            $sql = "SELECT * FROM url WHERE page = '$page' AND category =  '$value'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<a class="list-group-item" target="_blank" href="' . $row["url"] .'">' . $row["url"] . '</a>';
                }
            }
            echo "</div>";

            echo '<form enctype="multipart/form-data" method="post" action="" style="margin-top:20px">
                    <div class="col-xs-4" id="choice" >
                        <input type="text" name="dir" style="display: none" value="'. $value . '"/>
                        <input name="myfile" type="file"  class="form-control"/>
                    </div>
                    <div class="col-xs-1" >
                        <input type="submit" value="Upload" name="submit" class="btn btn-primary"/>
                    </div>
                    <div class="col-xs-1"></div>
                </form>';
            echo '<form method="post" action="" style="margin-top:20px">
                    <div class="col-xs-4" id="choice" >
                        <input type="text" name="dir" style="display: none" value="'. $value . '"/>
                        <input name="url" type="text" class="form-control" placeholder="Vložte url"/>
                    </div>
                    <div class="col-xs-1" >
                        <input type="submit" value="Upload" name="submit" class="btn btn-primary"/>
                    </div>
                </form>';
            echo "</div>";
        }
    }
}

function saveUrl($page, $category, $url){
    $conn = new_connection();
    $sql = "INSERT INTO url VALUES (NULL,'$page','$category','$url');";
    if ($conn->query($sql) !== TRUE) {
        die(json_encode(array('message' => 'SQL-ERROR', 'code' => 500)));
    }
}