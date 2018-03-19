<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
 if(isset($_GET['post'])){
    if(isset($_POST['name'])){
    
    $room = new Room();
    $room->setRoom($_POST['name']);
    $db->insertRoom($room);
    
    header("Location: index.php");
    
    }
    
 }

?>

<div class="col-lg-2"></div>
<div class="col-lg-8">
            <div class="well bs-component">
                <form class="form-horizontal" action="index.php?addRoom&AMP;post" method="POST">
                <fieldset>
                  <legend><?php echo $lang['MENU_ADD_ROOM']; ?></legend>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"><?php echo $lang['ROOM_ADD_NAME']; ?></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $lang['NAME']; ?>">
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