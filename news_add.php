<?php
require_once 'general_functions.php';

$date_exp = "";
$type = "";
$title_sk = "";
$content_sk = "";
$title_en = "";
$content_en = "";


if(isset($_POST['date']) && !empty($_POST['date'])){
    $date_exp = $_POST['date'];
}
if(isset($_POST['type']) && !empty($_POST['type'])){
    $type = $_POST['type'];
}
if(isset($_POST['title_sk']) && !empty($_POST['title_sk'])){
    $title_sk = $_POST['title_sk'];
}
if(isset($_POST['content_sk']) && !empty($_POST['content_sk'])){
    $content_sk = $_POST['content_sk'];
}
if(isset($_POST['title_en']) && !empty($_POST['title_en'])){
    $title_en = $_POST['title_en'];
}
if(isset($_POST['content_en']) && !empty($_POST['content_en'])){
    $content_en = $_POST['content_en'];
}

$date_cur = date("Y-m-d");

if(isset($date_exp) && isset($type)){
    $conn = new_connection();
    $sql = "INSERT INTO news VALUES (null,'".$title_en."','".$title_sk."','".$content_en."','".$content_sk."','".$date_cur."','".$date_exp."',1)";
    $result = $conn->query($sql);
    sendNews($title_sk, $content_sk, $title_en, $content_en);
}


function sendNews($_title_sk, $_content_sk, $_title_en, $_content_en){
    $sql = "select * from newsletter";
    $header = "From: ÚAM FEI \r\n";
    $conn = new_connection();

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $email = $row['email'];
            $lang_db = $row['lang'];

            if($lang_db == "SK"){
                if(!empty($_title_sk) && !empty($_content_sk)){
                    mail($email, $_title_sk, $_content_sk, $header);
                }
            }
            if($lang_db == "EN"){
                if(!empty($_title_en) && !empty($_content_en)){
                    mail($email, $_title_en, $_content_en, $header);
                }
            }
        }
    }
}


