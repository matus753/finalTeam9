<?php
require_once '../general_functions.php';
require_once 'functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['role'])){
    if(!isAdmin()) {
        header("HTTP/1.1 401 Unauthorized");
        generate401Html();
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Spravovanie rolí | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">
    <link rel="stylesheet" href="../css/style_staff.css">

</head>
<body>

<?php
loadLanguageNavbar(true);

echo '<div id="emPAGEcontent">
    <div class="container"><div class="well well-sm text-center"><h1>Spravovanie rolí</h1>';
$conn = new_connection();
$sql = "SELECT * FROM staff WHERE ldapLogin != 'NULL' ORDER BY surname";
$result = $conn->query($sql);

echo '<table class="table table-striped table-hover table-bordered" id="SS-table-staff">
                    <tr style="background-color: #3CDAB2; color: white;">
                      <th class="staff-th center staff-table-th1"><i class="fa fa-sort"></i> Meno</th>
                      <th class="center staff-table-th2">User</th>
                      <th class="center staff-table-th3">Hr</th>
                      <th class="center staff-table-th4"> Reporter</th>
                      <th class="center staff-table-th5"> Editor</th>
                      <th class="center staff-table-th5">Admin</th>
                    </tr>
                  <tbody>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if( strpos($row['name'], "Admin" ) === false ) {
            $role = $row["role"];
            echo '<tr class="m">';
            //name
            echo "<td>";
            echo $row['surname'] . " " . $row['name'];
            if (!empty($row['title1']))
                echo ", " . $row['title1'];
            if (!empty($row['title2']))
                echo ", " . $row['title2'];
            echo "</td>";
            //User
            echo "<td>";
            if($role[0] == '1')
                echo getCheckBox($row['id'],0,'btn-success active');
            else
                echo getCheckBox($row['id'],0,'btn-success');
            echo "</td>";
            //Hr
            echo "<td>";
            if($role[1] == '1')
                echo getCheckBox($row['id'],1,'btn-primary active');
            else
                echo getCheckBox($row['id'],1,'btn-primary');
            echo "</td>";
            //Reporter
            echo "<td>";
            if($role[2] == '1')
                echo getCheckBox($row['id'],2,'btn-info active');
            else
                echo getCheckBox($row['id'],2,'btn-info');
            echo "</td>";
            //Editor
            echo "<td>";
            if($role[3] == '1')
                echo getCheckBox($row['id'],3,'btn-warning active');
            else
                echo getCheckBox($row['id'],3,'btn-warning');
            echo "</td>";
            //Admin
            echo "<td>";
            if($role[4] == '1')
                echo getCheckBox($row['id'],4,'btn-danger active');
            else
                echo getCheckBox($row['id'],4,'btn-danger');
            echo "</td>";
            echo "</tr>";
        }
    }
}

echo '</tbody>
  	  </table></div></div></div>';
?>
<script src="../js/intranet.js"></script>
<?php
loadLanguageFooter();
loadJScripts();
?>
    </body>
</html>