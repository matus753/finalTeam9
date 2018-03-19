<?php

if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    //echo $id;
    
    
    
   
    $pom=$db->getLecture(array($id));
    $lecture = $pom[0];
    //var_dump($lecture);
    $predmet = $lecture->getSubject()->getName();
    //var_dump($lecture->getSubject()); $predmety;
    $vyucuje = $lecture->getPerson();
    $druh = $lecture->getType_id();
    $miestnost = $lecture->getRoom();
    $time = $lecture->getStart_time();
    $day = $lecture->getDay("sk");
    //var_dump($vyucujuci);
    
    //echo $lecture->getType_id();
    if(isset($_GET['erase'])){
    
        
        
       
        
        //var_dump($lecture);
        $db->deleteLecture($id);
        //var_dump($lecture);
        header("Location: index.php?showLectures");
        
    
    
    }
    }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?eraseLecture&AMP;id=<?php echo $id ?>&AMP;erase" method="POST">
                <fieldset>
                  <legend><?php echo $lang['SCHEDULE_DELETE_CLASS']; ?></legend>
                  
                  
                  
                  <div class="bs-component">
              <div class="jumbotron">
                <h2><?php echo $lang['SCHEDULE_DELETE_CLASS_Q']; ?></h2>
                <p><?php echo $predmet;?> - <?php echo $day;?> - <?php echo $time;?></p>
             
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

