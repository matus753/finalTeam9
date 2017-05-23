<?php
require_once '../general_functions.php';

$column = "";
$editval = "";
$id = "";

if(isset($_POST['column']) && isset($_POST['editval']) && isset($_POST['id'])){
    $column  =$_POST['column'];
    $editval = $_POST['editval'];
    $id = $_POST['id'];
}

updateSql("UPDATE nakupy set " . $column . " = '". $editval ."' WHERE  id=". $id);
