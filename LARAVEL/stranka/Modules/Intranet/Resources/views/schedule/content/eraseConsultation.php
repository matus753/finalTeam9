<?php
if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) || isset($_SESSION['teacher_id']))){
     
     if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    $pom=$db->getConsultation($id);
    $consult=$pom[0];
    
    if(isset($_GET['erase'])){
    
     
    //var_dump($room);
    
    $db->deleteConsultation($id);
    
    header("Location: index.php?showConsultations");
 
 }
 }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?eraseConsultation&AMP;id=<?php echo $id ?>&AMP;erase" method="POST">
                <fieldset>
                  <legend><?php echo $lang['DELETE_CONS']; ?></legend>
                  
                  
                  
                  <div class="bs-component">
              <div class="jumbotron">
                <h2><?php echo $lang['DELETE_CONS_Q']; ?></h2>
                <p><?php echo $consult->getPerson()->getName().' '.$consult->getPerson()->getSurname().' - '.$consult->getDay("sk").' - '.$consult->getStart_time(); ?></p>
             
              </div>
<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
                  
                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-7">
                        <a class="btn btn-default" href="index.php?showConsultations"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_DELETE']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>

<?php } ?>
