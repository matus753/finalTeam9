<?php
require_once '../general_functions.php';
require_once 'functions.php';
session_start();

if(!isset($_SESSION['role'])){
    if(!isAdmin()) {
        header("HTTP/1.1 401 Unauthorized");
        generate401Html();
        exit;
    }
}

$id = 0;
$role= -1;

if(isset($_POST['id']) && isset($_POST['role'])){
    $id  = htmlspecialchars($_POST['id']);
    $role  = htmlspecialchars($_POST['role']);
}

$conn = new_connection();

$sql = "SELECT * FROM staff WHERE id=$id";
$result = $conn->query($sql);
if ($result->num_rows == 1){
    while($row = $result->fetch_assoc()) {
        $new = $row["role"];
        if($new[$role] == '1'){
            $new[$role] = '0';
        } else {
            $new[$role] = '1';
        }
        updateSql("UPDATE staff SET role ='$new' WHERE id =$id");
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    generate401Html();
    exit;
}