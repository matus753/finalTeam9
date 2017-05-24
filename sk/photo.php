<?php
require_once '../general_functions.php';

$DBconn = new_connection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fotogaléria | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link href="../css/lightbox.css" rel="stylesheet">
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
                <h1>Fotogaléria</h1>
                <hr>
                <div>
                    <?php
                    $sql = "SELECT * FROM photo_gallery ORDER BY folder ASC";
                    $result = $DBconn->query($sql);
                    $pom = $result->fetch_all();
                    $folderPom = 'init';
                    for($i = 0; $i < sizeof($pom); $i++) {
                        $date = $pom[$i][1];
                        $titleSK = $pom[$i][2];
                        $folder = $pom[$i][4];
                        $image = $pom[$i][5];

                        if ($folder != $folderPom) {
                            echo '<div class="flip cursor"><h4>'.$titleSK.' ('.$date.')</h4>';
                            echo '</div>';
                            echo '<div class="panel">';
                            $folderPom = $folder;
                        }
                        echo '<a class="image-link" href="../images/photoGallery/Normal/'.$folder.'/'.$image.'" data-lightbox="'.$folder.'" data-title="'.$titleSK.'"><img class="small image" src="../images/photoGallery/Normal/'.$folder.'/'.$image.'" alt=""/></a>';
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
<script src="../js/galleries/lightbox.js"></script>
<script src="../js/galleries/gallery_slider.js"></script>
</body>
</html>