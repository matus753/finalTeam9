<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    $predmety = $db->getSubject();
    $vyucujuci = $db->getPerson();
    $druh = $db->getLectureType();
    $miestnost = $db->getRoom();        
    $persontype = $db->getPersonType();
    //var_dump($vyucujuci);
    if(isset($_GET['post'])){
    if(isset($_POST['time']) && isset($_POST['person'])){
        
        $lecture = new Lecture();
        
        $lecture->setPerson_id($_POST['person']);
        $lecture->setRoom_id($_POST['room']);
        $lecture->setSubject_id($_POST['predmet']);
        $lecture->setType_id($_POST['classtype']);
        $lecture->setDay($_POST['day']);
        $lecture->setStart_time($_POST['time']);
        
        
        //var_dump($lecture);
        $db->insertLecture($lecture);
    
        header("Location: index.php");
        
    }
    }

?>


<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?addLecture&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_LECTURE']; ?></legend>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_SUBJECT']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="predmet">
                        <?php
                          foreach ($predmety as $value) {
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
                          foreach ($druh as $value) {
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
                          foreach ($miestnost as $val) {
                              echo '<option value="'.$val->getId().'">'.$val->getRoom().'</option>';
                          }
                          ?>
                                             
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TIME_BEGIN']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" name="time" required>
                        <?php
                          for ($i=7; $i <= 19; $i++) { 
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
                        <option value="1">Pondelok</option>
                        <option value="2">Utorok</option> 
                        <option value="3">Streda</option>
                        <option value="4">Štvrtok</option>  
                        <option value="5">Piatok</option>              
                      </select>
                      
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
