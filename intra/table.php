<?php
require_once 'functions.php';

$m = date('m');
$y = date('Y');

if(isset($_POST['month']) && isset($_POST['year'])){
    $m  = htmlspecialchars($_POST['month']);
    $y  = htmlspecialchars($_POST['year']);
}

generateTable($m,$y);
