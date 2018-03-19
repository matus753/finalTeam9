<?php
if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) )) {
    $predmety = $db->getSubject();
    $vyucujuci = $db->getPerson();
    $druh = $db->getLectureType();
    $miestnost = $db->getRoom();        
    $persontype = $db->getPersonType();
    //var_dump($vyucujuci);
    if(isset($_GET['post'])){
    if(isset($_POST['time']) && isset($_POST['person'])){
        
        $consultation = new Consultation();
        
        $consultation->setPerson_id($_POST['person']);
        
        $consultation->setDay($_POST['day']);
        $consultation->setNote($_POST['note']);
        $consultation->setDuration($_POST['duration']);
        $consultation->setStart_time($_POST['time']);
        
        
        
        //var_dump($consultation);
        $db->insertConsultation($consultation);
    
        header("Location: index.php");
        
    }
    }

?>


<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?addConsultation&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_CONSULTATION']; ?></legend>
                  
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TEACHER']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="person">
                        <?php
                          foreach ($vyucujuci as $value) {
                              echo '<option value="'.$value->getId().'">'.$value->getName().' '.$value->getSurname().'</option>';
                          }
                          ?>                           
                      </select>
                      
                    </div>
                  </div>
                  
                                   
                                    
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TIME_BEGIN']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="time"  placeholder="<?php echo $lang['SCHEDULE_TIME_BEGIN']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['DURATION']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="duration"  placeholder="<?php echo $lang['DURATION']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DAY']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="day" >
                        <?php 
                        if ($_SESSION['lang']=='sk') {
                          echo '
                        <option value="1">Pondelok</option>
                        <option value="2">Utorok</option> 
                        <option value="3">Streda</option>
                        <option value="4">Štvrtok</option>  
                        <option value="5">Piatok</option>  
                        ';
                        }
                        else {
                          echo '
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option> 
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>  
                        <option value="5">Friday</option>  
                        ';
                        }
                        ?>            
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label"><?php echo $lang['NOTE']; ?></label>
                    <div class="col-lg-10">
                      <textarea class="form-control" name="note" rows="3" id="textArea"></textarea>
                      
                    </div>
                  </div>
                  
                  
                  

                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_ADD']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>


<?php
if (isset($_SESSION['user_name']) && (isset($_SESSION['teacher_id']) )) {
    $predmety = $db->getSubject();
    $vyucujuci = $db->getPerson();
    $druh = $db->getLectureType();
    $miestnost = $db->getRoom();        
    $persontype = $db->getPersonType();
    //var_dump($vyucujuci);
    if(isset($_GET['post'])){
    if(isset($_POST['time'])){
        
        $consultation = new Consultation();
        
        $consultation->setPerson_id($_SESSION['teacher_id']);
        
        $consultation->setDay($_POST['day']);
        $consultation->setNote($_POST['note']);
        $consultation->setDuration($_POST['duration']);
        $consultation->setStart_time($_POST['time']);
        
        $db->insertConsultation($consultation);
    
        header("Location: index.php");
        
    }
    }

?>


<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?addConsultation&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_CONSULTATION']; ?></legend>
                  
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TEACHER']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="person">
                        <?php
                          foreach ($vyucujuci as $value) {
                              echo '<option value="'.$value->getId().'">'.$value->getName().' '.$value->getSurname().'</option>';
                          }
                          ?>                           
                      </select>
                      
                    </div>
                  </div>
                  
                                   
                                    
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TIME_BEGIN']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="time"  placeholder="<?php echo $lang['SCHEDULE_TIME_BEGIN']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['DURATION']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="duration"  placeholder="<?php echo $lang['DURATION']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_DAY']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="day" >
                        <?php 
                        if ($_SESSION['lang']=='sk') {
                          echo '
                        <option value="1">Pondelok</option>
                        <option value="2">Utorok</option> 
                        <option value="3">Streda</option>
                        <option value="4">Štvrtok</option>  
                        <option value="5">Piatok</option>  
                        ';
                        }
                        else {
                          echo '
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option> 
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>  
                        <option value="5">Friday</option>  
                        ';
                        }
                        ?>            
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label"><?php echo $lang['NOTE']; ?></label>
                    <div class="col-lg-10">
                      <textarea class="form-control" name="note" rows="3" id="textArea"></textarea>
                      
                    </div>
                  </div>
                  
                  
                  

                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_ADD']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>