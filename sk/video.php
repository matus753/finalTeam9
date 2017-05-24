<?php
require_once '../general_functions.php';

$DBconn = new_connection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Videá | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link href="../css/gallery.css" rel="stylesheet">
</head>
<body>
<?php
loadNavbarSK();
?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Videá</h1>
                <hr>
                <div>
                    <?php
                    $sql = "SELECT * FROM video_gallery ORDER  BY type ASC";
                    $result = $DBconn->query($sql);
                    $pom = $result->fetch_all();
                    $folderPom = 'init';
                    for($i = 0; $i < sizeof($pom); $i++) {
                        $titleSK = $pom[$i][1];
                        $url = $pom[$i][3];
                        $url = str_replace('watch?v=', 'embed/', $url);
                        $folder = $pom[$i][4];

                        if ($folder != $folderPom) {
                            echo '<div class="flip cursor"><h4>'.$folder.'</h4></div>';
                            echo '<div class="panel">';
                            $folderPom = $folder;
                        }
                        echo '<p>'.$titleSK.'</p>';
                        echo '<iframe width="640" height="480" src="'.$url.'"></iframe>';
                        if ($i == sizeof($pom)-1) {
                            echo '</div>';

                        }
                        else if ($pom[$i+1][4] != $folderPom) {
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
loadFooter();
loadJScripts();
?>
<script src="../js/galleries/gallery_slider.js"></script>
</body>
</html>