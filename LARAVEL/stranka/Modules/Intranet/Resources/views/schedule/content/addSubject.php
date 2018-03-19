<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['post'])){
    if(isset($_POST['name']) && isset($_POST['code']) && isset($_POST['acronym'])){
        
        $subject = new Subject();
        
        $subject->setAcronym(($_POST['acronym']));
        $subject->setName(($_POST['name']));
        $subject->setCode(($_POST['code']));
        $subject->setLectureDuration(($_POST['lectureDuration']));
        $subject->setExceriseDuration(($_POST['exerciseDuration']));
        $subject->setColor(($_POST['color']));
        $subject->setTerm(($_POST['semester']));
        $subject->setYear(($_POST['year']));
        
        
        $db->insertSubject($subject);
    
        header("Location: index.php");
        
    }
    }

?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?addSubject&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_SUBJECT']; ?></legend>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_CODE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="code" id="code" placeholder="<?php echo $lang['SUBJECT_CODE']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['TITLE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="name" placeholder="<?php echo $lang['SUBJECT_NAME']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_ABB']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="acronym" placeholder="<?php echo $lang['SUBJECT_ABB']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_DURATION_LECTURE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="lectureDuration" placeholder="<?php echo $lang['SUBJECT_DURATION_LECTURE']; ?>">
                    </div>
                  </div>
                  
                                    
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_DURATION_EXERCISE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="exerciseDuration" placeholder="<?php echo $lang['SUBJECT_DURATION_EXERCISE']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['SUBJECT_COLOR']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="color"  placeholder="#FFE123">
                    </div>
                  </div>
                  
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
		        
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Semester</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="semester">
                        <?php 
                        if ($_SESSION['lang']=='sk') {
                          echo '
                          <option value="W">zimný</option>
                        <option value="S">letný</option>
                          ';
                        }
                        else {
                          echo '
                          <option value="W">winter</option>
                        <option value="S">summer</option> 
                          ';
                        }
                        ?>                       
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
