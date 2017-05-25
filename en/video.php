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
    <title>Video | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link href="../css/gallery.css" rel="stylesheet">
    <link href="../css/bu_styles.css" rel="stylesheet">
</head>
<body>
<?php
loadLanguageNavbar();

if(isset($_POST["sender"])) {
    $titleSKPost = $_POST["title-SK"];
    $titleENPost = $_POST["title-EN"];
    $urlPost = $_POST["url-address"];
    $typePost = $_POST["selected-option"];

    $query = "INSERT INTO video_gallery (title_SK, title_EN, url, type) VALUES ('$titleSKPost', '$titleENPost', '$urlPost', '$typePost')";
    $DBconn->query($query);
}
?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">Video</h1>
                <?php
                echo "<button type='button' class='btn addButton' data-toggle='modal' data-target='#myModal'>Vkladanie</button>";
                ?>
                <hr>
                <div>
                    <?php
                    $sql = "SELECT * FROM video_gallery ORDER  BY type ASC";
                    $result = $DBconn->query($sql);
                    $pom = $result->fetch_all();
                    $folderPom = 'init';
                    for($i = 0; $i < sizeof($pom); $i++) {
                        $titleEN = $pom[$i][2];
                        $url = $pom[$i][3];
                        $url = str_replace('watch?v=', 'embed/', $url);
                        $folder = $pom[$i][4];

                        if ($folder != $folderPom) {
                            echo '<div class="flip cursor"><h4>'.$folder.'</h4></div>';
                            echo '<div class="panel">';
                            $folderPom = $folder;
                        }
                        echo '<p>'.$titleEN.'</p>';
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vloženie nového videa</h4>
            </div>
            <form action="video.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div>
                        Zvoľ typ videa:
                        <select class="form-control" name="selected-option">
                            <option>Naše laboratóriá</option>
                            <option>Naše zariadenie</option>
                            <option>Predmety</option>
                            <option>Propagačné videá</option>
                        </select><br>
                        <input class="form-control" type="text" placeholder="Slovenský nadpis videa" style="padding-bottom: 7px;" name="title-SK"><br>
                        <input class="form-control" type="text" placeholder="Anglický nadpis videa" style="padding-bottom: 7px;" name="title-EN"><br>
                        <input class="form-control" type="text" placeholder="URL adresa videa vo formáte https://www.youtube.com/watch?v=57BJvTZK6Vc" style="padding-bottom: 7px;" name="url-address">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="sender" class="btn btn-default" value="Odoslať">
                </div>
            </form>
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