<?php
	ini_set('display_errors', 1);
	ini_set('dispaly_startup_errors', 1);
	error_reporting(E_ALL);
	require_once('config.php'); 

	if(isset($_GET['id'])){
	    $id  = $_GET['id'];
	}
	else
		echo "niekde sa stala chyba";

	$conn = new mysqli($hostname, $username, $password, $dbname);
          // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 

        mysqli_set_charset($conn, "utf8");
        $sql = "SELECT * FROM staff WHERE id = '$id'";
        $result = $conn->query($sql);
        
       
        echo "<table class='table table-striped table-hover'>";
        echo "<thead><tr><th>Názov mesta</th><th>Počet návštevníkov</th></tr></thead>";
        echo "<tbody>";
        $vys = "";
        while($row = $result->fetch_assoc()){
            if (!empty($row['photo']))
                $vys .=  '<img src="images/staffPhoto/'. $row['photo'] .'" alt="Smiley face" width="100%">';
             $vys .=  "<p><span class='bold'>Meno:</span> " . $row['surname'] . " " . $row['name'];
                if (!empty($row['title1']))
                    $vys .= ", " . $row['title1'];
                if (!empty($row['title2']))
                    $vys .= ", " . $row['title2'];
            $vys .= "</p>";
            $vys .= "<p><span class='bold'>Zaradenie:</span> " . $row['staffRole'] . "</p>";
            $vys .= "<p><span class='bold'>Oddelenie:</span> " . $row['department'] . "</p>";
            $vys .= "<p><span class='bold'>Telefón: <i class='fa fa-phone'></i></span> +421 2 60291 " . $row['phone'] . "</p>";
            $vys .= "<p><span class='bold'>Miestnosť:</span> " . $row['room'] . "</p>";
        }
        $vys = "<h3 class='center red'></h3>"  . $vys . "</tbody></table>";
        echo $vys;