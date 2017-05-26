<?php

include('../general_functions.php');

$name = "";
$page = "";

if(isset($_POST['name'])){
    $name  = htmlspecialchars($_POST['name']);

    if(isset($_POST['page'])) {
        $page = htmlspecialchars($_POST['page']);

        if (!mkdir("../intranet/$page/$name", 0777, true)) {
            die('Failed to create folders...');
        }
    } else {

        updateSql("INSERT INTO nakupy VALUES(NULL,'$name','')");
    }
}


