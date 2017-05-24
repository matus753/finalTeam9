<?php
    require_once '../general_functions.php';

createContent();

function createContent(){
    if(isset($_POST['type'])){
        $type_local = $_POST['type'];
    } else {
        $type_local = 3;
    }

    $type_array = ["Propagácia", "Oznamy", "Zo života ústavu"];
    $conn = new_connection();
    $output = "";
//    0 - Propagacia, 1 - Oznamy, 2 - Zo zivota fakulty, 3 - vsetky


    if($type_local == 3){
        $sql = "SELECT * FROM news order by date_created desc";
    } else {
        $sql = "SELECT * FROM news where type = ".$type_local." order by date_created desc";
    }

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $date_expiration = $row['date_expiraton'];
            $date = date("Y-m-d");
            if($date > $date_expiration){
                $expired = " ib-expired' style='display: none;'";
            } else {
                $expired = "'";
            }
            $type_db = $row['type'];
            $output .= "<div class='well".$expired.">";
            $output .= "<h1>".$row['title_sk']."</h1>";
            $output .= "<p>".$row['content_sk']."</p>";
            $output .= "<div class=''>";
            $output .= "<span class='badge'>Pridané ".$row['date_created']."</span> ";
            if($date > $date_expiration){
                $output .= " <span class='badge'>Expirované ".$date_expiration."</span>";
            }
            $output .= "<div class='pull-right'>";
            switch($type_db){
                case 0:
                    $output .= "<span class='label label-primary'>".$type_array[$type_db]."</span>";
                    break;
                case 1:
                    $output .= "<span class='label label-success'>".$type_array[$type_db]."</span>";
                    break;
                case 2:
                    $output .= "<span class='label label-warning'>".$type_array[$type_db]."</span>";
                    break;
            }
            $output .= "</div>";
            $output .= "</div>";
            $output .= "<hr>";
            $output .= "</div>";

        }
    }
    echo $output;
//    echo str_split($output, strlen($output) - 10)[0]."</div>";

}