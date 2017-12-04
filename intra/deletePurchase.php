<?php
require_once '../general_functions.php';

if(isset($_POST['id'])){
    $id  = htmlspecialchars($_POST['id']);
    updateSql("DELETE FROM nakupy WHERE id=$id");
}


