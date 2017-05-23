<?php

include('../general_functions.php');

$name = "";
$page = "";

if(isset($_POST['name']) && isset($_POST['page'])){
    $name  = htmlspecialchars($_POST['name']);
    $page = htmlspecialchars($_POST['page']);
}

if (!mkdir("../intranet/$page/$name", 0777, true)) {
    die('Failed to create folders...');
}