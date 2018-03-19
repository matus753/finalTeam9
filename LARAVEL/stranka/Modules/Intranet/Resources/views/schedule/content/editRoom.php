<?php
 if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
     
     if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    $pom=$db->getRoom($id);
    $room = $pom[0];
        
    if(isset($_GET['post'])){
    
    if(isset($_POST['name'])){
    
    
    $room->setRoom($_POST['name']);
    
    //var_dump($room);
    
    $db->updateRoom($room);
    
    header("Location: index.php?showRooms");
    
    }
    
 }
 }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?editRoom&AMP;id=<?php echo $id ?>&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['SCHEDULE_ROOM_EDIT']; ?></legend>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['ROOM_ADD_NAME']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="name" value="<?php echo $room->getRoom(); ?>" id="name" placeholder="Meno">
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-default" href="index.php?showRooms"><?php echo $lang['BUTTON_CANCEL']; ?></a>
                      <button type="submit" class="btn btn-primary"><?php echo $lang['BUTTON_EDIT']; ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
<?php } ?>