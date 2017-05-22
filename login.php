<!DOCTYPE html>
<html>
<title>index</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<link rel="stylesheet" href="css/eb_general.css">
<link rel="stylesheet" href="css/login.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script>
    function ldapLogin(login, password){
        $.ajax({
            type: "POST",
            url: "ldapLogin.php",
            data:{ login: login,
                   password: password},
            success: function(data){
                if(data == "true") {
                    window.location.href = "index.php";
                } else {
                    document.getElementById("badLogin").style.display = "block";
                }
            }
        })
    }
</script>
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
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <input type="text" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <button type="button" class="btn btn-lg btn-primary btn-block btn-signin" onclick="ldapLogin(document.getElementById('inputLogin').value,document.getElementById('inputPassword').value)">Prihlásenie</button>
                <span id="badLogin" style="color: red; display: none">Zle prihlasovacie údaje!</span>
            </form>
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
