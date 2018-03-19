<?php 
if (isset($_SESSION['user_name']) && (isset($_SESSION['teacher_id']) || isset($_SESSION['admin_id']))) {
    $pom=$db->getPersonByLdap($_SESSION['user_name']);
    $user = $pom[0];
    
    if (isset($_GET['editInfo'])) {
        if (isset($_POST['ldap'])) {
            $user->setName($_POST['name']);
            $user->setSurname($_POST['surname']);
            $user->setLdap($_POST['ldap']);
            $user->setIdGroup($_POST['oddelenie']);
            $user->setTitle1($_POST['titulyPred']);
            $user->setTitle2($_POST['titulyZa']);
            $user->setActive($_POST['aktivita']);
            $user->setGoogle($_POST['gmail']);
            
            $db->updatePerson($user);
            
            $_SESSION['user_name'] = $_POST['ldap'];
            if ($_POST['type']==1) {
                if (!isset($_SESSION['teacher_id'])) {
                    $_SESSION['teacher_id'] = $user->getId();
                }
                if (isset($_SESSION['admin_id'])) {
                    unset($_SESSION['admin_id']);
                }
            }
            else if ($_POST['type']==2) {
                if (!isset($_SESSION['admin_id'])) {
                    $_SESSION['admin_id'] = $user->getId();
                }
                if (isset($_SESSION['teacher_id'])) {
                    unset($_SESSION['teacher_id']);
                }
            }
            header("Location: index.php");
        }
    }
?>
<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" method="POST" action="index.php?user&editInfo">
                <fieldset>
                  <legend><?php echo $lang['USER_PROFILE']; ?></legend>
                  <div class="form-group">
                    <label for="name" class="col-lg-2 control-label"><?php echo $lang['USER_NAME']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="name" placeholder="Meno" value="<?php echo $user->getName();?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="surname" class="col-lg-2 control-label"><?php echo $lang['USER_SURNAME']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="surname" placeholder="Priezvisko" value="<?php echo $user->getSurname(); ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="titulyPred" class="col-lg-2 control-label"><?php echo $lang['USER_DEGREE_BEFORE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="titulyPred" placeholder="Tituly pred menom" value="<?php echo $user->getTitle1();?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="titulyZa" class="col-lg-2 control-label"><?php echo $lang['USER_DEGREE_AFTER']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="titulyZa" placeholder="Tituly za menom" value="<?php echo $user->getTitle2(); ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="aktivita" class="col-lg-2 control-label"><?php echo $lang['USER_ACTIVE']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" name="aktivita">
                      <?php
                      if($user->getActive() == 1){
                      	echo '<option value="1" selected="selected">Áno</option>
							<option value="0">Nie</option>';
                      } else {
                      	echo '<option value="0" selected="selected">Nie</option>
        					<option value="1">Áno</option>';
                      }
                      ?>
                      </select>
                    </div>
                  </div>  
                                 
                  <div class="form-group">
                    <label for="oddelenie" class="col-lg-2 control-label"><?php echo $lang['USER_DEPARTMENT']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" name="oddelenie">
                          <?php
                          echo '<option disabled '.(($user->getIdGroup()==NULL) ? 'selected="selected"' : '').'></option>';
                          foreach ($db->getGroup() as $value) {
                              echo '<option value="'.$value->getIdGroups().'" '.(($value->getIdGroups()==$user->getIdGroup() )?'selected="selected"':"").'>'.$value->getName().'</option>';
                          }
                          ?>
                        
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="ldap" class="col-lg-2 control-label">LDAP</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="ldap" placeholder="LDAP"  value="<?php echo $user->getLdap();?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="gmail" class="col-lg-2 control-label">Gmail</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="gmail" placeholder="Gmail"  value="<?php echo $user->getGoogle(); ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button class="btn btn-default" href="index.php"><?php echo $lang['BUTTON_CANCEL']; ?></button>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_SAVE']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>