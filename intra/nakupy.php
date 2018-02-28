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
    <title>Nákupy | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">
    <link rel="stylesheet" href="../css/intra_general.css">
</head>
<body>
<?php
loadLanguageNavbar(true);
?>

<!-- Page Content -->
<div id="emPAGEcontent">
    <div class="container">
        <?php
        loadNavbarIntra();
        ?>
        <div class="well well-sm">
            <div class="container-fluid">
                <div class="col-xs-4">
                    <h1>Nákupy</h1>
                </div>
                <div class="col-xs-5" style="display: none;" id="errLength">
                    <h3 style="color: darkred">Text nákupu môže mať maximálne 5000 znakov!</h3>
                </div>
            </div>
            <div class="container-fluid">
                <div id="accordion"><ul class="panel benefitList list-group action-list-group">
                    <?php
                    $conn = new_connection();
                    $sql = "SELECT * FROM nakupy";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<li class="list-group-item"><a data-toggle="collapse" href="#'.$row["id"].'" class="list-group-link" 
                                  data-parent="#accordion" contenteditable="true" data-old_value="' . $row["purchase"] . '" 
                                  onBlur="saveInlineEdit(this,' ."'purchase','" . $row["id"] . "')\"" .  '>' . $row["purchase"] . '</a><span class="pull-right">
                                  <a class="btn btn-sm btn-default" onclick="deletePurchase(' .  $row["id"] .')"><span class="glyphicon glyphicon-remove"></a></span></span></li>';
                            echo '<div id="'.$row["id"].'" style="padding: 30px" class="panel-collapse collapse" contenteditable="true" data-old_value="' . $row["message"] . '" onBlur="saveInlineEdit(this,' ."'message','" . $row["id"] . "')\"" .  '>' . $row["message"] . '</div>';
                        }
                    }

                    echo '</ul></div>
            </div>'; ?>
            <div style="margin-top: 20px" class="container-fluid">
                <form>
                    <div class="col-xs-4"></div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="ctgName" id="ctgName" placeholder="Vytvoriť">
                    </div>
                    <div class="col-xs-2">
                        <input type="button" value="Nový nákup" id="newCategory" onclick="novyNakup(document.getElementById('ctgName').value)" class="btn btn-primary">
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
</body>
</html>
