<?php
    require_once '../general_functions.php';
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'sk';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Domov | ÚAMT FEI STU</title>
    <?php
        loadHead();
    ?>
</head>
<body>
    <?php
        loadLanguageNavbar();
        //loadNavbarSK();
    ?>

    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Nadpis</h1>
                    <hr>
                        <div>
                            <p>Tu mozete smelo davat co chcete</p>

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