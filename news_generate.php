<?php
require_once 'general_functions.php';
//$wl = $_SESSION['lang'];
if(isSet($_GET['lang']))
{
    $wl = $_GET['lang'];
    $z = 'get';
}
else if(isSet($_SESSION['lang']))
{
    $wl = $_SESSION['lang'];
    $z = 'sess';

}
else if(isSet($_COOKIE['lang']))
{
    $wl = $_COOKIE['lang'];
    $z = 'cookie';

} else if(isset($_POST['lang'])){
    $wl = $_POST['lang'];
    $z = 'post';

}
else
{
    $wl = 'sk';
    $z = 'nic';

}

createContent($wl);


function createContent($wl){

    if(isset($_POST['type'])){
        $type_local = $_POST['type'];
    } else {
        $type_local = 3;
    }
    if(isset($_POST['expired'])){
        $show_expired = $_POST['expired'];
    } else {
        $show_expired = false;
    }
    if (isset($_POST["page"])) {
        $page  = $_POST["page"];
    } else {
        $page=1;
    };


    $type_array_sk = ["Propagácia", "Oznamy", "Zo života ústavu"];
    $type_array_en = ["Propagation", "Notices", "From the life of the institute"];
    $conn = new_connection();
    $output = "";
    $date = date("Y-m-d");
    $per_page = 5;
    $start_from = ($page-1) * $per_page;

//    0 - Propagacia, 1 - Oznamy, 2 - Zo zivota fakulty, 3 - vsetky

    $type_cond = $type_local == 3 ? "" : " and type = ".$type_local." ";

    $sql_max = "SELECT COUNT(ID) AS total FROM news where content_sk <> '' ".$type_cond.($show_expired == "false" ? " and curdate() <= date_expiration" : "");
    $result = $conn->query($sql_max);
    $row = $result->fetch_assoc();
    $total_records = $row["total"];
    $total_pages = ceil($total_records / $per_page);


    if($type_local == 3){
        $sql = "SELECT * FROM news where content_sk <> '' ".($show_expired == "false" ? "and curdate() <= date_expiration" : "")." order by date_created desc limit ".$start_from.",".$per_page;
    } else {
        $sql = "SELECT * FROM news where content_sk <> '' and type = ".$type_local.($show_expired == "false" ? " and curdate() <= date_expiration" : "")." order by date_created desc limit ".$start_from.",".$per_page;
    }

//    echo $total_pages."---".$sql."---".$sql_max;

    // DVOJJAZYCNOST
    if(isSK($wl)){
        $prid = "Pridané ";
        $exp = "Expirované ";
        $type_array = $type_array_sk;
    } else {
        $prid = "Added ";
        $exp = "Expired ";
        $type_array = $type_array_en;
    }

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
//            $message = $row['content_sk'];
            $message = isSK($wl) ? $row['content_sk'] : $row['content_en'];
            $title = isSK($wl) ? $row['title_sk'] : $row['title_en'];
            $date_expiration = $row['date_expiration'];
            $type_db = $row['type'];

            if(empty($message)){
                continue;
            }
            $output .= "<div class='well ib-expired'>";
            $output .= "<h1>".$title."</h1>";
            $output .= "<p>".$message."</p>";
            $output .= "<div class=''>";
            $output .= "<span class='badge'>".$prid.$row['date_created']."</span> ";
            if($date > $date_expiration){
                $output .= " <span class='badge'>".$exp.$date_expiration."</span>";
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

    $w = $total_pages * 50 + 40;
    $output .= "<div class='row'>";
    $output .= "<div class='ib-news-buttons' style='width: ".$w."px'>";
    for ($i=1; $i<=$total_pages; $i++) {
//        $output .= "<a href='index.php?page=".$i."'>".$i."</a> ";
        $output .= "<button type='button' class='btn btn-default btn-lg ".($page == $i ? "disabled active'" : "'").($page == $i ? "id='ib-active-page-button' value='".$i."'" : "")." onclick='updateType(".$i.");scroll();'>".$i."</button>";
    }
    $output .= "</div>";
    $output .= "</div>";


    echo $output;
//    echo str_split($output, strlen($output) - 10)[0]."</div>";

}

function isSK($wl){
    return $wl == 'sk';
}