<?php
	include('config.php');

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
        

	function zobraz_zoznam_pracovnikov() {
            $conn = new_connection();	    
            $sql = "SELECT * FROM staff ORDER BY surname";
            $result = $conn->query($sql);  
            
            echo '<table class="table table-striped table-hover table-bordered">
  	    <thead>
  	      <tr>
  	        <th>Meno</th>
  	        <th>Miestnosť</th>
  	        <th>Klapka</th>
                <th>Oddelenie</th>
                <th>Zaradenie</th>
                <th>Funkcia</th>
  	      </tr>
  	    </thead>
  	    <tbody>';
            
            if ($result->num_rows > 0) {           
                while($row = $result->fetch_assoc()) {
                    echo '<tr class="m" data-toggle="modal" data-id="'.$row['id'].'" data-target="#myModal">';
                        echo "<th>";
                            echo $row['surname'] . " " . $row['name'];
                            if (!empty($row['title1']))
                                echo ", " . $row['title1'];
                            if (!empty($row['title2']))
                                echo ", " . $row['title2'];
                        echo "</th>";
                        echo "<td>";
                            echo $row['room'];
                        echo "</td>";
                        echo "<td>";
                            echo $row['phone'];
                        echo "</td>";
                        echo "<td>";
                            echo $row['department'];
                        echo "</td>";
                        echo "<td>";
                            echo $row['staffRole'];
                        echo "</td>";
                        echo "<td>";
                            echo $row['function'];
                        echo "</td>";
                    echo "</tr>";                                    
                }
            }
        }
        
        echo '</tbody>
  	  </table>
        
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
                    <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body" id="modalBody">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>';
//
//            echo "<tr>
//                                <td>6:00-14:00</td>
//                                <td>".$time6."</td>
//                        </tr>	
//                        <tr>
//                                <td>14:00-20:00</td>
//                                <td>".$time14."</td>
//                        </tr>	
//                        <tr>
//                                <td>20:00-24:00</td>
//                                <td>".$time20."</td>
//                        </tr>	
//                        <tr>
//                                <td>24:00-6:00</td>
//                                <td>".$time24."</td>
//                        </tr>";	  
      

?>
