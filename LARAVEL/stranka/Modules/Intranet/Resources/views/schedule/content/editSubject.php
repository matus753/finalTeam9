  <?php
 if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $pom=$db->getSubject($id);
    $subject = $pom[0];
    //var_dump($subject);
    $term = array("zimný","letný");
    $term_en = array("winter","summer");
    $term2 = array("W","S");
     
    //var_dump($subject);
    if(isset($_GET['post'])){
    if(isset($_POST['name']) ){
        
        
        
        $subject->setAcronym(($_POST['acronym']));
        $subject->setName(($_POST['name']));
        $subject->setCode(($_POST['code']));
        $subject->setLectureDuration(($_POST['lectureDuration']));
        $subject->setExceriseDuration(($_POST['exerciseDuration']));
        $subject->setColor(($_POST['color']));
        $subject->setTerm(($_POST['semester']));
        $subject->setYear(($_POST['year']));
        
        var_dump($subject);
        $db->updateSubject($subject);
    
        header("Location: index.php?showSubjects");
        
    }
    
    }
    }

?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?editSubject&AMP;id=<?php echo $id; ?>&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['SCHEDULE_SUBJECT_EDIT'];?></legend>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_CODE'];?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="code" value="<?php echo $subject->getCode();?>" id="code" placeholder="Kód predmetu">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['TITLE'];?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="name" value="<?php echo $subject->getName();?>" placeholder="Názov predmetu">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_ABB'];?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="acronym" value="<?php echo $subject->getAcronym();?>" placeholder="Skratka názvu predmetu">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_DURATION_LECTURE'];?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="lectureDuration" value="<?php echo $subject->getLectureDuration();?>" placeholder="Dĺžka prednášky (v hodinách)">
                    </div>
                  </div>
                  
                                    
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_DURATION_EXERCISE'];?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="exerciseDuration" value="<?php echo $subject->getExceriseDuration();?>" placeholder="Dĺžka cvičenia (v hodinách)">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_COLOR'];?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="color" value="<?php echo $subject->getColor();?>" placeholder="Zadaj farbu v hexakóde napr. #FFE123">
                    </div>
                  </div>
               
                  <div class="form-group" id="yearSelectForm">
		            <label for="year" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
		            <div class="col-lg-10">
		                <select class="form-control" id="selectYear" name="year" required>
		                    <option selected disabled></option>
		                    <?php
		                    foreach ($db->getYear() as $value) {
		                    	if($value->getId() == $subject->getYear())
		                    		echo '<option selected value="'.$value->getId().'">'.$value->getYear().'</option>';
		                    	else
		                        	echo '<option value="'.$value->getId().'">'.$value->getYear().'</option>';
		                    }
		                    ?>
		                </select>
		            </div>
		        </div>
                     
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Semester</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="semester">
                        <?php
                        $i=1;
                          foreach ($term2 as $val) {
                              if ($_SESSION['lang']=='sk') {


                              if($val==$subject->getTerm())
                                echo '<option selected value="'.$val.'">'.$term[$i++-1].'</option>';
                              else
                                echo '<option value="'.$val.'">'.$term[$i++-1].'</option>';
                          }
                          else {
                            if($val==$subject->getTerm())
                                echo '<option selected value="'.$val.'">'.$term_en[$i++-1].'</option>';
                              else
                                echo '<option value="'.$val.'">'.$term_en[$i++-1].'</option>';
                          }
                          }
                          ?>                      
                      </select>
                      
                    </div>
                  </div>
                  

                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php?showSubject"><?php echo $lang['BUTTON_CANCEL'];?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT'];?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>
