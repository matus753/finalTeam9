<?php
        require 'staff_ldap.php';
        require 'staff_functions.php';

	if(isset($_GET['id'])){
	    $id  = $_GET['id'];
	}
	else
		echo "niekde sa stala chyba";

	$conn = new mysqli($hostname, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 

        mysqli_set_charset($conn, "utf8");
        $sql = "SELECT * FROM staff WHERE id = '$id'";
        $result = $conn->query($sql);

        $vys = "";
        while($row = $result->fetch_assoc()){
            $vys .= "<div class='modal-staff'>";
                if (!empty($row['photo']))
                    $vys .=  '<img src="../images/staffPhoto/'. $row['photo'] .'" alt="Fotografia zamestnanca" class="SS-staff-img">';
                 $vys .=  "<p class='modal-staff-name grey bold'> " . $row['surname'] . " " . $row['name'];
                    if (!empty($row['title1']))
                        $vys .= ", " . $row['title1'];
                    if (!empty($row['title2']))
                        $vys .= ", " . $row['title2'];
                $vys .= "</p>";
                $vys .= "<p class='modal-staff-role light-grey'>" . $row['staffRole'] . "</p>";
                $vys .= "<div class='row'> <div class='col-md-3'></div>";
                $vys .= "<div class='col-xs-6 col-md-3'><p class='modal-staff-tab-title light-grey'>Oddelenie</p> <p class='modal-staff-tab-content grey bold'>" . $row['department'] . "</p></div>";
                $vys .= "<div class='col-xs-6 col-md-3'><p class='modal-staff-tab-title light-grey'>Miestnosť</p> <p class='modal-staff-tab-content grey bold'>" . $row['room'] . "</p></div>";
                $vys .= "<div class='col-md-3'></div></div>";
                    if (empty($row['phone']))
                        $row['phone'] = "xxx";
                $vys .= "<div class='modal-staff-phone'><p class='modal-staff-tab-title modal-staff-phone-title light-grey'>Telefón </p> <p class='modal-staff-phone-num' href='tel:+421260291" . $row['phone'] . "'>+421 2 60291 " . $row['phone'] . "</p></div>"; 
                
                if (!empty($row['ldapLogin'])) {
                    $AISid = getLdapId($row['ldapLogin']);
                    $vys .= "<p id='modal-staff-more' class='grey bold' data-id='".$AISid."' style='cursor:pointer'>Zobraziť publikácie <i class='fa fa-caret-down'></i></p>";
                      
                    $vys .= "<div id='modal-staff-more-content'>";
                    $vys .= "</div>";

                }
                    
                
            $vys .= "</div>";
        }
        
        echo $vys;