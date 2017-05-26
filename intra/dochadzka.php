<?php
include '../general_functions.php';
require_once 'functions.php';
require_once 'generalIntra.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['role'])){
    header("HTTP/1.1 401 Unauthorized");
    generate401Html();
    exit;
}

$conn = new_connection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kalendár neprítomnosti | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">
    <link rel="stylesheet" href="../css/intra_general.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
        <h2>Kalendár neprítomnosti</h2>
        <form action="dochadzka.php" method="post">
            <div class="col-xs-2">
                <label for="slc_m">Mesiac: </label>
                <select name="pdf" id="pdf" class="form-control">
                    <option>Všetci</option>
                    <option>Učitelia</option>
                    <option>Doktorandi</option>
                </select>
            </div>
            <div class="col-xs-1">
                <br>
                <button type="button" class="btn btn-primary" style="margin-top: 5px" onclick="generatePdf(document.getElementById('slc_m').value, document.getElementById('slc_y').value, document.getElementById('pdf').selectedIndex)">PDF</button>
            </div>
            <div class="col-xs-2">
                <label for="slc_m">Mesiac: </label>
                <select name="month" id="slc_m" class="form-control" onchange="generateTable(this.value, document.getElementById('slc_y').value);">
                    <option value="01">Január</option>
                    <option value="02">Feubrár</option>
                    <option value="03">Marec</option>
                    <option value="04">Apríl</option>
                    <option value="05">Máj</option>
                    <option value="06">Jún</option>
                    <option value="07">Júl</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">Október</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="col-xs-2">
                <label for="slc_y">Rok: </label>
                <select name="year" id="slc_y" class="form-control" onchange="generateTable(document.getElementById('slc_m').value, this.value);">
                    <?php
                    $rok = date("Y");
                    echo "<option>". ($rok - 2) ."</option>";
                    echo "<option>". ($rok - 1) ."</option>";
                    echo "<option selected>". $rok ."</option>";
                    echo "<option>". ($rok + 1) ."</option>";
                    ?>
                </select>
            </div>
            <div class="col-xs-1" <?php if(!(isAdmin() || isHr())) echo 'style="display:none"'?>>
                <label for="editing">Editovať: </label><br>
                <input id="editing" type="checkbox" data-toggle="toggle" onchange="changeEdit()">
            </div>
            <div id="editingForm" style="display: none">
                <div class="col-xs-3" id="choice" >
                    <label for="type_nep">Typ nepritomnosti: </label>
                    <select name="type_nep" id="type_nep" class="form-control" onchange="changeType(this[this.selectedIndex].value)">
                        <option value='{"farba":"white","skratka":"x"}' selected>zrušiť</option>
                        <?php
                        $sql = "SELECT * from typ_nepritomnosti";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
                            echo '<option value=\'{"farba":"'.$row["farba"].'","skratka":"'.$row["skratka"].'"}\'>' . $row["nazov"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1">
                    <br>
                    <button type="button" class="btn btn-primary" style="margin-top: 5px" onclick="save()">Uložiť</button>
                </div>
            </div>
            <div class="col-xs-3" id="uspech" style="display: none">
                <br>Dáta úspešne uložené!
            </div>
        </form>
        </div>
        <div class="mycontainer" id="calendar">
            <?php
            $month = date('m');
            $year = date('Y');

            if(isset($_POST['month']) && isset($_POST['year'])){
                $month  = htmlspecialchars($_POST['month']);
                $year  = htmlspecialchars($_POST['year']);
            }

            echo generateTable($month, $year,false,0);
            ?>
        </div>
        <div class="container legenda" id="legend" style="margin-bottom: 150px">
            <?php
            $sql = "SELECT * from typ_nepritomnosti";
            $result = $conn->query($sql);

            echo '<h3>Legenda</h3><ul class="labels">';
            while($row = $result->fetch_assoc()) {
                echo '<li><span style="background:'.$row["farba"].';">'.$row["skratka"].'</span>'. $row["nazov"] .'</li>';
            }
            echo '</ul>';
            ?>
        </div>
        <div id="viewer" onclick="cancelOut(event,this)">
            <div id="show" class="myshow">
                <div id="cal_month">

                </div>
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
<script src="../js/bootstrap-toggle.min.js"></script>
<script>
    window.onload = init;
</script>
</body>
</html>

