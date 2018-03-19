
<?php
 if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) || isset($_SESSION['teacher_id']))) {

    if(isset($_GET['id'])){
    $id=$_GET['id'];

    $oddelenie = $db->getGroup();
    $persontype = $db->getPersonType();
    //var_dump($persontype);
    
    //var_dump($oddelenie);
    $pom=$db->getPerson($id);
    $person = $pom[0];

    //var_dump($persontype);
    
    $lects=$db->getLecturesByPerson(array($id));
        
    //var_dump($lects);
    //s
    }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            
                 <?php

  
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabLects">
    <thead>
            <tr>
                <th>#</th>
                <th>'.$lang['SUBJECT_NAME'].'</th>
                <th>'.$lang['TYPE'].'</th>
                <th>'.$lang['CONSULT_DUR'].'</th>
                <th>'.$lang['SUMSTUDENTS'].'</th>
            </tr>
    </thead>';
    $i=1;
    foreach ($lects as $value) {
        
        
        
        echo "<tr>";
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$value->getSubject()->getName().'</td>';
        echo '<td>'.$value->getTypeName().'</td>';
        echo '<td>'.$value-> getDuration().' h</td>';
        if(strpos($_SESSION['user_name'], $person->getLdap()) !== false && $value->getSubject()->getActive() == 1 && $value->getSubject()->getYearObject()->getActive() == 1){
        	echo '<td><a href="index.php?editStudentsLecture&id='.$value->getId().'">'.$value->getStudents().'</a></td>';
        } else {
        	echo '<td>'.$value->getStudents().'</td>';
        }
        echo '</tr>';
        
    }


echo '</table>';

?> 
               
                  
     <a class="btn btn-default" href="index.php?showPersonsU"><?php echo $lang['BUTTON_BACK']; ?></a>         
                  
                                  
                  
</div>
<?php } ?>