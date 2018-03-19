<?php
 if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['id'])){
    $id=$_GET['id'];

    $oddelenie = $db->getGroup();
    $persontype = $db->getPersonType();
    //var_dump($persontype);
    
    //var_dump($oddelenie);
   
    $pom=$db->getPerson($id);
    $person = $pom[0];

    //var_dump($persontype);
    
    if(isset($_GET['post'])){
    
    if(isset($_POST['name'])){
        
        
        
        $person->setName($_POST['name']);
        $person->setSurname($_POST['surname']);
        $person->setActive($_POST['active']);
        $person->setLdap($_POST['ldap']);
        if(isset($_POST['gmail']))$person->setGoogle($_POST['gmail']);
        $person->setIdGroup($_POST['oddelenie']);
        $person->setPerson_type($_POST['type']);
        $person->setTitle1($_POST['titulyPred']);
        $person->setTitle2($_POST['titulyZa']);
        
        var_dump($person);
        
        $db->updatePerson($person);
    
        header("Location: index.php?showPersons");
        
    }
    }
    }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" method="POST" action="index.php?editPerson&AMP;id=<?php echo $id ?>&AMP;post">
                <fieldset>
                  <legend><?php echo $lang['SCHEDULE_PERSON_EDIT']; ?></legend>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_NAME']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" value="<?php echo $person->getName();?>" name="name" placeholder="<?php echo $lang['USER_NAME']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_SURNAME']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" value="<?php echo $person->getSurname();?>" name="surname" placeholder="<?php echo $lang['USER_SURNAME']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_DEGREE_BEFORE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" value="<?php echo $person->getTitle1();?>" name="titulyPred" placeholder="<?php echo $lang['USER_DEGREE_BEFORE']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_DEGREE_AFTER']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" value="<?php echo $person->getTitle2();?>" name="titulyZa" placeholder="<?php echo $lang['USER_DEGREE_AFTER']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['USER_DEPARTMENT']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" name="oddelenie">
                          <?php
                          var_dump($oddelenie);
                          foreach ($oddelenie as $value) {
                              
                              if($value->getIdGroups()==$person->getIdGroup()) 
                                echo '<option selected value="'.$value->getIdGroups().'">'.$value->getName().'</option>';
                              else 
                               echo '<option value="'.$value->getIdGroups().'">'.$value->getName().'</option>';
                                  
                          }
                          ?>
                        
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['USER_ACTIVE']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" name="active">
                          <?php
                          if($person->getActive() == 1){
                          	echo '<option selected="selected" value="1">'.$lang['YES'].'</option>';
                          	echo '<option value="0">'.$lang['NO'].'</option>';
                          } else {
                          	echo '<option selected="selected" value="0">'.$lang['NO'].'</option>';
                          	echo '<option value="1">'.$lang['YES'].'</option>';
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['USER_TYPE']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select" name="type">
                        <?php
                          foreach ($persontype as $value) {
                          if($value->id==$person->getPerson_type())
                              echo '<option selected value="'.$value->id.'">'.$value->rola.'</option>';
                          else
                              echo '<option value="'.$value->id.'">'.$value->rola.'</option>';
                          }
                          ?>
                        
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">LDAP</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" value="<?php echo $person->getLdap();?>" name="ldap" placeholder="LDAP" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Gmail</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" value="<?php echo $person->getGoogle();?>" name="gmail" placeholder="Gmail">
                    </div>
                  </div>
                  
                                  
                  
                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <a class="btn btn-default" href="index.php?showPersons"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>