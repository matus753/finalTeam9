<?php
session_start();

require_once '../general_functions.php';
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'sk';

if(isset($_SESSION["role"])) {
    unset($_SESSION["role"]);
} else {
    header("HTTP/1.1 401 Unauthorized");
    generate401Html();
    exit;
}

$conn = new_connection();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Odhlásenie | ÚAMT FEI STU</title>
        <?php
        loadHead();
        ?>
    </head>
    <body>
<?php
loadLanguageNavbar();
?>

<!-- Page Content -->
<div id="emPAGEcontent">
    <div class="container">
        <div class="cover">
            <h1>Boli ste odhlásený!</h1>
            <p class="lead">Pre opätovné prihlásenie kliknite <a href="login.php">tu</a>.</p>
        </div>
    </div>
</div>

<?php
loadJScripts();
?>
</body>
<?php
loadFooter();
?>
</html>

