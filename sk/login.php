<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'sk';
$conn = new_connection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Prihlásenie | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
<link rel="stylesheet" href="../css/login.css">


<script>
    function ldapLogin(login, password){
        $.ajax({
            type: "POST",
            url: "../ldapLogin.php",
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
</head>
<body>
<?php
loadNavbarSK();
?>

<!-- Page Content -->
<div id="emPAGEcontent">
    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <input type="text" id="inputLogin" class="form-control" placeholder="Meno" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Heslo" required>
                <button type="button" class="btn btn-lg btn-primary btn-block btn-signin" onclick="ldapLogin(document.getElementById('inputLogin').value,document.getElementById('inputPassword').value)">Prihlásenie</button>
                <span id="badLogin" style="color: red; display: none">Zle prihlasovacie údaje!</span>
            </form>
        </div>
    </div>
</div>

<?php
loadLanguageFooter();
loadJScripts();
?>
</body>
<<<<<<< 3b3bea294cca2af16282f4c32e94f04e4484b10d
=======
<?php
loadLanguageFooter();
?>
>>>>>>> [EB] study.php v anglictine a upravene intranet.. v procese zmien
</html>
