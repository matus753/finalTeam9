 <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
<div class="col-lg-12">
    <h2><?php echo $lang['ROOMS']; ?></h2>
<?php

    $rooms = $db->getRoom();
    //var_dump($rooms);
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabRoz">
    <thead>
            <tr>
                <th>#</th>
                <th>'.$lang['ROOM_ADD_NAME'].'</th>
                <th>'.$lang['EDITS'].'</th>
            </tr>
    </thead>';
    $i=1;
    foreach ($rooms as $value) {
        
        
        echo "<tr>";
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$value->getRoom().'</td>';
        echo '<td><a class="btn btn-warning btn-xs" href="index.php?editRoom&AMP;id='.$value->getId().'">'.$lang['BUTTON_EDIT'].'</a>'
                . '  <a class="btn btn-danger btn-xs" href="index.php?eraseRoom&AMP;id='.$value->getId().'">'.$lang['BUTTON_DELETE'].'</a></td>';
        echo '</tr>';
        
    }


echo '</table>';

?>
</div>

<script>
 


$(document).ready(function() { 
    $("#tabRoz").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }
        } 
    }); 
});
</script>
<?php } ?>