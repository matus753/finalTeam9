<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Nákupy | ÚAMT FEI STU</title>
        <?php
        loadHead();
        ?>
        <link rel="stylesheet" href="../css/intranet.css">
    </head>
    <body>
<?php
loadNavbarSK(true);
?>

<!-- Page Content -->
<div id="emPAGEcontent">
    <div class="container">
        <?php
        $conn = new_connection();
        $sql = "SELECT * FROM nakupy";
        $result = $conn->query($sql);

        echo '<div class="benefits"><h1>Nákupy</h1> <div id="accordion"><ul class="panel benefitList list-group">';

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<a data-toggle="collapse" href="#'.$row["id"].'" class="list-group-item" data-parent="#accordion" contenteditable="true" data-old_value="' . $row["purchase"] . '" onBlur="saveInlineEdit(this,' ."'purchase','" . $row["id"] . "')\"" .  '>' . $row["purchase"] . '</a>';
                echo '<div id="'.$row["id"].'" style="padding: 30px" class="panel-collapse collapse" contenteditable="true" data-old_value="' . $row["message"] . '" onBlur="saveInlineEdit(this,' ."'message','" . $row["id"] . "')\"" .  '>' . $row["message"] . '</div>';
            }
        }

        echo '</ul></div></div>';
        ?>
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
