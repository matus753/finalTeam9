<?php

    include('../general_functions.php');

    
    function zobraz_projekty($typ) {
        $conn = new_connection();	    
        $sql = "SELECT * FROM project WHERE projectType LIKE '". $typ . "%' ORDER BY RIGHT(duration, 4) DESC";
        $result = $conn->query($sql);
        echo '<div style="overflow-x: auto;">';
        echo '<table class="table table-striped table-hover table-bordered" id="SS-table-staff">
                <tr style="background-color: #3CDAB2; color: white;">
                  <th class="projects-table-th1 center">Project number</th>
                  <th class="projects-table-th2 center">Project title</th>
                  <th class="projects-table-th3 center">Duration</th>
                  <th class="projects-table-th4 center">Coordinator</th>
                </tr>
              <tbody>';

              if ($result->num_rows > 0) {           
                  while($row = $result->fetch_assoc()) {
                      echo '<tr class="m" data-toggle="modal" data-id="'.$row['id'].'" data-target="#myModalProjects">';
                          echo "<td  class='center'>";
                              echo $row['number'];
                          echo "</td>";
                          echo "<td>";
                              echo $row['titleEN'];
                          echo "</td>";
                          echo "<td class='center'>";
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
      </div>

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