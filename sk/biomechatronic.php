<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'sk';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Biomechatronika | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
</head>
<body>
<?php
loadLanguageNavbar();
?>
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">Biomechatronika</h1>
                <hr>
                <div>
                    <img src="http://uamt.fei.stuba.sk/web/sites/subory/vedecke_materialy/biomechatronika.jpg" alt="Biomechatronika" style="width:100%;height:100%">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
loadLanguageFooter();
loadJScripts();
?>
</body>
</html>