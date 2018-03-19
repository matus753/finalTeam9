<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['id'])){
    $id=$_GET['id'];

    $vyucujuci = $db->getPerson();
    $druhy = $db->getLectureType();
    $miestnosti = $db->getRoom();        
    $persontype = $db->getPersonType();
    
    $dni = array("Pondelok","Utorok","Streda","Štvrtok","Piatok");
    $dni_en = array("Monday","Tuesday","Wednesday","Thursday","Friday");
    
    $lectures = $db->getLecturesBySubject(array($id));
/*
    echo '<pre>';
    var_dump($lectures);
    echo '</pre>';
*/

/*
    $vyucuje = $lecture->getPerson();
    $druh = $lecture->getType_id();
    $miestnost = $lecture->getRoom();
    $time = $lecture->getStart_time();
    $day = $lecture->getDay();
*/
    //var_dump($vyucujuci);
    
    //echo $lecture->getType_id();
      if(isset($_GET['post'])){
        if(isset($_POST['save']) /*&& isset($_POST['person'])*/){

          $count = 0;
          foreach ($lectures as $lecture) {
            $lecture->setPerson_id(intval($_POST['person'][$count]));
            $lecture->setRoom_id(intval($_POST['room'][$count]));
            
            $lecture->setType_id(intval($_POST['classtype'][$count]));
            $lecture->setDay(intval($_POST['day'][$count]));
            $lecture->setStart_time($_POST['time'][$count]);
            $db->updateLecture($lecture);
            $count++;
          }

          for ($i=$count; $i < count($_POST['person']); $i++) {
            $lecture = new Lecture();
            $lecture->setPerson_id(intval($_POST['person'][$count]));
            $lecture->setSubject_id(intval($id));
            $lecture->setRoom_id(intval($_POST['room'][$count]));
            $lecture->setType_id(intval($_POST['classtype'][$count]));
            $lecture->setDay(intval($_POST['day'][$count]));
            $lecture->setStart_time($_POST['time'][$count]);
            $db->insertLecture($lecture);
            $count++;
          }
          
          //var_dump($lecture);
          //$db->updateLecture($lecture);
          //var_dump($lecture);
          header("Location: index.php?editSchedule&id=".$id);
        }else if(isset($_POST['add_button']) && isset($_POST['add_lecture'])){

          $lect = new Lecture();
          $lect->setSubject_id($id);

          for ($i=0; $i < $_POST['add_lecture']; $i++) { 
            array_push($lectures, $lect);
          }
        }
      } 
    }

?>


<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?editSchedule&AMP;id=<?php echo $id; ?>&AMP;post" method="POST">
                
                  
                <?php
                  $counter = 0;
                  foreach ($lectures as $lecture) {
                    ?>
                      <fieldset id="lecture_<?php echo $counter; ?>">
                        <legend><?php echo $lang['SCHEDULE_EDIT_CLASS']; ?></legend>

                        <div class="form-group">
                          <label for="select" class="col-lg-2 control-label"><?php echo $lang['SCHEDULE_TEACHER']; ?></label>
                          <div class="col-lg-10">
                            <select class="form-control" name="person[]">
                              <?php
                                foreach ($vyucujuci as $value) {
                                    if( ($lecture->getPerson()) && $value->getId()==$lecture->getPerson()->getId())
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
                            <select class="form-control" id="select" name="classtype[]">
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
                            <select class="form-control" id="select" name="room[]">
                                
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
                            <select class="form-control" name="time[]" required>
                              <?php
                              
                                for ($i=7; $i <= 19; $i++) { 
                                  if(str_pad($i, 2, '0', STR_PAD_LEFT).':00:00'==$lecture->getStart_time())
                                      echo '<option selected value="'.$i.':00:00'.'">'.$i.':00'.'</option>'; //dve miesta
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
                            <select class="form-control" id="select" name="day[]">
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
                           <button type="button" id="erase_<?php echo  $counter; ?>" class="btn btn-danger"><?php echo $lang['BUTTON_DELETE']; ?></button>
                            
                          </div>
                        </div>

                        <script type="text/javascript">
                          $(document).ready(function(){
                            $('#erase_<?php echo $counter; ?>').click(function(){
                                console.log("button pressed");
                                //var clickBtnValue = $(this).val();
                                //var ajaxurl = 'ajax.php',
                                data =  {'lectureId': <?php echo  $lecture->getId() ? $lecture->getId() : '"none"'; ?>};

                                $.post("ajax.php", data, function (response) {
                                    // Response div goes here.
                                    //alert("action performed successfully: " + response);
                                    $("#lecture_<?php echo $counter; ?>").remove();
                                    if(<?php echo ($lecture->getId() ? "false" : "true");?>){
                                      var options = $('#selectNewLectures option').each(function(){
                                          console.log($(this));
                                          $(this).val($(this).val()-1);
                                      });
                                    }
                                });
                                return false;
                            });
                            
                          });
                        </script>


                      </fieldset>
                    <?php
                    $counter++;
                }
                ?>           

                <div class="form-group">

                    <div class="col-md-4 col-lg-offset-2">
                      <select class="form-control" id="selectNewLectures" name="add_lecture">
                        <?php
                          for ($i=1; $i < 6; $i++) { 
                            echo '<option value='.intval($i + (isset($_POST['add_button']) ? $_POST['add_lecture'] : 0 )).'>'.$i.'</option>';
                          }
                        ?>           
                      </select>
                    </div>
                    <div class="col-md-1">
                      <button type="submit" name="add_button" class="btn"><?php echo $lang['SCHEDULE_ADD_CLASSES']; ?></button>
                    </div>
                  
                </div>
                  
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                      <a class="btn btn-default" href="index.php"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                    <button type="submit" name="save" class="btn btn-primary"><?php echo $lang['BUTTON_SAVE']; ?></button>
                  </div>
                </div>
                
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>
