<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedagogika | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">

</head>
<body>
<?php
loadNavbarSK(true);

$wasurl = false;

if(isset($_POST['submit']) && isset($_POST['url']) && isset($_POST['dir'])){
    echo 'here we are';
    $url = htmlspecialchars($_POST['url']);
    $dir = htmlspecialchars($_POST['dir']);
    saveUrl("pedagogika", $dir, $url);
    $wasurl = true;
}

if(isset($_POST['submit']) && isset($_POST['dir']) && !$wasurl){
    $dir = htmlspecialchars($_POST['dir']);
    $target_dir = "../intranet/pedagogika/$dir/";
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
        <div class="benefits">
            <h1>Pedagogika</h1>
            <div id="accordion">
                <ul class="panel benefitList list-group">
                    <?php generatePageByDirectory("pedagogika");?>
                </ul>
            </div>
        </div>
        <div style="margin-top: 20px">
            <form>
                <div class="col-xs-4"></div>
                <div class="col-xs-2">
                    <input type="text" class="form-control" name="ctgName" id="ctgName" placeholder="Názov kategórie">
                </div>
                <div class="col-xs-2">
                    <input type="button" value="Vytvoriť novú kategóriu" id="newCategory" onclick="novaKategoria('pedagogika',document.getElementById('ctgName').value)" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/intranet.js"></script>
<?php
loadJScripts();
?>
</body>
<?php
loadFooter();
?>
</html>
