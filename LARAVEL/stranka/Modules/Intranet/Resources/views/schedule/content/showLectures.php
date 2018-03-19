 <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
<div class="col-lg-12">
    <h2><?php echo $lang['CLASSES']; ?></h2>
<?php

    $lect =  $db->getLecture();
    //var_dump($lect);
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabLect">
    <thead>
            <tr>
                <th>#</th>
                <th>'.$lang['SUBJECT_NAME'].'</th>
                <th>'.$lang['SCHEDULE_TEACHER'].'</th>
                <th>'.$lang['YEAR'].'</th>
                <th>'.$lang['TERM'].'</th>
                <th>'.$lang['SCHEDULE_ROOM'].'</th>
                <th>'.$lang['BEGIN'].'</th>
                <th>'.$lang['SCHEDULE_DAY'].'</th>
                <th>'.$lang['EDITS'].'</th>
            </tr>
    </thead>';
    $i=1;
    foreach ($lect as $value) {
        
        //if ($value->getPerson()->getActive() > 0)
        echo "<tr>";
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$value->getSubject()->getName().'</td>';
        echo '<td>'.$value->getPerson()->getSurname().' '.$value->getPerson()->getName().'</td>';
        echo '<td>'.$value->getSubject()->getYearObject()->getYear().'</td>';
        echo '<td>'.$value->getSubject()->getTerm().'</td>';
        echo '<td>'.$value->getRoom()->getRoom().'</td>';
        echo '<td>'.$value->getStart_time().'</td>';
        if ($_SESSION['lang']=='sk') echo '<td>'.$value->getDay("sk").'</td>'; else echo '<td>'.$value->getDay("en").'</td>';
        
        
        echo '<td><a class="btn btn-warning btn-xs" href="index.php?editLecture&AMP;id='.$value->getId().'">'.$lang['BUTTON_EDIT'].'</a>'
                . '  <a class="btn btn-danger btn-xs" href="index.php?eraseLecture&AMP;id='.$value->getId().'">'.$lang['BUTTON_DELETE'].'</a></td>';
        echo '</tr>';
        
    }


echo '</table>';

?>
</div>
<script>
 


$(document).ready(function() { 
    $("#tabLect").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            7: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }
        } 
    }); 
});
</script>
<?php } ?>