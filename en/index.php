<?php
    require_once '../general_functions.php';
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home | ÚAMT FEI STU</title>
    <?php
        loadHead();
    ?>
</head>
<body>
    <?php

        loadNavbarEN();
    ?>

    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Title</h1>
                    <hr>
                        <div>
                            <p>Add english version</p>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        loadJScripts();
    ?>
</body>
</html>