<?php
require_once '../general_functions.php';
require_once 'generalIntra.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['role'])){
    header("HTTP/1.1 401 Unauthorized");
    generate401Html();
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Doktorandi | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">
    <link rel="stylesheet" href="../css/intra_general.css">

</head>
<body>
<?php
loadLanguageNavbar(true);

$wasurl = false;

if(isset($_POST['submit']) && isset($_POST['url']) && isset($_POST['dir'])){
    echo 'here we are';
    $url = htmlspecialchars($_POST['url']);
    $dir = htmlspecialchars($_POST['dir']);
    saveUrl("doktorandi", $dir, $url);
    $wasurl = true;
}

if(isset($_POST['submit']) && isset($_POST['dir']) && !$wasurl){
    $dir = htmlspecialchars($_POST['dir']);
    $target_dir = "../intranet/doktorandi/$dir/";
    $target_file = $target_dir . basename($_FILES["myfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $r = 1;
    while(file_exists($target_file)) {
        $nm = basename($_FILES["myfile"]["name"]);
        $pieces = explode(".", $nm);
        $target_file = $target_dir . $pieces[0] . '(' .$r++ . ').' . $pieces[1];
    }

    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>

<!-- Page Content -->
<div id="emPAGEcontent">
    <div class="container">
        <?php
        loadNavbarIntra();
        ?>
        <div class="well well-sm">
            <div class="benefits">
                <h2>Doktorandi</h2>
                <div id="accordion">
                    <ul class="panel benefitList list-group">
                        <?php generatePageByDirectory("doktorandi"); ?>
                    </ul>
                </div>
            </div>
            <div style="margin-top: 20px" class="container-fluid">
                <form>
                    <div class="col-xs-4"></div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="ctgName" id="ctgName" placeholder="Názov kategórie">
                    </div>
                    <div class="col-xs-2">
                        <input type="button" value="Vytvoriť novú kategóriu" id="newCategory" onclick="novaKategoria('doktorandi',document.getElementById('ctgName').value)" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/intranet.js"></script>
<?php
loadLanguageFooter();
loadJScripts();
?>
<script src="../js/scripty_intra.js"></script>
</body>
</html>
