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
    <title>Photo | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link href="../css/lightbox.css" rel="stylesheet">
    <link href="../css/bu_styles.css" rel="stylesheet">
</head>
<body>
<?php
loadLanguageNavbar();

if(isset($_POST["sender"])) {
    $curr_date = date("Y-m-d");
    $titleSKPost = $_POST["title-SK"];
    $titleENPost = $_POST["title-EN"];
    $folderPost = $_POST["folder"];
    $imagePost = basename($_FILES["fileToUpload"]["name"]);
    if (!file_exists("../images/photoGallery/Normal/".$folderPost)) {
        mkdir("../images/photoGallery/Normal/".$folderPost, 0777, true);
        chmod("../images/photoGallery/Normal/".$folderPost, 0777);
    }

    $target_dir = "../images/photoGallery/Normal/".$folderPost."/";
    $target_file = $target_dir.$imagePost;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $query = "INSERT INTO photo_gallery (date, title_SK, title_EN, folder, photo) VALUES ('$curr_date', '$titleSKPost', '$titleENPost', '$folderPost', '$imagePost')";
    $DBconn->query($query);
}
?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">Photo</h1>
                <?php
                if(isReporter() || isAdmin()) {echo "<button type='button' class='btn addButton' data-toggle='modal' data-target='#myModal'>Vkladanie</button>";}
                ?>
                <hr>
                <div>
                    <?php
                    $sql = "SELECT * FROM photo_gallery ORDER BY date DESC";
                    $result = $DBconn->query($sql);
                    $pom = $result->fetch_all();
                    $folderPom = 'init';
                    for($i = 0; $i < sizeof($pom); $i++) {
                        $date = $pom[$i][1];
                        $titleEN = $pom[$i][3];
                        $folder = $pom[$i][4];
                        $image = $pom[$i][5];

                        if ($folder != $folderPom) {
                            echo '<div class="flip cursor"><h4>'.$titleEN.' ('.$date.')</h4>';
                            echo '</div>';
                            echo '<div class="panel">';
                            $folderPom = $folder;
                        }
                        echo '<a class="image-link" href="../images/photoGallery/Normal/'.$folder.'/'.$image.'" data-lightbox="'.$folder.'" data-title="'.$titleEN.'"><img class="smallImg image" src="../images/photoGallery/Normal/'.$folder.'/'.$image.'" alt=""/></a>';
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
                <h4 class="modal-title">Vloženie nového obrázka</h4>
            </div>
            <form action="photo.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div>
                        <input class="form-control" type="text" placeholder="Slovenský nadpis albumu" style="padding-bottom: 7px;" name="title-SK"><br>
                        <input class="form-control" type="text" placeholder="Anglický nadpis albumu" style="padding-bottom: 7px;" name="title-EN"><br>
                        <input class="form-control" type="text" placeholder="Názov adresára na serveri" style="padding-bottom: 7px;" name="folder">
                    </div>
                    <hr>
                    <div>
                        <input type="file" name="fileToUpload" id="fileToUpload">
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
<script src="../js/galleries/lightbox.js"></script>
<script src="../js/galleries/gallery_slider.js"></script>
</body>
</html>