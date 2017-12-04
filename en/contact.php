<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'en';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact | ÚAMT FEI STU</title>
    <link rel="stylesheet" href="../css/ib_style.css">
    <?php
    loadHead();
    ?>
</head>
<body>
<?php
loadLanguageNavbar();
?>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCggSU4ruU2Ydfj_m_K_5pz9WZWKFc50ZQ&callback=initMap">
</script>
<div id="emPAGEcontent" class="container">
    <div class="col-md-6">
        <div class="ib-contact-left ib-contact-left-1">
            <fieldset>
                <legend>Institute</legend>
                <address>
                    <h4>Institute of Automotive Mechatronics</h4>
                    <h5>FEI STU</h5>
                    <h5>Ilkovičova 3</h5>
                    <h5>812 19 Bratislava</h5>
                    <h5>Slovenská republika</h5>
                </address>
            </fieldset>
        </div>
        <div class="ib-contact-left ib-contact-left-2">
            <fieldset>
                <legend>Sekretariat</legend>
                <address>
                    <h4>Katarína Kermietová</h4>
                    <h5>Room D116</h5>
                    <h5>Phone: +421 (2) 60 291 598</h5>
                </address>
            </fieldset>
        </div>
    </div>
    <div id="map" class="ib-contact-right ib-contact-right-1 col-md-6">

    </div>
</div>

<?php
loadLanguageFooter();
loadJScripts();
?>
<script type="text/javascript" src="../js/ib-contact.js"></script>
</body>
</html>