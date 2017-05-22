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
            
            echo '<table class="table table-striped table-hover table-bordered" id="SS-table-staff">
                    <tr>
                      <th onclick="sortTable(0)" style="cursor:pointer" class="staff-th"><i class="fa fa-sort"></i> Meno</th>
                      <th>Miestnosť</th>
                      <th>Klapka</th>
                      <th onclick="sortTable(3)" style="cursor:pointer" class="staff-th"><i class="fa fa-sort"></i> Oddelenie</th>
                      <th onclick="sortTable(4)" style="cursor:pointer" class="staff-th"><i class="fa fa-sort"></i> Zaradenie</th>
                      <th>Funkcia</th>
                    </tr>
                  <tbody>';

                  if ($result->num_rows > 0) {           
                      while($row = $result->fetch_assoc()) {
                          echo '<tr class="m" data-toggle="modal" data-id="'.$row['id'].'" data-target="#myModal">';
                              echo "<td>";
                                  echo $row['surname'] . " " . $row['name'];
                                  if (!empty($row['title1']))
                                      echo ", " . $row['title1'];
                                  if (!empty($row['title2']))
                                      echo ", " . $row['title2'];
                              echo "</td>";
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
            
             echo '</tbody>
  	  </table>
        
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   </div>
                  <div class="modal-body" id="modalBody">

                  </div>
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div> -->
                </div>

              </div>
            </div>';    
        }
        
        function zobraz_publikacie($AISid) {
            $urltopost = "http://is.stuba.sk/lide/clovek.pl";
            $datatopost = array (
                "lang" => "sk",
                "zalozka" => "5",
                "id" => $AISid,
                "rok"=>"1",
                "order_by"=>"rok_uplatneni"
            );

            $ch = curl_init ($urltopost);

            curl_setopt ($ch, CURLOPT_POST, true);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

            $returndata = curl_exec($ch);

            curl_close($ch);

            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($returndata);
            $xPath = new DOMXPath($doc);
            $tablePublikacia = $xPath->query('//html/body/div/div/div/table[3]/tbody/tr');

            echo '<table id="staff-table-publikace" class="table-horizontal table-bordered table-hover">
                    <thead class="staff-table-publikace-head">
                        <tr>
                            <th class="center">Por.</th> 
                            <th class="center">Publikácie</th>
                            <th class="center">Druh výsledku</th>
                            <th class="center">Rok</th>
                        </tr>
                    </thead>';

            $por = 1;
            foreach ($tablePublikacia as $publ) {
                if ((intval($publ->childNodes[3]->textContent) > 2012) && (strpos($publ->childNodes[2]->textContent,"monografie") === 0)) {
                    echo '<tr>';
                        echo '<td class="bold" style="color: #5e6060;">'.$por++.'</td>';
                        echo '<td>'.$publ->childNodes[1]->textContent.'</td>';
                        echo '<td  style="color: #4890DB;">'.$publ->childNodes[2]->textContent.'</td>';
                        echo '<td>'.$publ->childNodes[3]->textContent.'</td>';
                    echo "</tr>";
                }
            }

            foreach ($tablePublikacia as $publ) {
                if ((intval($publ->childNodes[3]->textContent) > 2012) && (strpos($publ->childNodes[2]->textContent,"články") === 0)) {
                    echo '<tr>';
                        echo '<td class="bold" style="color: #5e6060;">'.$por++.'</td>';
                        echo '<td>'.$publ->childNodes[1]->textContent.'</td>';
                        echo '<td  style="color: #3CDAB2;">'.$publ->childNodes[2]->textContent.'</td>';
                        echo "<td>".$publ->childNodes[3]->textContent."</td>";
                    echo "</tr>";
                }
            }

            foreach ($tablePublikacia as $publ) {
                if ((intval($publ->childNodes[3]->textContent) > 2012) && (strpos($publ->childNodes[2]->textContent,"príspevky") === 0)) {
                    echo '<tr>';
                        echo '<td class="bold" style="color: #5e6060;">'.$por++.'</td>';
                        echo '<td>'.$publ->childNodes[1]->textContent.'</td>';
                        echo '<td  style="color: #FFD446;">'.$publ->childNodes[2]->textContent.'</td>';
                        echo "<td>".$publ->childNodes[3]->textContent."</td>";
                    echo "</tr>";
                }
            }
        }
        
       

?>
