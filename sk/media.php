<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'sk';

$DBconn = new_connection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Médiá | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link href="../css/bu_styles.css" rel="stylesheet">
</head>
<body>
<?php
loadLanguageNavbar();
?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">Médiá</h1>
                <hr>
                <div class="contentHeaders">
                    <?php
                    $sql = "SELECT * FROM media ORDER  BY date DESC";
                    $result = $DBconn->query($sql);
                    $pom = $result->fetch_all();
                    for($i = 0; $i < sizeof($pom); $i++) {
                        $date = $pom[$i][1];
                        $titleSK = $pom[$i][2];
                        $mediaName = $pom[$i][3];
                        $type = $pom[$i][4];
                        if ($type == 'link') {
                            $url = $pom[$i][5];
                            echo '<div class="flip cursor"><h4>'.$titleSK.' ('.$date.')</h4></div>';
                            echo '<div class="panel">';
                            echo '<p>Názov média: '.$mediaName.'</p>';
                            echo '<p><a target="_blank" href="'.$url.'">Klikni pre pokračovanie</a></p>';
                            echo '</div>';
                        }
                        elseif ($type == 'server') {
                            $fileName = $pom[$i][6];
                            echo '<div class="flip cursor"><h4>'.$titleSK.' ('.$date.')</h4></div>';
                            echo '<div class="panel">';
                            echo '<p>Názov média: '.$mediaName.'</p>';
                            echo '<p><a target="_blank" href="../docs/'.$fileName.'">Klikni pre pokračovanie k PDF</a></p>';
                            echo '</div>';
                        }
                        else {
                            $url = $pom[$i][5];
                            $fileName = $pom[$i][6];
                            echo '<div class="flip cursor"><h4>'.$titleSK.' ('.$date.')</h4></div>';
                            echo '<div class="panel">';
                            echo '<p>Názov média: '.$mediaName.'</p>';
                            echo '<p><a target="_blank" href="'.$url.'">Klikni pre pokračovanie</a></p>';
                            echo '<p><a target="_blank" href="../docs/'.$fileName.'">Klikni pre pokračovanie k PDF</a></p>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
loadLanguageFooter();
loadJScripts();
?>
<script src="../js/galleries/gallery_slider.js"></script>
</body>
</html>