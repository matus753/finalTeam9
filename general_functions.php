<?php

        include('config.php');

	function new_connection() {
            $hostname = "localhost";
            $username = "tim9";
            $password = "tim9";
            $dbname = "final";

            $conn = new mysqli($hostname, $username, $password, $dbname);

            if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
            } 
            mysqli_set_charset($conn, "utf8");

            return $conn;
	}