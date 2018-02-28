<?php
include('general_functions.php');

$login = "";
$psw = "";

if(isset($_POST['login']) && isset($_POST['password'])){
    $login  = htmlspecialchars($_POST['login']);
    $psw = htmlspecialchars($_POST['password']);
}

if(loginLDAP($login,$psw)) {
    echo "true";
}
else
    echo "false";