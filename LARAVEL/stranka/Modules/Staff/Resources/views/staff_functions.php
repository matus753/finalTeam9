<?php
	function zobraz_zoznam_pracovnikov($result) {  
            
            echo '<div style="overflow-x: auto;">';
            echo '<table class="table table-striped table-hover table-bordered" id="SS-table-staff">
                    <tr style="background-color: #3CDAB2; color: white;">
                      <th onclick="sortTable(0)" style="cursor:pointer" class="staff-th center staff-table-th1"><i class="fa fa-sort"></i> Meno</th>
                      <th class="center staff-table-th2">Miestnosť</th>
                      <th class="center staff-table-th3">Klapka</th>
                      <th onclick="sortTable(3)" style="cursor:pointer" class="staff-th center staff-table-th4"><i class="fa fa-sort"></i> Oddelenie</th>
                      <th onclick="sortTable(4)" style="cursor:pointer" class="staff-th center staff-table-th5"><i class="fa fa-sort"></i> Zaradenie</th>
                      <th class="center staff-table-th6">Funkcia</th>
                    </tr>
                  <tbody>';

                  if ($result->num_rows > 0) {           
                      while($row = $result->fetch_assoc()) {
                          if( strpos($row['name'], "Admin" ) === false ) {
                            echo '<tr class="m" data-toggle="modal" data-id="'.$row['id'].'" data-target="#myModal">';
                                echo "<td> <i class='fa fa-search-plus staff-icon-plus'></i> ";
                                    echo $row['surname'] . " " . $row['name'];
                                    if (!empty($row['title1']))
                                        echo ", " . $row['title1'];
                                    if (!empty($row['title2']))
                                        echo ", " . $row['title2'];
                                echo "</td>";
                                echo "<td class='center'>";
                                    echo $row['room'];
                                echo "</td>";
                                echo "<td class='center'>";
                                    echo $row['phone'];
                                echo "</td>";
                                echo "<td class='center'>";
                                    echo $row['department'];
                                echo "</td>";
                                echo "<td class='center'>";
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
          </div>
        
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
 
?>
