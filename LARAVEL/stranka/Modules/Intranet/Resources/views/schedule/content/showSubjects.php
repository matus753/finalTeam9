 <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
<div class="col-lg-12">
    <h2><?php echo $lang['SUBJECTS']; ?></h2>
<?php

    $subjects = $db->getSubject();
    //var_dump($subjects);
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabSubj">
    <thead>
            <tr>
                <th>#</th>
                <th>'.$lang['SUBJECT_CODE'].'</th>
                <th>'.$lang['TITLE'].'</th>
                <th>'.$lang['SUBJECT_ABB'].'</th>
                <th>'.$lang['LECTURE'].'</th>
                <th>'.$lang['EXERCISE'].'</th>
                <th>'.$lang['TERM'].'</th>
                <th>'.$lang['YEAR'].'</th>
                <th>'.$lang['EDITS'].'</th>
            </tr>
    </thead>';
    $i=1;
    foreach ($subjects as $value) {
        
        
        echo "<tr>";
        echo '<td style="background-color:'.$value->getColor().';">'.$i++.'</td>';
        echo '<td>'.$value->getCode().'</td>';
        echo '<td>'.$value->getName().'</td>';
        echo '<td>'.$value->getAcronym().'</td>';
        echo '<td>'.$value->getLectureDuration().'</td>';
        echo '<td>'.$value->getExceriseDuration().'</td>';
        echo '<td>'.$value->getTerm().'</td>';
        echo '<td>'.$value->getYearObject()->getYear().'</td>';
        
        echo '<td><a class="btn btn-warning btn-xs" href="index.php?editSubject&AMP;id='.$value->getId().'">'.$lang['BUTTON_EDIT'].'</a>'
                . '  <a class="btn btn-danger btn-xs" href="index.php?eraseSubject&AMP;id='.$value->getId().'">'.$lang['BUTTON_DELETE'].'</a></td>';
        echo '</tr>';
        
    }


echo '</table>';

?>
</div>

<script>
 


$(document).ready(function() { 
    $("#tabSubj").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            7: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }
        } 
    }); 
});
</script>
<?php } ?>
