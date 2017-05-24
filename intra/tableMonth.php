<?php
require_once __DIR__ . '/functions.php';

$month = date('m');
$year = date('Y');

if(isset($_POST['month']) && isset($_POST['year']) && isset($_POST['id'])){
    $month  = htmlspecialchars($_POST['month']);
    $year  = htmlspecialchars($_POST['year']);
    $id = htmlspecialchars($_POST['id']);
}

echo build_month($month, $year, $id);