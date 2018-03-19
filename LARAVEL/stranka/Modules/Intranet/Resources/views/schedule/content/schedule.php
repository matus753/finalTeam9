<?php
// check that the 'registered' key exists
if (isset($_SESSION['schedule'])) {

    // it does; output the message
    //echo $_SESSION['schedule'];

    // remove the key so we don't keep outputting the message
    unset($_SESSION['schedule']);
}

if (isset($_SESSION['page'])) {

    // it does; output the message
    //echo $_SESSION['page'];

    // remove the key so we don't keep outputting the message
    unset($_SESSION['page']);
}

$activeYear = $db->getActiveYearString();
//echo "Active_Year ". str_replace ( "/", "-" , $activeYear);

if (isset($_POST['year'])){

    $originalYearID = $db->getActiveYear();
    $db->setActiveYearFromDbYear($_POST['year']);

}

//$_SESSION['schedule'];
//$_SESSION['page'];

if (isset($_GET['subject'])) {
  $_SESSION['page'] = 'subject';
?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="well bs-component">
  <form id="subjectScheduleForm" class="form-horizontal" method="POST" action="index.php?schedule&amp;subject">
    <fieldset>
      <legend><?php echo $lang['SCHEDULE_VIEW_SUBJECT']; if(isset($_POST["year"] )) echo "   - ".$_POST["year"];  ?></legend>
      <div class="form-group">
        <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_SUBJECT']; ?></label>
        <div class="col-lg-10">
        <select class="form-control" id="select" name="predmet">
            <?php
              foreach ($db->getSubject() as $value) {
                echo '<option ';
                echo array_key_exists("predmet", $_POST) &&  $value->getId() == $_POST["predmet"] ?  'selected ' : '';
                echo 'value="'.$value->getId().'">'.$value->getName().'</option>';
              }
            ?>                       
        </select>
          <br>
        </div>
      </div>
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
            <div class="col-lg-10">
                <select class="form-control" id="select" name="year">
                    <?php
                    foreach ($db->getYear() as $value) {
                        echo '<option ';
                        echo 'value="'.$value->getYear().'">'.$value->getYear().'</option>';
                    }
                    ?>
                </select>
                <br>
            </div>
        </div>
      <div class="form-group">
        <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
          <div class="col-md-2 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
          <div class="col-md-2">
            <button type="submit" name="edit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
          </div>
        <?php }else{?>
          <div class="col-md-4 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
        <?php } ?>
        <div class="col-md-3"><div class="checkbox"><label><input type="checkbox" name="voidDays" checked><?php echo $lang['SCHEDULE_SHOW_EMP_DAYS']; ?></label></div></div>
      </div>
    </fieldset>
  </form>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php 
    if (isset($_POST['predmet'])) {

        $schedule = $db->getScheduleBySubject($_POST['predmet']);
        if (isset($_POST['voidDays'])) {
          $schedule->addVoidDays();
        }
        $_SESSION['schedule'] = serialize($schedule);
        $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable(isset($_POST['edit'])).'</div>';
        echo $pdfData;
        echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  utf8_encode(htmlentities($pdfData)).'" /><input class="btn btn-primary" type="submit" name="submit" value="'.$lang['GENERATE_PDF'].'" /></form></div>';
    }
} 
else if (isset($_GET['teacher'])) {
  $_SESSION['page'] = 'teacher';
?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="well bs-component">
  <form id="teacherScheduleForm" class="form-horizontal" method="POST" action="index.php?schedule&amp;teacher">

      <fieldset>
      <legend><?php echo $lang['SCHEDULE_VIEW_TEACHER']; if(isset($_POST["year"] )) echo "   - ".$_POST["year"];  ?></legend>
      <div class="form-group">
        <label for="inputPassword" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TEACHER']; ?></label>
        <div class="col-lg-10">
          <?php
                foreach ($db->getPerson() as $value) {
                    if($value->getActive()>0)

                  if($value->getAllCoursesCount()>0){
                    if(in_array($value->getId(), $_POST)){
                      echo '<div class="col-md-4"><div class="checkbox"><label><input type="checkbox" checked name="teacher[]" value="'.$value->getId().'"> '.$value->getName().' '.$value->getSurname().'</label></div></div>';
                    }else{
                      echo '<div class="col-md-4"><div class="checkbox"><label><input type="checkbox" name="teacher[]" value="'.$value->getId().'"> '.$value->getName().' '.$value->getSurname().'</label></div></div>';     
                    }
                  }
                }
           ?> 
      </div>
      </div>

          <div class="form-group">
              <label for="select" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
              <div class="col-lg-10">
                  <select class="form-control" id="select" name="year">
                      <?php
                      foreach ($db->getYear() as $value) {
                          echo '<option ';
                          echo 'value="'.$value->getYear().'">'.$value->getYear().'</option>';
                      }
                      ?>
                  </select>
                  <br>
              </div>
          </div>

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
          <div class="col-md-2">
            <button type="submit" name="edit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
          </div>
          <?php }else{?>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
          <?php }?>
          <div class="col-md-4"><div class="checkbox"><label><input type="checkbox" name="voidDays" checked><?php echo $lang['SCHEDULE_SHOW_EMP_DAYS']; ?></label></div></div>
          <div class="col-md-4"><div class="checkbox"><label><input type="checkbox" name="cons"><?php echo $lang['SCHEDULE_SHOW_CONS']; ?></label></div></div>
        </div>
        
      </div>
    </fieldset>
  </form>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php
if (isset($_POST['teacher'])) {
        $pole = array();
        foreach ($_POST['teacher'] as $value) {
            array_push($pole,intval($value));
        }
        $schedule = $db->getScheduleByPerson($pole, isset($_POST['cons']));
        if (isset($_POST['voidDays'])) {
          $schedule->addVoidDays();
        }
        $_SESSION['schedule'] = serialize($schedule);
        $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable(isset($_POST['edit'])).'</div>';
        echo $pdfData;

        echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  utf8_encode(htmlentities($pdfData)).'" /><input class="btn btn-primary" type="submit" name="submit" value="'.$lang['GENERATE_PDF'].'" /></form></div>';
    }
}
else if (isset($_GET['room'])) {
  $_SESSION['page'] = 'room';
?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="well bs-component">
  <form id="subjectScheduleForm" class="form-horizontal" method="POST" action="index.php?schedule&amp;room">
    <fieldset>
      <legend><?php echo $lang['SCHEDULE_VIEW_ROOM']; if(isset($_POST["year"] )) echo "   - ".$_POST["year"];  ?></legend>
      <div class="form-group">
        <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_ROOM']; ?></label>
        <div class="col-lg-10">
        <select class="form-control" id="select" name="room">
            <?php
              foreach ($db->getRoom() as $value) {
                 // echo '<option value="'.$value->getId().'">'.$value->getRoom().'</option>';
                  echo '<option ';
                  echo array_key_exists("room", $_POST) && $value->getId() == $_POST["room"] ?  'selected ' : '';
                  echo 'value="'.$value->getId().'">'.$value->getRoom().'</option>';
              }
            ?>                       
        </select>
          <br>
        </div>
      </div>

        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
            <div class="col-lg-10">
                <select class="form-control" id="select" name="year">
                    <?php
                    foreach ($db->getYear() as $value) {
                        echo '<option ';
                        echo 'value="'.$value->getYear().'">'.$value->getYear().'</option>';
                    }
                    ?>
                </select>
                <br>
            </div>
        </div>





      <div class="form-group">
        <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
          <div class="col-md-2 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
          <div class="col-md-2">
            <button type="submit" name="edit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
          </div>
        <?php }else{?>
          <div class="col-md-4 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
        <?php } ?>
        <div class="col-md-3"><div class="checkbox"><label><input type="checkbox" name="voidDays" checked><?php echo $lang['SCHEDULE_SHOW_EMP_DAYS']; ?></label></div></div>
      </div>
    </fieldset>
  </form>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php 
if (isset($_POST['room'])) {
        $schedule = $db->getScheduleByRoom($_POST['room']);
        if (isset($_POST['voidDays'])) {
          $schedule->addVoidDays();
        }
        $_SESSION['schedule'] = serialize($schedule);
        $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable(isset($_POST['edit'])).'</div>';
        echo $pdfData;
        echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  utf8_encode(htmlentities($pdfData)).'" /><input class="btn btn-primary" type="submit" name="submit" value="'.$lang['GENERATE_PDF'].'" /></form></div>';
    }
}
else if (isset($_GET['group'])) {
  $_SESSION['page'] = 'group';
?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="well bs-component">
  <form id="subjectScheduleForm" class="form-horizontal" method="POST" action="index.php?schedule&amp;group">
    <fieldset>
      <legend><?php echo $lang['SCHEDULE_VIEW_DEPARTMENT']; if(isset($_POST["year"] )) echo "   - ".$_POST["year"];  ?></legend>
      <div class="form-group">
        <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DEPARTMENT']; ?></label>
        <div class="col-lg-10">
        <select class="form-control" id="select" name="group">
            <?php
              foreach ($db->getGroup() as $value) {
                  //echo '<option value="'.$value->getIdGroups().'">'.$value->getName().'</option>';
                  echo '<option ';
                  echo  array_key_exists("group", $_POST) && $value->getIdGroups() == $_POST["group"] ?  'selected ' : '';
                  echo 'value="'.$value->getIdGroups().'">'.$value->getName().'</option>';
              }
            ?>                       
        </select>
          <br>
        </div>
      </div>

        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
            <div class="col-lg-10">
                <select class="form-control" id="select" name="year">
                    <?php
                    foreach ($db->getYear() as $value) {
                        echo '<option ';
                        echo 'value="'.$value->getYear().'">'.$value->getYear().'</option>';
                    }
                    ?>
                </select>
                <br>
            </div>
        </div>




      <div class="form-group">
        <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
          <div class="col-md-2 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
          <div class="col-md-2">
            <button type="submit" name="edit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
          </div>
        <?php }else{?>
          <div class="col-md-4 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
        <?php } ?>
        <div class="col-md-3"><div class="checkbox"><label><input type="checkbox" name="voidDays" checked><?php echo $lang['SCHEDULE_SHOW_EMP_DAYS']; ?></label></div></div>
        <div class="col-md-3"><div class="checkbox"><label><input type="checkbox" name="cons"><?php echo $lang['SCHEDULE_SHOW_CONS']; ?></label></div></div>
      </div>
    </fieldset>
  </form>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php 
if (isset($_POST['group'])) {
        $schedule = $db->getScheduleByGroup($_POST['group'], isset($_POST['cons']));
        if (isset($_POST['voidDays'])) {
          $schedule->addVoidDays();
        }
        $_SESSION['schedule'] = serialize($schedule);
        $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable(isset($_POST['edit'])).'</div>';
        echo $pdfData;
        echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  utf8_encode(htmlentities($pdfData)).'" /><input class="btn btn-primary" type="submit" name="submit" value="'.$lang['GENERATE_PDF'].'" /></form></div>';
    }
}
else if (isset($_GET['day'])) {
?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="well bs-component">
  <form id="subjectScheduleForm" class="form-horizontal" method="POST" action="index.php?schedule&amp;day">
    <fieldset>
      <legend><?php echo $lang['SCHEDULE_VIEW_DAY']; if(isset($_POST["year"] )) echo "   - ".$_POST["year"];  ?></legend>
      <div class="form-group">
        <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DAY']; ?></label>
        <div class="col-lg-10">
        <select class="form-control" id="select" name="day">
            <?php
              $day_sk = array(
                  1 => 'Pondelok',
                  2 => 'Utorok',
                  3 => 'Streda',
                  4 => 'Štvrtok',
                  5 => 'Piatok',
                  6 => 'Sobota',
                  7 => 'Nedeľa'
              );
                foreach ($day_sk as $key => $value) {
                  //echo '<option value="'.$key.'">'.$value.'</option>';
                  echo '<option ';
                  echo array_key_exists("day", $_POST) && $key == $_POST["day"] ?  'selected ' : '';
                  echo 'value="'.$key.'">'.$value.'</option>';
              }
            ?>                       
        </select>
          <br>
        </div>
      </div>

        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
            <div class="col-lg-10">
                <select class="form-control" id="select" name="year">
                    <?php
                    foreach ($db->getYear() as $value) {
                        echo '<option ';
                        echo 'value="'.$value->getYear().'">'.$value->getYear().'</option>';
                    }
                    ?>
                </select>
                <br>
            </div>
        </div>




      <div class="form-group">
        <?php if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {?>
          <div class="col-md-2 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
          <div class="col-md-2">
            <button type="submit" name="edit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
          </div>
        <?php }else{?>
          <div class="col-md-4 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SHOW']; ?></button>
          </div>
        <?php } ?>
        <div class="col-md-3"><div class="checkbox"><label><input type="checkbox" name="voidDays" checked><?php echo $lang['SCHEDULE_SHOW_EMP_DAYS']; ?></label></div></div>
        <div class="col-md-3"><div class="checkbox"><label><input type="checkbox" name="cons"><?php echo $lang['SCHEDULE_SHOW_CONS']; ?></label></div></div>
      </div>
    </fieldset>
  </form>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php
if (isset($_POST['day'])) {
    $schedule = $db->getScheduleByDay($_POST['day'], isset($_POST['cons']));
    if (isset($_POST['voidDays'])) {
      $schedule->addVoidDays();
    }
    $_SESSION['schedule'] = serialize($schedule);
    $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable(isset($_POST['edit'])).'</div>';
    echo $pdfData;
    echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  utf8_encode(htmlentities($pdfData)).'" /><input class="btn btn-primary" type="submit" name="submit" value="'.$lang['GENERATE_PDF'].'" /></form></div>';
    }
} 

if (isset($_GET['show']) && isset($_SESSION['schedule']) && !(isset($_POST['day']) || isset($_POST['room']) || isset($_POST['group']) || isset($_POST['predmet']) || isset($_POST['teacher']))) {
    $schedule =  unserialize($_SESSION['schedule']);
    $pdfData = '<div class="rozvrh col-lg-12">'.$schedule->getScheduleTable(true).'</div>';
    echo $pdfData;
    echo '<br /><div class="pdflink col-lg-12"><form action="content/exportPdf.php" method="post"><input type="hidden" name="tabulka" value="'.  utf8_encode(htmlentities($pdfData)).'" /><input class="btn btn-primary" type="submit" name="submit" value="'.$lang['GENERATE_PDF'].'" /></form></div>';
}

if (isset($_POST['year'])){

    $db->setActiveYearFromDbYearId($originalYearID);
    //echo "Need to restore year back to ".$originalYearID ;
}

?>