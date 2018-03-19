<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) { ?>
<div class="col-lg-12">
    <h2><?php echo $lang['SCHEDULE_CHECK_TITLE'];  if (isset($_POST['year'])) echo " - ".$_POST['year']?></h2>
    <form class="form-inline" method="POST" action="index.php?checkLectures">
        <input type="hidden" name="checkLectures"/> 
        <fieldset>
            <div class="form-group text-center" >
                <label for="term" class="col-lg-2 control-label" style="top: 11px!important;">Semester</label>
                <div class="col-lg-2">
                  <select class="form-control" id="term" name="term">
                    <?php if ($_SESSION['lang']=='sk') {?>
                    <option value="S">Letný</option><option value="W" <?php if(isset( $_POST['term']) && $_POST['term']=="W"){echo "selected";}?>>Zimný</option>                  
                    <?php } else {?>
                    <option value="S">Summer</option><option value="W" <?php if(isset( $_POST['term']) && $_POST['term']=="W"){echo "selected";}?>>Winter</option>
                    <?php } ?>      
                  </select>
                </div>

                <div class="form-group text-center">
                    <label for="select" style="top: 11px!important;" class="col-lg-2 control-label  "><?php echo $lang['YEAR']; ?></label>
                    <div class="col-lg-2">
                        <select class="form-control" id="select" name="year">
                            <?php
                            foreach ($db->getYear() as $value) {
                                echo '<option ';
                                echo 'value="'.$value->getYear().'">'.$value->getYear().'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary"><?php echo $lang['SCHEDULE_CHOOSE']; ?></button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
<?php
    
    $term = $_POST['term'] ? $_POST['term'] : "S";
    $year = 2;
    if(isset($_POST['year'])){

        $res = $db->getYearFromFullYear(strval($_POST['year']));
        $year =  $res[0]->id;
    }

    $subjects = $db->getSubjectByTermAndYear($term,$year);
    if ($_SESSION['lang']=='sk')
    echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabCheck">
    <thead>
            <tr>
                <th>#</th>
                <th>Predmet</th>
                <th>Prednášky</th>
                <th>Cvičenia</th>
                <th>Úpravy</th>
            </tr>
    </thead>';
    else
    echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabCheck">
    <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Lectures</th>
                <th>Excercises</th>
                <th>Edits</th>
            </tr>
    </thead>';    
    $i=1;
    $check='';
    foreach ($subjects as $value) {
        
        
        if($value->getExcerciseCount() && $value->getLectureCount() ){
            echo '<tr class="success">';
            if ($_SESSION['lang']=='sk')
            $check='Rozvrh vytvorený';
            else $check='The schedule has been successfully created';
        }
        
        else{
            echo '<tr class="danger">';
            if ($_SESSION['lang']=='sk')
            $check='Rozvrh nedokončený';
            else $check='The schedule has not been successfully created';
        }
        
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$value->getName().'</td>';
        echo '<td>'.$value->getLectureCount().'</td>';
        echo '<td>'.$value->getExcerciseCount().'</td>';
        if(!$value->getExcerciseCount() || !$value->getLectureCount()){echo '<td><a href="index.php?addLecture" class="btn btn-danger btn-xs" >'.$lang['SCHEDULE_ADD_CLASSES'].'</a></td>';}
        else echo '<td><a href="index.php?editSchedule&id='.$value->getId().'" class="btn btn-danger btn-xs" >'.$lang['SCHEDULE_EDIT_SCHEDULE'].'</a></td>';
        echo "</tr>";
        
       
        
    }


echo '</table>';

?>
</div>
<script>
$(document).ready(function() { 
    $("#tabCheck").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            
            3: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            } 
        } 
    }); 
});
</script>
</script>
<?php }?>