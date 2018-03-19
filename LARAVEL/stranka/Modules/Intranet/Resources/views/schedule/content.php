<?php
	if (isset($_GET['login'])) {
		include 'content/login.php';
	}
	else if (isset($_GET['team'])) {
		include 'content/team.php';
	}
	else if (isset($_GET['schedule'])) {
		include 'content/schedule.php';
	}
        else if (isset($_GET['addSchedule'])) {
		include 'content/addSchedule.php';
	}
        else if (isset($_GET['addPerson'])) {
		include 'content/addPerson.php';
	}
        else if (isset($_GET['addRoom'])) {
		include 'content/addRoom.php';
	}
        else if (isset($_GET['addSubject'])) {
		include 'content/addSubject.php';
	}
        else if (isset($_GET['addYear'])) {
		include 'content/addYear.php';
	}
        else if (isset($_GET['addLecture'])) {
		include 'content/addLecture.php';
	}
        else if (isset($_GET['addConsultation'])) {
		include 'content/addConsultation.php';
	}
        else if (isset($_GET['editLecture'])) {
		include 'content/editLecture.php';
	}
        else if (isset($_GET['editRoom'])) {
		include 'content/editRoom.php';
	}
        else if (isset($_GET['editPerson'])) {
		include 'content/editPerson.php';
	}
        else if (isset($_GET['editSubject'])) {
		include 'content/editSubject.php';
	}
        else if (isset($_GET['editConsultation'])) {
		include 'content/editConsultation.php';
	}
        else if (isset($_GET['editStudentsLecture'])) {
		include 'content/editStudentsLecture.php';
	}
        else if (isset($_GET['showRooms'])) {
		include 'content/showRooms.php';
	}
        else if (isset($_GET['showPersons'])) {
		include 'content/showPersons.php';
	}
        else if (isset($_GET['showPersonsU'])) {
		include 'content/showPersonsU.php';
	}
        else if (isset($_GET['showPersonDetail'])) {
		include 'content/showPersonDetail.php';
	}
        else if (isset($_GET['showSubjects'])) {
		include 'content/showSubjects.php';
	}
        else if (isset($_GET['showLectures'])) {
		include 'content/showLectures.php';
	}
        else if (isset($_GET['showConsultations'])) {
		include 'content/showConsultations.php';
	}
		else if (isset($_GET['editSchedule'])) {
		include 'content/editSchedule.php';
	}
        else if (isset($_GET['eraseRoom'])) {
		include 'content/eraseRoom.php';
	}
        else if (isset($_GET['erasePerson'])) {
		include 'content/erasePerson.php';
	}
        else if (isset($_GET['eraseSubject'])) {
		include 'content/eraseSubject.php';
	}
        else if (isset($_GET['eraseLecture'])) {
		include 'content/eraseLecture.php';
	}
        else if (isset($_GET['eraseConsultation'])) {
		include 'content/eraseConsultation.php';
	}
        else if (isset($_GET['manual'])) {
		include 'content/manual.php';
	}
        else if (isset($_GET['user'])) {
		include 'content/user.php';
	}
        else if (isset($_GET['checkLectures'])) {
		include 'content/checkLectures.php';
	}
        else if (isset($_GET['tasks'])) {
		include 'content/tasks.php';
	}
	else {
            
		 if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) || isset($_SESSION['teacher_id'])))  include 'content/showPersonsU.php';
                 else include 'content/home.php';
	}
?>