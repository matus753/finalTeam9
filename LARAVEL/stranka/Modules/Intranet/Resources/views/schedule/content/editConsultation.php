<?php
if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) || isset($_SESSION['teacher_id']))) {
     if(isset($_GET['id'])){
    $id=$_GET['id'];

    $vyucujuci = $db->getPerson();
    $druh = $db->getLectureType();
    $miestnost = $db->getRoom();     
    $dni = array("Pondelok","Utorok","Streda","Štvrtok","Piatok");
    $dni_en = array("Monday","Tuesday","Wednesday","Thursday","Friday");
    
    $pom=$db->getConsultation($id);
    $consult=$pom[0];
    //var_dump($consult);
    if(isset($_GET['edit'])){
    if(isset($_POST['time']) ){
        
        
        
        
        $consult->setDay($_POST['day']);
        $consult->setNote($_POST['note']);
        $consult->setDuration($_POST['duration']);
        $consult->setStart_time($_POST['time']);
        
        
        $schedule =  unserialize($_SESSION['schedule']);

        $schedule2 = new Schedule();
        $consultations = $schedule->getConsultations();

        foreach ($consultations as $key=>$value) {
          if($value->getId() == $consult->getId()){
            unset($consultations[$key]);
          }
        }
        
        array_push($consultations,$consult);
        $schedule2->setCourses($schedule->getLectures(), $db->getLastYearId());
        $schedule2->setConsultations($consultations);
        $schedule2->addVoidDays();
        //var_dump($lecture);
        $db->updateConsultation($consult);
        $_SESSION['schedule'] = serialize($schedule2);
        //var_dump($lecture);
        header("Location: index.php?schedule&show&".$_SESSION["page"]);
        
    }
    }
     }

?>


<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?editConsultation&AMP;id=<?php echo $id; ?>&AMP;edit" method="POST">
                <fieldset>
                  <legend><?php echo $lang['CONSULT_EDIT']; ?></legend>
                  
                  
           
                                   
                  
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TIME_BEGIN']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="time" value="<?php echo $consult->getStart_time();?>" placeholder="<?php echo $lang['SCHEDULE_TIME_BEGIN']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['CONSULT_DUR']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="duration" value="<?php echo $consult->getDuration();?>" placeholder="<?php echo $lang['CONSULT_DUR']; ?>" required>
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DAY']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="day" >
                        <?php
                        $i=1;
                          if ($_SESSION['lang']=='sk') {
                            foreach ($dni as $val) {
                              if($val==$consult->getDay("sk"))
                                echo '<option selected value="'.$i++.'">'.$val.'</option>';
                              else
                                echo '<option value="'.$i++.'">'.$val.'</option>';
                          }
                          }
                          else {
                            foreach ($dni_en as $val) {
                              if($val==$consult->getDay("sk"))
                                echo '<option selected value="'.$i++.'">'.$val.'</option>';
                              else
                                echo '<option value="'.$i++.'">'.$val.'</option>';
                          }
                          }
                          ?>             
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label"><?php echo $lang['NOTE']; ?></label>
                    <div class="col-lg-10">
                      <textarea class="form-control" rows="3" name="note" id="textArea"><?php echo $consult->getNote();?></textarea>
                      
                    </div>
                  </div>
                  
                  
                  

                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php?schedule&AMP;show&AMP;<?php echo $_SESSION['page'] ?>"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>


