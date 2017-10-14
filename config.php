<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = "localhost";
$username = "tp1718a";
$password = "Uamt2017";
$dbname = "tp1718a";

define("HOSTNAME", "localhost");
define("USERNAME", "tp1718a");
define("PASSWORD", "Uamt2017");
define("DBNAME", "tp1718a");

$dbconfig = array(
    'hostname' => 'localhost',
    'username' => 'tp1718a',
    'password' => 'Uamt2017',
    'dbname' => 'tp1718a',
); 

function new_connection() {
	$hostname = "localhost";
	$username = "tp1718a";
	$password = "Uamt2017";
	$dbname = "tp1718a";
	$conn = new mysqli($hostname, $username, $password, $dbname);

	if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn, "utf8");

	return $conn;
}

?>