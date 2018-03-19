<?php
if (isset($_SESSION['user_name'])) {
	if(isset($_GET['id'])){
		$id=$_GET['id'];

		$pom=$db->getLecture(array($id));
		$lecture = $pom[0];

		if(isset($_GET['post'])){
			if(isset($_POST['students'])){

				$lecture->setStudents(intval($_POST['students']));
				$db->updateLecture($lecture);
				
				header("Location: index.php?showPersonDetail&id=".$lecture->getPerson_id());
			}

		}
	}

	?>


<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?editStudentsLecture&AMP;id=<?php echo $id; ?>&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['EDIT_LECTURE_STUDENTS']; ?> <?php echo $lecture->getSubject()->getName(); ?>
                  </legend>
                  
                 <div class="form-group">
                    <label for="students" class="col-lg-2 control-label"><?php echo $lang['SUMSTUDENTS'];?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="students" value="<?php echo $lecture->getStudents();?>" placeholder="Názov predmetu">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php?showPersonDetail&id=<?php echo $lecture->getPerson_id() ?>"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SAVE']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>
