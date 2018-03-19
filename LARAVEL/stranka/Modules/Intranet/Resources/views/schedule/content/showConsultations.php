
<?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
<div class="col-lg-12">
    <h2><?php echo $lang['CONS']; ?></h2>
    
 


<?php

    $consul = $db->getConsultation();
    //var_dump($consul);
    
   
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabConsult">
    <thead>
            <tr>
                <th>#</th>
                <th>'.$lang['NAME'].'</th>
                <th>'.$lang['TIME'].'</th>
                <th>'.$lang['DURATION'].'</th>
                <th>'.$lang['SCHEDULE_DAY'].'</th>
                <th>'.$lang['NOTE'].'</th>
                <th>'.$lang['EDITS'].'</th>
            </tr>
    </thead>';
    $i=1;
    foreach ($consul as $value) {
        
        echo "<tr>";
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$value->getPerson()->getSurname().' '.$value->getPerson()->getName().'</td>';
        echo '<td>'.$value->getStart_time().'</td>';
        echo '<td>'.$value->getDuration().'</td>';
        echo '<td>'.$value->getDay("sk").'</td>';
        echo '<td>'.$value->getNote().'</td>';
        
        echo '<td><a class="btn btn-warning btn-xs" href="index.php?editConsultation&AMP;id='.$value->getId().'">'.$lang['BUTTON_EDIT'].'</a>'
                . '  <a class="btn btn-danger btn-xs" href="index.php?eraseConsultation&AMP;id='.$value->getId().'">'.$lang['BUTTON_DELETE'].'</a></td>';
        echo '</tr>';
        
    }

echo '</table>';

?>

<script>
    
      $(document).ready(function() 
    { 
        $("#tabConsult").tablesorter(); 
    } 
); 
</script>

</script>

<?php }?>


<?php if (isset($_SESSION['user_name']) && isset($_SESSION['teacher_id'])) {?>
<div class="col-lg-12">
    <h2><?php echo $lang['CONS']; ?></h2>
    
 


<?php

    $consul = $db->getConsultationByPerson(array($_SESSION['teacher_id']));
    
   
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabConsult">
    <thead>
            <tr>
                <th>#</th>
                <th>'.$lang['NAME'].'</th>
                <th>'.$lang['TIME'].'</th>
                <th>'.$lang['DURATION'].'</th>
                <th>'.$lang['SCHEDULE_DAY'].'</th>
                <th>'.$lang['NOTE'].'</th>
                <th>'.$lang['EDITS'].'</th>
            </tr>
    </thead>';
    $i=1;
    foreach ($consul as $value) {
        
        echo "<tr>";
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$value->getPerson()->getSurname().' '.$value->getPerson()->getName().'</td>';
        echo '<td>'.$value->getStart_time().'</td>';
        echo '<td>'.$value->getDuration().'</td>';
        echo '<td>'.$value->getDay("sk").'</td>';
        echo '<td>'.$value->getNote().'</td>';
        
        echo '<td><a class="btn btn-warning btn-xs" href="index.php?editConsultation&AMP;id='.$value->getId().'">'.$lang['BUTTON_EDIT'].'</a>'
                . '  <a class="btn btn-danger btn-xs" href="index.php?eraseConsultation&AMP;id='.$value->getId().'">'.$lang['BUTTON_DELETE'].'</a></td>';
        echo '</tr>';
        
    }

echo '</table>';

?>

<script>
    
      $(document).ready(function() 
    { 
        $("#tabConsult").tablesorter(); 
    } 
); 
</script>

</script>

<?php }?>






