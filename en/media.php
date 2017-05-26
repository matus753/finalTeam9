<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'en';

$DBconn = new_connection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Media | ÚAMT FEI STU</title>
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
                <h1 class="hlNadpis">Media</h1>
                <hr>
                <div>
                    <?php
                    $sql = "SELECT * FROM media ORDER  BY date DESC";
                    $result = $DBconn->query($sql);
                    $pom = $result->fetch_all();
                    for($i = 0; $i < sizeof($pom); $i++) {
                        $date = $pom[$i][1];
                        $titleEN = $pom[$i][7];
                        $mediaName = $pom[$i][3];
                        $type = $pom[$i][4];
                        if ($type == 'link') {
                            $url = $pom[$i][5];
                            echo '<div class="flip cursor"><h4>'.$titleEN.' ('.$date.')</h4></div>';
                            echo '<div class="panel">';
                            echo '<p>Media name: '.$mediaName.'</p>';
                            echo '<p><a target="_blank" href="'.$url.'">Click to continue</a></p>';
                            echo '</div>';
                        }
                        elseif ($type == 'server') {
                            $fileName = $pom[$i][6];
                            echo '<div class="flip cursor"><h4>'.$titleEN.' ('.$date.')</h4></div>';
                            echo '<div class="panel">';
                            echo '<p>Media name: '.$mediaName.'</p>';
                            echo '<p><a target="_blank" href="../docs/'.$fileName.'">Click to continue to PDF</a></p>';
                            echo '</div>';
                        }
                        else {
                            $url = $pom[$i][5];
                            $fileName = $pom[$i][6];
                            echo '<div class="flip cursor"><h4>'.$titleEN.' ('.$date.')</h4></div>';
                            echo '<div class="panel">';
                            echo '<p>Media name: '.$mediaName.'</p>';
                            echo '<p><a target="_blank" href="'.$url.'">Click to continue</a></p>';
                            echo '<p><a target="_blank" href="../docs/'.$fileName.'">Click to continue to PDF</a></p>';
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