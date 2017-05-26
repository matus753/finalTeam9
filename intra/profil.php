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
    <title>Profil | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">
    <link rel="stylesheet" href="../css/style_staff.css">
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
        <div class="benefits">
            <h1>Profil</h1>
            <hr>
           <?php 
           $user = $_SESSION['user']; 
           
            $conn = new mysqli($hostname, $username, $password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 
            
            //$user = "zakova";
            mysqli_set_charset($conn, "utf8");
            $sql = "SELECT * FROM staff WHERE ldapLogin = '$user'";
            $result = $conn->query($sql);
            
             while($row = $result->fetch_assoc()){
                echo "<div class='modal-staff'>";
                if (!empty($row['photo']))
                    echo  '<img src="../images/staffPhoto/'. $row['photo'] .'" alt="Fotografia zamestnanca" class="SS-staff-img">';
                 echo  "<p class='modal-staff-name grey bold'> " . $row['surname'] . " " . $row['name'];
                    if (!empty($row['title1']))
                        echo ", " . $row['title1'];
                    if (!empty($row['title2']))
                        echo ", " . $row['title2'];
                echo "</p>";
                echo "<p class='modal-staff-role light-grey'>" . $row['staffRole'] . "</p>";
                echo "<div class='row'> <div class='col-md-3'></div>";
                echo "<div class='col-xs-6 col-md-3'><p class='modal-staff-tab-title light-grey'>Oddelenie</p> <p class='modal-staff-tab-content grey bold'>" . $row['department'] . "</p></div>";
                echo "<div class='col-xs-6 col-md-3'><p class='modal-staff-tab-title light-grey'>Miestnosť</p> <p class='modal-staff-tab-content grey bold'>" . $row['room'] . "</p></div>";
                echo "<div class='col-md-3'></div></div>";
                    if (empty($row['phone']))
                        $row['phone'] = "xxx";
                echo "<div class='modal-staff-phone'><p class='modal-staff-tab-title modal-staff-phone-title light-grey'>Telefón </p> <p class='modal-staff-phone-num' href='tel:+421260291" . $row['phone'] . "'>+421 2 60291 " . $row['phone'] . "</p></div>"; 
             }
        ?>

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
