<?php

    include('config.php');
    include('general_functions.php');

    
    function zobraz_projekty($typ) {
        $conn = new_connection();	    
        $sql = "SELECT * FROM project WHERE projectType LIKE '". $typ . "%' ORDER BY RIGHT(duration, 4) DESC";
        $result = $conn->query($sql);

        echo '<table class="table table-striped table-hover table-bordered" id="SS-table-staff">
                <tr style="background-color: #3CDAB2; color: white;">
                  <th class="projects-table-th1">Číslo projektu</th>
                  <th class="projects-table-th2">Názov projektu</th>
                  <th class="projects-table-th3">Doba riešenia</th>
                  <th class="projects-table-th4">Zodpovedný riešiteľ</th>
                </tr>
              <tbody>';

              if ($result->num_rows > 0) {           
                  while($row = $result->fetch_assoc()) {
                      echo '<tr class="m" data-toggle="modal" data-id="'.$row['id'].'" data-target="#myModalProjects">';
                          echo "<td>";
                              echo $row['number'];
                          echo "</td>";
                          echo "<td>";
                              echo $row['titleSK'];
                          echo "</td>";
                          echo "<td>";
                              uprav_datum($row['duration']);
                          echo "</td>";
                          echo "<td>";
                              echo $row['coordinator'];
                          echo "</td>";
                      echo "</tr>";
                  }
              }

         echo '</tbody>
      </table>

        <div class="modal fade" id="myModalProjects" role="dialog">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
              <div class="modal-body" id="modalProjects">

              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> -->
            </div>

          </div>
        </div>';    
    }
    
    function uprav_datum($date) {
        if (strlen($date) < 12 )
            echo $date;
        else {
            $array = explode('-',$date);            
            $date1 = explode('.',$array[0]);
            $date2 = explode('.',$array[1]);
            echo $date1[sizeof($date1)-1]." - ".$date2[sizeof($date2)-1];
        }
    }