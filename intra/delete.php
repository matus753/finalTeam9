<?php
require_once '../general_functions.php';

if(isset($_POST['file'])){
    $file  = htmlspecialchars($_POST['file']);
    unlink($file);
}

if(isset($_POST['urlId'])){
    $id  = htmlspecialchars($_POST['urlId']);
    updateSql("DELETE FROM url WHERE id=$id");
}


