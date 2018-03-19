<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['id'])){
    $id=$_GET['id'];

    $pom=$db->getPerson($id);   
    $person = $pom[0];

    //var_dump($persontype);
    
    if(isset($_GET['erase'])){
       
        $db->deletePerson($id);
    
        header("Location: index.php?showPersons");
  
    }
    }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?erasePerson&AMP;id=<?php echo $id ?>&AMP;erase" method="POST">
                <fieldset>
                  <legend><?php echo $lang['DELETE_PERSON']; ?></legend>
                  
                  
                  
                  <div class="bs-component">
              <div class="jumbotron">
                <h2><?php echo $lang['DELETE_PERSON_Q']; ?></h2>
                <p><?php echo $person->getName();?> <?php echo $person->getSurname();?></p>
             
              </div>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
                  
                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-7">
                        <a class="btn btn-default" href="index.php?showPersons"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_DELETE']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>


<?php } ?>