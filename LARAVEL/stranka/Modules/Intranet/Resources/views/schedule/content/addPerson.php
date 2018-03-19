<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {

    $oddelenie = $db->getGroup();
    $persontype = $db->getPersonType();
    //var_dump($persontype);
    if(isset($_GET['post'])){
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['ldap'])){
        
        $person = new Person();
        
        $person->setName($_POST['name']);
        $person->setSurname($_POST['surname']);
        $person->setActive(1);
        $person->setLdap($_POST['ldap']);
        if(isset($_POST['gmail']))$person->setGoogle($_POST['gmail']);
        $person->setIdGroup($_POST['oddelenie']);
        $person->setPerson_type($_POST['type']);
        $person->setTitle1($_POST['titulyPred']);
        $person->setTitle2($_POST['titulyZa']);
        
        
        
        $db->insertPerson($person);
    
        header("Location: index.php");
        
    }
    }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" method="POST" action="index.php?addPerson&AMP;post">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_PERSON']; ?></legend>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_NAME']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="name" placeholder="<?php echo $lang['USER_NAME']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_SURNAME']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="surname" placeholder="<?php echo $lang['USER_SURNAME']; ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_DEGREE_BEFORE']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="titulyPred" placeholder="<?php echo $lang['USER_DEGREE_BEFORE']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['USER_DEGREE_AFTER']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="titulyZa" placeholder="<?php echo $lang['USER_DEGREE_AFTER']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label"><?php echo $lang['USER_DEPARTMENT']; ?></label>
                    <div class="col-lg-10">
                      <select class="form-control" name="oddelenie">
                          <?php
                          foreach ($oddelenie as $value) {
                              echo '<option value="'.$value->getIdGroups().'">'.$value->getName().'</option>';
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
                              echo '<option value="'.$value->id.'">'.$value->rola.'</option>';
                          }
                          ?>
                        
                      </select>
                      
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">LDAP</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="ldap" placeholder="LDAP" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Gmail</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="gmail" placeholder="Gmail">
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
<?php
    }
?>