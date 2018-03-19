<?php

require_once 'config.php';

if (isset($_POST['lectureId'])) {
	if($_POST['lectureId'] != "none"){
		$db = new DbManager();
	    $db->deleteLecture($_POST['lectureId']);
	}
	
}

if(isset($_POST['sort'])){
	session_start();
	$_SESSION['sort'] = $_POST['sort'];
}

?>