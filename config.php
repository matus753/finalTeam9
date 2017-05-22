<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = "localhost";
$username = "tim9";
$password = "tim9";
$dbname = "final";

define("HOSTNAME", "localhost");
define("USERNAME", "tim9");
define("PASSWORD", "tim9");
define("DBNAME", "final");

$dbconfig = array(
    'hostname' => 'localhost',
    'username' => 'tim9',
    'password' => 'tim9',
    'dbname' => 'final',
);

function new_connection() {
    $hostname = "localhost";
    $username = "tim9";
    $password = "tim9";
    $dbname = "final";

    $conn = new mysqli($hostname, $username, $password, $dbname);
    //print_r($conn);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn, "utf8");

    return $conn;
}

?>