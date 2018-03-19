<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
	if(isset($_GET['post'])){
		if(isset($_POST['year'])){

			$year = new Year();

			$year->setYear(($_POST['year']));

			$db->insertYear($year);

			header("Location: index.php");

		}
	}

	?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?addYear&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_YEAR']; ?></legend>
                  
                  <div class="form-group" id="yearSelectForm">
		            <label for="year" class="col-lg-2 control-label"><?php echo $lang['YEAR']; ?></label>
		            <div class="col-lg-10">
		            	<input type="text" class="form-control" name="year"  placeholder="2014/2015">
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
