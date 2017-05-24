<?php
require_once 'general_functions.php';


?>
<!DOCTYPE html>
<html>
<head>
    <title>Aktuality | ÚAMT FEI STU</title>
    <link rel="stylesheet" href="css/ib_style.css">
    <?php
    loadHead();
    ?>
</head>
<body>
<?php
loadNavbar();
?>
<div id="emPAGEcontent" class="container">
        <div class="row">
            <div class="ib-inline ib-left">
                <h3>Aktuality</h3>
            </div>
            <div class="ib-inline ib-right">
                Typ:
                <select onchange="updateType()" id="ib-news-select">
                    <option>Propagácia</option>
                    <option>Oznamy</option>
                    <option>Zo života ústavu</option>
                    <option selected>Všetky</option>
                </select>

                Expirované:
                <input id="ib-news-chb" type="checkbox" onclick="showExpired()">
            </div>
<!--            <hr>-->
        </div>

    <div class="row" id="news-content">
        <div class="col-md-12">

        </div>
    </div>
</div>

<?php
loadFooter();
loadJScripts();
?>
<script type="text/javascript" src="js/ib-news.js"></script>
</body>
</html>