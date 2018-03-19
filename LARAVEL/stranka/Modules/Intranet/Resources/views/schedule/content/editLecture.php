<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    //echo $id;
    
    $predmety = $db->getSubject();
    $vyucujuci = $db->getPerson();
    $druhy = $db->getLectureType();
    $miestnosti = $db->getRoom();        
    $persontype = $db->getPersonType();
    
    
    $dni = array("Pondelok","Utorok","Streda","Štvrtok","Piatok");
    $dni_en = array("Monday","Tuesday","Wednesday","Thursday","Friday");
    
    $pom=$db->getLecture(array($id));
    $lecture = $pom[0];
    $predmet = $lecture->getSubject()->getName();
    
    $vyucuje = $lecture->getPerson();
    $druh = $lecture->getType_id();
    $miestnost = $lecture->getRoom();
    $time = $lecture->getStart_time();
    $day = $lecture->getDay();
    //var_dump($vyucujuci);
    
    //echo $lecture->getType_id();
    if(isset($_GET['post'])){
    if(isset($_POST['time']) && isset($_POST['person'])){
        
        
        
        $lecture->setPerson_id(intval($_POST['person']));
        $lecture->setRoom_id(intval($_POST['room']));
        $lecture->setSubject_id(intval($_POST['predmet']));
        $lecture->setType_id(intval($_POST['classtype']));
        $lecture->setDay(intval($_POST['day']));
        $lecture->setStart_time($_POST['time']);

        $schedule =  unserialize($_SESSION['schedule']);

        $schedule2 = new Schedule();
        $lectures = $schedule->getLectures();

        foreach ($lectures as $key=>$value) {
          if($value->getId() == $lecture->getId()){
            unset($lectures[$key]);
          }
        }
        array_push($lectures,$lecture);
        $schedule2->setCourses($lectures, $db->getLastYearId());
        $schedule2->setConsultations($schedule->getConsultations());
        $schedule2->addVoidDays();
        //var_dump($lecture);
        $db->updateLecture($lecture);
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
                <form class="form-horizontal" action="index.php?editLecture&AMP;id=<?php echo $id; ?>&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['SCHEDULE_EDIT_CLASS']; ?></legend>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_SUBJECT']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="predmet">
                        <?php
                          foreach ($predmety as $value) {
                              if($value->getId()==$lecture->getSubject()->getId())
                                  echo '<option selected value="'.$value->getId().'">'.$value->getName().'</option>';
                              else
                                  echo '<option value="'.$value->getId().'">'.$value->getName().'</option>';
                          }
                          ?>                       
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TEACHER']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="person">
                        <?php
                          foreach ($vyucujuci as $value) {
                              if($value->getId()==$lecture->getPerson()->getId())
                                echo '<option selected value="'.$value->getId().'">'.$value->getName().' '.$value->getSurname().'</option>';
                            else 
                                echo '<option value="'.$value->getId().'">'.$value->getName().' '.$value->getSurname().'</option>';
                            
                          }
                          ?>                           
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_CLASS_TYPE']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="classtype">
                        <?php
                          foreach ($druhy as $value) {
                              if($value->id==$lecture->getType_id())
                                 echo '<option selected value="'.$value->id.'">'.$value->type.'</option>';
                              else
                                  echo '<option value="'.$value->id.'">'.$value->type.'</option>';
                          }
                          ?>                     
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_ROOM']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="room">
                          
                          <?php
                          foreach ($miestnosti as $val) {
                              if($val->getId()==$lecture->getRoom_id())
                                echo '<option selected value="'.$val->getId().'">'.$val->getRoom().'</option>';
                              else
                                  echo '<option value="'.$val->getId().'">'.$val->getRoom().'</option>';
                          }
                          ?>
                                             
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TIME_BEGIN']; ?></label>
                    <div class="col-lg-10">
                      <!--<input type="text" class="form-control" name="time"  placeholder="Zadaj čas začiatku" value="<?php echo $time ?>" required>-->
                      <select class="form-control" name="time" required>
                        <?php
                        
                          for ($i=7; $i <= 19; $i++) { 
                            if($i.':00:00'==$time)
                                echo '<option selected value="'.$i.':00:00'.'">'.$i.':00'.'</option>';
                              else
                                echo '<option value="'.$i.':00:00'.'">'.$i.':00'.'</option>';
                            }
                          ?>              
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DAY']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="day">
                        <?php
                        $i=1;
                          if ($_SESSION['lang']=='sk') {
                                  foreach ($dni as $val) {
                                      if($val==$lecture->getDay('sk'))
                                        echo '<option selected value="'.$i++.'">'.$val.'</option>';
                                      else
                                        echo '<option value="'.$i++.'">'.$val.'</option>';
                                  }
                                }
                                else {
                                  foreach ($dni_en as $val) {
                                    if($val==$lecture->getDay('en'))
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
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php?schedule&AMP;show&AMP;<?php echo $_SESSION['page'] ?>"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SAVE']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>
