<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'en';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Autonomus vehicle | ÚAMT FEI STU</title>
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
                <h1 class="hlNadpis">Autonomus vehicle 6×6</h1>
                <hr>
                <div>
                    <img src="http://uamt.fei.stuba.sk/web/sites/images/vozidlo6x6/dve_vozidla.png" alt="Autonómne vozidlo 6×6" style="width:100%;height:100%">

                    <p>&nbsp;</p>

                    <h3>Technical parameters:</h3>
                    <ul style="list-style-type:square; display: inline-block">
                        <li>Weight: 12,5kg</li>
                        <li>Dimensions (l x w x h): 614 x 495 x 269 mm</li>
                        <li>Type of control: Remote control, controlled by microprocessor</li>
                        <li>Propulsion: 6x6, each wheel controlled independently by BLCD electric motor</li>
                        <li>Total power of electric motors: 6x 175W</li>
                        <li>Power supply: 6x DC / AC converter</li>
                        <li>Power Source: 4x Li-Pol Batteries</li>
                        <li>Total battery capacity: 13.2 Ah</li>
                    </ul>  <img src="http://uamt.fei.stuba.sk/web/sites/images/Render_ISO.jpg" alt="Autonómne vozidlo 6×6" style="width:40%;height:40%;float:right;">

                    <p>&nbsp;</p>
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