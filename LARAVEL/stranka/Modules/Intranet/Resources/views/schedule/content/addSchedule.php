<?php 
$day_sk = array(
    1 => 'Pondelok',
    2 => 'Utorok',
    3 => 'Streda',
    4 => 'Štvrtok',
    5 => 'Piatok',
);
$day_en = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
);
if (isset($_GET['subjects'])) {
    require_once '../config.php';
    $db = new DbManager();


        /*if (isset($_POST['semester'])) {
            echo '<div class="form-group" id="subjectSelectForm"><label for="subject" class="col-lg-2 control-label">Predmet</label><div class="col-lg-10"><select class="form-control" id="selectSubject" name="subject"><option selected disabled></option>';
            foreach ($db->getSubjectByTerm($_POST['semester']) as $value) {
                echo '<option value="' . $value->getId() . '">' . $value->getName() . '</option>';
            }
            echo '</select><br></div></div>';
        }*/

    if (isset($_POST['semester']) && isset($_POST['year'])) {
        echo '<div class="form-group" id="subjectSelectForm"><label for="subject" class="col-lg-2 control-label">Predmet</label><div class="col-lg-10"><select class="form-control" id="selectSubject" name="subject"><option selected disabled></option>';
        foreach ($db->getSubjectByTermAndYear($_POST['semester'], $_POST['year']) as $value) {
            echo '<option value="' . $value->getId() . '">' . $value->getName() . '</option>';
        }
        echo '</select><br></div></div>';
    }


}
else if (isset($_GET['exercises'])) {
    require_once '../config.php';
    $db = new DbManager();
    if (isset($_POST['execNumber'])) {
        if (intval ($_POST['execNumber'])>0 && intval ($_POST['execNumber'])<15) {
            echo '<div id="allExercises">';
            for ($i=1;$i<=intval($_POST['execNumber']);$i++) {
    echo '<div class="col-lg-13"><h5 style="text-decoration: underline;">Cvičenie '.$i.'</h5></div><div class="form-group" id="exerc'.$i.'TeachSelectForm">
        <label for="exerc'.$i.'Teach" class="col-lg-2 control-label">Cvičiaci</label>
        <div class="col-lg-10">
        <select class="form-control" id="selectExerc'.$i.'Teach" name="exerc'.$i.'Teach" required>
            <option selected disabled></option>';
            foreach ($db->getPerson() as $value) {
                echo '<option value="'.$value->getId().'">'.$value->getName().' '.$value->getSurname().'</option>';
            }
            echo '</select><br></div></div>
        <div class="form-group" id="exerc'.$i.'DaySelectForm">
            <label for="exerc'.$i.'Day" class="col-lg-2 control-label">Deň cvičenia</label>
            <div class="col-lg-10">
            <select class="form-control" id="selectExerc'.$i.'Day" name="exerc'.$i.'Day" required>
                <option selected disabled></option>';
                  foreach ($day_sk as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select><br></div></div><div class="form-group" id="exerc'.$i.'TimeSelectForm">
            <label for="exerc'.$i.'Time" class="col-lg-2 control-label">Čas cvičenia</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="exerc'.$i.'Time" id="selectExerc'.$i.'Time" placeholder="napr. 8:00" required>
              <br>
            </div>
          </div>
    <div class="form-group" id="exerc'.$i.'RoomSelectForm">
        <label for="exerc'.$i.'Room" class="col-lg-2 control-label">Miestnosť</label>
        <div class="col-lg-10">
        <select class="form-control" id="selectExerc'.$i.'Room" name="exerc'.$i.'Room" required>
            <option selected disabled></option>';
            foreach ($db->getRoom() as $value) {
                  echo '<option value="'.$value->getId().'">'.$value->getRoom().'</option>';
              }
            echo '</select><br></div></div>';  
            }
            echo '</div>';
        }
    }
}
else if (isset($_GET['postForm'])) {
    if ($_POST) {
        if (!isset($_POST['save'])) {
            require_once '../config.php';
            $db = new DbManager();          
        }
        $pom=$db->getSubject($_POST['subject']);
        $subject = $pom[0];
        $pom=$db->getPerson($_POST['lecture']);
        $person = $pom[0];
        $pom=$db->getRoom($_POST['lectRoom']);
        $prednaskaRoom = $pom[0];
        
        $prednaska = new Lecture();
        $prednaska->setSubject_id($_POST['subject']);
        $prednaska->setSubject($subject);
        $prednaska->setPerson_id($_POST['lecture']);
        $prednaska->setPerson($person);
        $prednaska->setType_id(1);
        $prednaska->setRoom_id($_POST['lectRoom']);
        $prednaska->setRoom($prednaskaRoom);
        
        $prednaska->setDay($_POST['lectDay']);
        $prednaska->setStart_time($_POST['lectTime']);
        $exercises = array();
        array_push($exercises,$prednaska);
        
        for ($i=1;$i<=$_POST['exercisesNum'];$i++) {
            $teacher = 'exerc'.$i.'Teach';
            $room = 'exerc'.$i.'Room';
            $day = 'exerc'.$i.'Day';
            $time = 'exerc'.$i.'Time';

            $pom=$db->getRoom($_POST[$room]);
            $cvicenieRoom = $pom[0];
            $cvicenie = new Lecture();
            $cvicenie->setSubject_id($_POST['subject']);
            $cvicenie->setSubject($subject);
            $cvicenie->setPerson_id($_POST[$teacher]);
            $cvicenie->setPerson($person);
            $cvicenie->setType_id(2);
            $cvicenie->setRoom_id($_POST[$room]);
            $cvicenie->setRoom($cvicenieRoom);
            $cvicenie->setDay($_POST[$day]);
            $cvicenie->setStart_time($_POST[$time]);
            array_push($exercises,$cvicenie);
        }
        
        if (!isset($_POST['save'])) {
            $schedule = new Schedule();
            $schedule->setCourses($exercises, $db->getLastYearId());
            $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable().'</div>';
            echo $pdfData;
            echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  htmlentities($pdfData).'" /><input class="btn btn-primary" type="submit" name="submit" value="Vygeneruj PDF" /></form></div>';
        }
        else {
            foreach ($exercises as $value) {
            	print_r($value);
                $db->insertLecture($value);
            }
            header('Location: index.php');
        }
    }
    else {
        header('Location: index.php');
    }
}
else {
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
?>
<div class="col-lg-12" id="zatotodivko">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="well bs-component">
  <form id="subjectScheduleForm" class="form-horizontal" method="POST" action="index.php?addSchedule&amp;postForm">
    <fieldset>
      <legend><?php echo $lang['SCHEDULE_DEFINING']; ?></legend>
        <div class="form-group" id="yearSelectForm">
            <label for="year" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
            <div class="col-lg-10">
                <select class="form-control" id="selectYear" name="year" required>
                    <option selected disabled></option>
                    <?php
                    foreach ($db->getYear() as $value) {
                        echo '<option value="'.$value->getId().'">'.$value->getYear().'</option>';
                    }
                    ?>
                </select>

            </div>
        </div>
      <div class="form-group" id="semesterSelectForm">
        <label for="semester" class="col-lg-2 control-label"><?php echo $lang['TERM']; ?></label>
        <div class="col-lg-10">
            <select class="form-control" id="selectSemester" name="semester" required>
            <option selected disabled></option>
            <option value="W"><?php echo $lang['SEMESTER_WINTER']; ?></option>
            <option value="S"><?php echo $lang['SEMESTER_SUMMER']; ?></option>
        </select>
          
        </div>
      </div>
      <div id="hiddenLecturesExercises">
    <div class="col-lg-13"><h4><?php echo $lang['LECTURE']?></h4></div>
      <div class="form-group" id="lectureSelectForm">
        <label for="lecture" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TEACHER']?></label>
        <div class="col-lg-10">
        <select class="form-control" id="selectLecture" name="lecture" required>
            <option selected disabled></option>
            <?php
            foreach ($db->getPerson() as $value) {
                if($value->getActive()>0)
                echo '<option value="'.$value->getId().'">'.$value->getName().' '.$value->getSurname().'</option>';
            }
            ?>
        </select>
          <br>
        </div>
      </div>
        <div class="form-group" id="lectDaySelectForm">
            <label for="lectDay" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DAY']?></label>
            <div class="col-lg-10">
            <select class="form-control" id="selectLectDay" name="lectDay" required>
                <option selected disabled></option>
                <?php
                  foreach ($day_sk as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                ?>
            </select>
              <br>
            </div>
          </div>
    
        <div class="form-group" id="lectTimeSelectForm">
            <label for="lectTime" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TIME_BEGIN']?></label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="lectTime" id="selectLectTime" placeholder="napr. 8:00" required>
              <br>
            </div>
          </div>
    
    <div class="form-group" id="lectRoomSelectForm">
        <label for="lectRoom" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_ROOM']?></label>
        <div class="col-lg-10">
        <select class="form-control" id="selectLectRoom" name="lectRoom" required>
            <option selected disabled></option>
            <?php
            foreach ($db->getRoom() as $value) {
                  echo '<option value="'.$value->getId().'">'.$value->getRoom().'</option>';
              }
            ?>
        </select>
          <br>
        </div>
      </div>
    
    <div class="col-lg-13"><h4><?php echo $lang['EXERCISES']?></h4></div>
        <div class="form-group" id="exercisesNumSelectForm">
            <label for="exercisesNum" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_ROOM']?></label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="exercisesNum" id="selectExercisesNum" placeholder="<?php echo $lang['EXERCISES_NUM']?>" required>
              <br>
            </div>
          </div>
    </div>
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <input class="submitButton btn btn-primary" type="submit" name="view" alt="Náhľad" value="<?php echo $lang['BUTTON_SHOW']?>"/>
        </div> 
      </div>
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <input class="submitButton btn btn-primary" type="submit" name="save" alt="Uložiť" value="<?php echo $lang['BUTTON_EDIT']?>"/>
        </div> 
      </div>
    </fieldset>
  </form>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
</div>
<?php } ?>
<?php } ?>