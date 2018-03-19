<!DOCTYPE html>
<?php
error_reporting(E_ALL);
session_start();
ob_start();

if(!isset($_SESSION['sort'])){
  $_SESSION['sort'] = 'way_asc';
}
//

if (isset($_GET['en'])) {
  $_SESSION['lang'] = 'en';
}
elseif ( isset($_GET['sk']) || (!isset($_SESSION['lang'])) ) {
  $_SESSION['lang'] = 'sk';
}
include_once 'langs/'.$_SESSION['lang'].'.php';

require_once 'config.php';
$db = new DbManager();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $lang['SITE_TITLE']; ?></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet"/>
    <link href="css/jquery-ui.theme.css" rel="stylesheet"/>
    <link href="css/jquery-ui.structure.css" rel="stylesheet"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://code.jquery.com/jquery-1.7.2.js"></script>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/script.js"></script>
    <script src="js/sort_sk_cz.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/html2csv.js" ></script>
    <script type="text/javascript" src="libs/tableSort/jquery.tablesorter.js"></script> 
  </head>
  <body>
      <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand"><?php echo $lang['MENU_HEADER_TITLE']; ?></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><?php echo $lang['MENU_SCHEDULES']; ?><span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="index.php?schedule&amp;subject"><?php echo $lang['MENU_SCHEDULE_SUBJECT']; ?></a></li>
                <li><a href="index.php?schedule&amp;teacher"><?php echo $lang['MENU_SCHEDULE_TEACHER']; ?></a></li>
                <li><a href="index.php?schedule&amp;room"><?php echo $lang['MENU_SCHEDULE_ROOM']; ?></a></li>
                <li><a href="index.php?schedule&amp;day"><?php echo $lang['MENU_SCHEDULE_DAY']; ?></a></li>
                <li><a href="index.php?schedule&amp;group"><?php echo $lang['MENU_SCHEDULE_DEPARTMENT']; ?></a></li>
                <?php 
                    if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
                ?>
                <li><a href="index.php?checkLectures"><?php echo $lang['MENU_SCHEDULE_CHECK']; ?></a></li>
                <?php
                    }
                ?>
              </ul>
            </li>
            <?php 
                if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
            ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><?php echo $lang['MENU_SHOW']; ?><span class="caret"></span></a>
             <ul class="dropdown-menu" aria-labelledby="themes">
               <li><a href="index.php?showLectures"><?php echo $lang['MENU_SHOW_LECTURES']; ?></a></li>
                <li><a href="index.php?showRooms"><?php echo $lang['MENU_SHOW_ROOMS']; ?></a></li>
                <li><a href="index.php?showPersons"><?php echo $lang['MENU_SHOW_PERSONS']; ?></a></li>
                <li><a href="index.php?showSubjects"><?php echo $lang['MENU_SHOW_SUBJECTS']; ?></a></li>
                <li><a href="index.php?showConsultations"><?php echo $lang['MENU_SHOW_CONSULTATIONS']; ?></a></li>
                <li><a href="index.php?showSchedules"><?php echo $lang['MENU_SHOW_SCHEDULES']; ?></a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><?php echo $lang['MENU_ADD']; ?><span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="index.php?addSchedule"><?php echo $lang['MENU_ADD_SCHEDULE']; ?></a></li>
                <li><a href="index.php?addPerson"><?php echo $lang['MENU_ADD_PERSON']; ?></a></li>
                <li><a href="index.php?addRoom"><?php echo $lang['MENU_ADD_ROOM']; ?></a></li>
                <li><a href="index.php?addSubject"><?php echo $lang['MENU_ADD_SUBJECT']; ?></a></li>
                <li><a href="index.php?addLecture"><?php echo $lang['MENU_ADD_LECTURE']; ?></a></li>
                <li><a href="index.php?addYear"><?php echo $lang['MENU_ADD_YEAR']; ?></a></li>
                <li><a href="index.php?addConsultation"><?php echo $lang['MENU_ADD_CONSULTATION']; ?></a></li>
              </ul>
            </li>
            <!--
            <li>
              <a href="index.php?tasks">Akcie</a>
            </li>
            -->
            <?php
                }
            ?>
            
            <?php 
            if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) || isset($_SESSION['teacher_id'])))
            {
            ?>
            <!--
            <li>
              <a href="index.php?manual">Návod</a>
            </li>
            -->
                <?php }?>
            <!--    
            <li>
              <a href="index.php?team">Team</a>
            </li>
            -->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <?php 
                if (isset($_SESSION['user_name'])) {
            ?>
              <li><a href="index.php?user"><img class="userpic" src="images/user.png" width="24px"><?php echo $_SESSION['user_name'];?></a></li>
              <li><a href="index.php?login&off"><?php echo $lang['MENU_LOG_OUT']; ?></a></li>
            <?php }
                else {
            ?>
              <li><a href="index.php?login"><?php echo $lang['MENU_LOG_IN']; ?></a></li>
            <?php
                }
                $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
                $host     = $_SERVER['HTTP_HOST'];
                $script   = $_SERVER['SCRIPT_NAME'];
                $params   = $_SERVER['QUERY_STRING'];
                $params = str_replace( "&en", "", $params );
                $params = str_replace( "&sk", "", $params );
                $link = $protocol . '://' . $host . $script . '?' . $params;
            ?>
            <li><a href="<?php echo $link ?>&sk"><img src="images/sk_flag.gif" width="18px"></a></li>
            <li><a href="<?php echo $link ?>&en"><img src="images/en_flag.gif" width="20px"></a></li>
          </ul>

        </div>
      </div>
    </div>
	<div class="container">
		
		<div class="row">
		<div class="col-lg-12">
                    <?php
                    include('content.php');
//                    $sc = $db->getConsultation(1);
//                    echo "<pre>";
//                    var_dump($sc);
//                    echo "</pre>";
                    //echo $sc->getScheduleTable();
                    /*$room = new Room();
                    $room->setRoom("AB72");
                    $db->insertRoom($room);*/
                    ?>
		</div>		
		</div>  
	<footer>
        <div class="row">
          <div class="col-lg-12">
          <!--
                     <p>&copy; Team 9 2014</p>
                     -->
          </div>
        </div>
      </footer>
      </div>
  </body>
</html>
