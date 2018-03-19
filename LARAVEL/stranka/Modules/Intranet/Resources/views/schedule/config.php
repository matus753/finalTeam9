<?php

require_once 'class/Subject.class.php';
require_once 'class/Lecture.class.php';
require_once 'class/Person.class.php';
require_once 'class/Room.class.php';
require_once 'class/Schedule.class.php';
require_once 'class/Group.class.php';
require_once 'class/Consultation.class.php';
require_once 'class/Year.class.php';


function connectToDb() {
    $host = "localhost";
    $user = "xsalak";
    $pass = "52780536";
    $db_name = "zaver";
    $char_set = "utf8";

    $mysqli = new mysqli($host,$user,$pass,$db_name);
    if ($mysqli->connect_error) {
        die($lang['DB_CONNECT_ERROR'].$mysqli->connect_error);
    }

    $mysqli->set_charset($char_set);

    return $mysqli;
}

function getSelectResult($string){
    $mysqli = connectToDb();
    $result = $mysqli->query($string);
    $mysqli->close();

    return $result;
}

function mysqliQuery($sql, $className=null, $a_param_type=null, $a_bind_params=null, $getInsertId=false){
    $conn = connectToDb();

    $a_params = array();
    $a_data = array();

    $param_type = '';
    $n = count($a_param_type);
    for($i = 0; $i < $n; $i++) {
      $param_type .= $a_param_type[$i];
    }
 
    /* with call_user_func_array, array params must be passed by reference */
    $a_params[] = & $param_type;

    for($i = 0; $i < $n; $i++) {
      /* with call_user_func_array, array params must be passed by reference */
      $a_params[] = & $a_bind_params[$i];
    }

    /* Prepare statement */
    $stmt = $conn->prepare($sql);
    if($stmt === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
    }

    /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */

    if(count($a_bind_params)>0){
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
    }


    /* Execute statement */
    $stmt->execute();
    
    if($getInsertId){
        $insertId = $conn->insert_id;
        $stmt->close();
        $conn->close();
        return $insertId;
    }else{
   
        if ($res = $stmt->get_result()){
            while ($obj= $className ? mysqli_fetch_object($res, $className) : mysqli_fetch_object($res)){
                array_push($a_data, $obj);
            }
            mysqli_free_result($res);
        
        }
        $stmt->close();
        $conn->close();
        return $a_data;

    }  
}

class DbManager {

    private $lectureDurationCoeficient = 3;
    
    function insertSubject($subject){
        mysqliQuery("INSERT INTO subject (code, name, acronym, lectureDuration, exceriseDuration, color, term, year) VALUES (?,?,?,?,?,?,?,?);", null, array("s", "s", "s", "i", "i", "s", "s","i") , $subject->getInsertArray() );
    }
    
    function insertYear($year){
    	mysqliQuery("INSERT INTO year (year) VALUES (?);", null, array("s") , $year->getInsertArray() );
    }
    
    function insertPerson($person){
        mysqliQuery("INSERT INTO person (person_type, title1, name, surname, active, title2, idGroup, ldap, google) VALUES (?,?,?,?,?,?,?,?,?);", null, array("i", "s", "s", "s","i", "s", "i", "s", "s") , $person->getInsertArray() );
    }
    
    function insertLecture($lecture){
        mysqliQuery("INSERT INTO lecture (subject_id, person_id, type_id, room_id, start_time, day) VALUES (?,?,?,?,?,?);", null, array("i", "i", "i", "i", "s", "i") , $lecture->getInsertArray() );
    }
    
    function insertSchedule($schedule){
        $schedId = mysqliQuery("INSERT INTO schedule (creator_id, note) VALUES (?,?);", null, array("i", "s") , $schedule->getInsertArray(), true);
        $lectures = $schedule->getLectures();
        var_dump($schedId);
        foreach ($lectures as $value) {
            mysqliQuery("INSERT INTO schedule_lecture (lecture_id, schedule_id) VALUES (?,?);", null, array("i", "i") , array($value->getId(), $schedId) );
        }
    }
    
    function insertRoom($room){
        mysqliQuery("INSERT INTO room (room) VALUES (?);", null, array("s") , $room->getInsertArray() );
    }
    
    function insertConsultation($consultation){
        mysqliQuery("INSERT INTO consultation (person_id, start_time, day, duration, note) VALUES (?,?,?,?,?);", null, array("i","s","i","d","s") , $consultation->getInsertArray() );
    }
    
    function deleteSubject($subjectId){
        mysqliQuery("Delete from subject where id=?;", null, array("i") , array($subjectId));
    }
    
    function deletePerson($personId){
        mysqliQuery("Delete from person where id=?;", null, array("i") , array($personId));
    }
    
    function deleteLecture($lectureId){
        mysqliQuery("Delete from lecture where id=?;", null, array("i") , array($lectureId));
    }
    
    function deleteRoom($roomId){
        mysqliQuery("Delete from room where id=?;", null, array("i") , array($roomId));
    }
    
    function deleteConsultation($consultationId){
        mysqliQuery("Delete from consultation where id=?;", null, array("i") , array($consultationId));
    }
    
    function updateSubject($subject){
        mysqliQuery("UPDATE subject SET code=?, name=?, acronym=?, lectureDuration=?, exceriseDuration=?, color=?, term=?, year=?, active=? WHERE id=?;", null, array("s", "s", "s", "i", "i", "s", "s", "i", "i", "i") , $subject->getUpdateArray() );
    }
    
    function updatePerson($person){
        mysqliQuery("UPDATE person SET person_type=?, title1=?, name=?, surname=?, active=?, title2=?, idGroup=?, ldap=?, google=? WHERE id=?;", null, array("i", "s", "s", "s","i", "s", "i", "s", "s", "i") , $person->getUpdateArray() );
    }
    
    function updateRoom($room){
        mysqliQuery("UPDATE room SET room=? WHERE id=?;", null, array("s", "i") , $room->getUpdateArray() );
    }
    
    function updateLecture($lecture){
        mysqliQuery("UPDATE lecture SET subject_id=?, person_id=?, type_id=?, room_id=?, start_time=?, day=?, students=? WHERE id=?;", null, array("i", "i", "i", "i", "s", "i", "i", "i") , $lecture->getUpdateArray() );
    }
    
    function updateConsultation($consultation){
        mysqliQuery("UPDATE consultation SET person_id=?, start_time=?, day=?, duration=?, note=? WHERE id=?;", null, array("i", "s", "i", "d", "s", "i") , $consultation->getUpdateArray() );
    }
    
    function getSubject($id = null){
    	$subjects = $id ? mysqliQuery("SELECT subject.*, count( distinct l1.id) as lect_num, count( distinct l2.id) as ex_num FROM subject left join lecture l1 on l1.subject_id=subject.id and l1.type_id=1 left join lecture l2 on l2.subject_id=subject.id and l2.type_id=2 where subject.id=?;", "Subject", array("i"), array($id)) : mysqliQuery("SELECT subject.*, count( distinct l1.id) as lect_num, count( distinct l2.id) as ex_num "
                . "FROM subject left join lecture l1 on l1.subject_id=subject.id and l1.type_id=1 "
                . "left join lecture l2 on l2.subject_id=subject.id and l2.type_id=2 group by subject.id order by subject.name;", "Subject");
        
        foreach ($subjects as $subject) {
        	$pom=$this->getYear($subject->getYear());                   	  //pre php 5.3
        	$subject->setYearObject($pom[0]);                                 //pre php 5.3
        }
        
        return $subjects;
    }
    
    function getSubjectByTerm($term){
       // return mysqliQuery("Select * from subject where term=?;", "Subject", array("s"), array($term));
        return mysqliQuery("SELECT subject.*, count( distinct l1.id) as lect_num, count( distinct l2.id) as ex_num "
                . "FROM subject left join lecture l1 on l1.subject_id=subject.id and l1.type_id=1 "
                . "left join lecture l2 on l2.subject_id=subject.id and l2.type_id=2 where subject.term=? group by subject.id order by subject.name;", "Subject",  array("s"), array($term));
    }

    function getSubjectByTermAndYear($term,$year){
        // return mysqliQuery("Select * from subject where term=?;", "Subject", array("s"), array($term));
        $byterm= mysqliQuery("SELECT subject.*, count( distinct l1.id) as lect_num, count( distinct l2.id) as ex_num "
            . "FROM subject left join lecture l1 on l1.subject_id=subject.id and l1.type_id=1 "
            . "left join lecture l2 on l2.subject_id=subject.id and l2.type_id=2 where subject.term=? and subject.year=? group by subject.id order by subject.name;", "Subject",  array("s", "i"), array($term, $year));
            //  foreach ($byterm as $pom){
            //            echo $pom;
            //            array_push($result,$term);
            //        }
   return $byterm;
    }
    
    function getPerson($id = null){
        $persons = $id ? mysqliQuery("SELECT p.*, sum(if(l.type_id=1, s.lectureDuration, 0)) as lect_cnt, sum(if(l.type_id=2, s.exceriseDuration, 0)) as ex_cnt "
                . "FROM person p left join lecture l on l.person_id=p.id left join subject s on l.subject_id=s.id 
        		where p.id=? group by p.id order by p.surname;", "Person", array("i"), array($id)) : mysqliQuery("SELECT p.*, sum(if(l.type_id=1, s.lectureDuration, 0)) as lect_cnt, sum(if(l.type_id=2, s.exceriseDuration, 0)) as ex_cnt "
                        . "FROM person p left join lecture l on l.person_id=p.id "
                        . "left join subject s on l.subject_id=s.id group by p.id order by p.surname;", "Person");

        foreach ($persons as $person) {
            $person->setGroup($this->getGroup($person->getIdGroup()));
            $person->setLectureCoefficient($this->lectureDurationCoeficient);
        }
        return $persons;
    }
    
    function getPersonActiveYear($id = null){
    	$persons = $id ? mysqliQuery("SELECT p.*, sum(if(l.type_id=1 and y.active=1, s.lectureDuration, 0)) as lect_cnt, sum(if(l.type_id=2 and y.active=1, s.exceriseDuration, 0)) as ex_cnt "
    			. "FROM person p left join lecture l on l.person_id=p.id left join subject s on l.subject_id=s.id left join year y on y.id=s.year
        		where p.id=? group by p.id order by p.surname;", "Person", array("i"), array($id)) : mysqliQuery("SELECT p.*, sum(if(l.type_id=1 and y.active=1, s.lectureDuration, 0)) as lect_cnt, sum(if(l.type_id=2 and y.active=1, s.exceriseDuration, 0)) as ex_cnt "
            				. "FROM person p left join lecture l on l.person_id=p.id "
            				. "left join subject s on l.subject_id=s.id left join year y on y.id=s.year group by p.id order by p.surname;", "Person");
    
    			foreach ($persons as $person) {
    				$person->setGroup($this->getGroup($person->getIdGroup()));
    				$person->setLectureCoefficient($this->lectureDurationCoeficient);
    			}
    			return $persons;
    }
    
    function getPersonByLdap($ldap){
        return mysqliQuery("Select * from person where ldap=?;", "Person", array("s"), array($ldap));
    }
    
    function getPersonByGoogle($google){
        return mysqliQuery("Select * from person where google=?;", "Person", array("s"), array($google));
    }
    
    function getRoom($id = null){
        return $id ? mysqliQuery("Select * from room where id=?;", "Room", array("i"), array($id)) : mysqliQuery("Select * from room order by room asc;", "Room");
    }
    
    function getYear($id = null){
        return $id ? mysqliQuery("Select * from year where id=?;", "Year", array("i"), array($id)) : mysqliQuery("Select * from year order by year desc;", "Year");
    }

    function getYearFromFullYear($year){
        return  mysqliQuery("Select id from year where year=?;", null, array("s"), array($year)) ;
    }


    function getActiveYear(){
        $lastYearRes = mysqliQuery("Select * from year WHERE active = 1 LIMIT 1;", "Year", null, null);
        foreach ($lastYearRes as $row) {
            return $row->getId();
        }
    }


    function getActiveYearString(){
        $lastYearRes = mysqliQuery("Select * from year WHERE active = 1 LIMIT 1;", "Year", null, null);
        foreach ($lastYearRes as $row) {
            return $row->getYear();
        }
    }



    function setActiveYearFromDbYearId($yearId){

            //check if given year exist in db,because we are going to clean up active year later
            $yearExists = mysqliQuery("Select * from year WHERE id=? LIMIT 1;", "Year",array("i"),array($yearId));
            if ( $yearExists )
            {
                $yearToBeDeactived = $this->getActiveYear();
                mysqliQuery ( "update year set active = 0 WHERE id=? ;",null,array("i"),array($yearToBeDeactived)); //clean up active year - if we need,we could null up all rows
                mysqliQuery ( "update year set active = 1 WHERE id=? ;",null,array("i"),array($yearId));
            }

    }

    function setActiveYearFromDbYear($yearToBeActivedYearString){

        //check if given year exist in db,because we are going to clean up active year later
        $yearExists = mysqliQuery("Select * from year WHERE year=? LIMIT 1;", "Year",array("s"),array($yearToBeActivedYearString));
        if ( $yearExists )
        {
            $yearToBeDeactived = $this->getActiveYear();
            mysqliQuery ( "update year set active = 0 WHERE id=? ;",null,array("i"),array($yearToBeDeactived) ); //clean up active year - we could null all rows,if we need
            mysqliQuery ( "update year set active = 1 WHERE year =? ;",null,array("s"),array($yearToBeActivedYearString) );
        }

    }

    function getConsultation($id=null){
        $cons = $id ? mysqliQuery("Select * from consultation where id=?;", "Consultation", array("i"), array($id)) : mysqliQuery("Select * from consultation;", "Consultation");
        foreach ($cons as $value) {
            //$value->setPerson($this->getPerson($value->getPerson_id())[0]);        // plati pre php 5.4
            $pom=$this->getPerson($value->getPerson_id());                           //pre php 5.3
            $value->setPerson($pom[0]);                                              //pre php 5.3
        }
        return $cons;
    }
    
    function getConsultationByPerson($personIds=null){
        $clause = $personIds ? implode(',', array_fill(0, count($personIds), '?')) : '';
        $type = array();
        if($personIds != null){
            foreach ($personIds as $value) {
                array_push($type, "i");
            }
            $consultations = mysqliQuery('SELECT * from consultation where person_id in (' . $clause . ');', "Consultation", $type, $personIds);
        }else{
            $consultations = mysqliQuery('SELECT * from consultation;', "Consultation");
        }
        
        foreach ($consultations as $value) {
            //$value->setPerson($this->getPerson($value->getPerson_id())[0]);                //pre php 5.4
            $pom=$this->getPerson($value->getPerson_id());                                   //pre php 5.3
            $value->setPerson($pom[0]);                                                      //pre php 5.3
        }
        return $consultations;
    }

    function getConsultationByDay($day){
        $consultations = mysqliQuery('SELECT * from consultation where day=?;', "Consultation", array('i'), array($day));

        foreach ($consultations as $value) {
            //$value->setPerson($this->getPerson($value->getPerson_id())[0]);                //pre php 5.4
            $pom=$this->getPerson($value->getPerson_id());                                   //pre php 5.3
            $value->setPerson($pom[0]);                                                      //pre php 5.3
        }
        return $consultations;
    }

    function getConsultationByGroup($groupId){

        $consultations = mysqliQuery('SELECT c.* from consultation c, person p, `group` g where c.person_id=p.id and p.idGroup = g.idGroups and g.idGroups=?;', "Consultation", array('i'), array($groupId));

        foreach ($consultations as $value) {
            //$value->setPerson($this->getPerson($value->getPerson_id())[0]);                //pre php 5.4
            $pom=$this->getPerson($value->getPerson_id());                                   //pre php 5.3
            $value->setPerson($pom[0]);                                                      //pre php 5.3
        }
        return $consultations;
    }
    
    function getLecture($ids = null){
        $clause = $ids ? implode(',', array_fill(0, count($ids), '?')) : '';
        $type = array();
        
        if($ids != null){
            foreach ($ids as $value) {
                array_push($type, "i");
            }
            $lectures = mysqliQuery('SELECT lecture.*, lecture_type.type as typeName FROM lecture left join lecture_type on lecture.type_id=lecture_type.id, subject WHERE subject.id=lecture.subject_id and lecture.id IN (' . $clause . ') order by subject.name asc, lecture.day asc, lecture.start_time asc ;', "Lecture", $type, $ids);
        }else{
            $lectures = mysqliQuery('SELECT lecture.*, lecture_type.type as typeName FROM lecture left join lecture_type on lecture.type_id=lecture_type.id, subject WHERE subject.id=lecture.subject_id order by subject.name asc, lecture.day asc, lecture.start_time asc ;', "Lecture");
        }

        foreach ($lectures as $lecture) {
            //$lecture->setSubject($this->getSubject($lecture->getSubject_id())[0]);   //pre php 5.4
            $pom=$this->getSubject($lecture->getSubject_id());                         //pre php 5.3
            $lecture->setSubject($pom[0]);                                             //pre php 5.3
        }
        foreach ($lectures as $lecture) {
            //$lecture->setPerson($this->getPerson($lecture->getPerson_id())[0]);      //pre php 5.4
            $pom=$this->getPerson($lecture->getPerson_id());                           //pre php 5.3
            $lecture->setPerson($pom[0]);                                              //pre php 5.3
        }
        foreach ($lectures as $lecture) {
            //$lecture->setRoom($this->getRoom($lecture->getRoom_id())[0]);         //pre php 5.4
            $pom=$this->getRoom($lecture->getRoom_id());                            //pre php 5.3
            $lecture->setRoom($pom[0]);                                             //pre php 5.3
        }

        return $lectures;
    }
    
    private function getLecturesIdByParam($params, $tableConnections=array(), $tables=array()){
    	
    	$lectures = array();
    	
        $sql = "Select distinct lecture.id from lecture";
        foreach ($tables as $value) {
            $sql.= ', '.$value;
        }
        $sql.= ' where ';
        foreach ($tableConnections as $value) {
            $sql.= $value.' and ';
        }
        $values = array();
        $dataTypes = array();
        $returnArray = array();
        foreach ($params as $key => $par) {
            $sql.=$par['name']."=? ";
            array_push($values, $par['value']);
            array_push($dataTypes, $par['type']);
            if($key!=count($params)-1){
                $sql.="and ";
            }
        }

        $idArray = mysqliQuery($sql, null, $dataTypes, $values);
        
        foreach ($idArray as $value) {
            array_push($returnArray, $value->id);
        }
        
        return $returnArray;
    }
    
    function getLectureType($id = null){
        return $id ? mysqliQuery("Select * from lecture_type where id=?;", null, array("i"), array($id)) : mysqliQuery("Select * from lecture_type;");
    }
    
    function getPersonType($id = null){
        return $id ? mysqliQuery("Select * from person_type where id=?;", null, array("i"), array($id)) : mysqliQuery("Select * from person_type;");
    }
    
    function getGroup($id = null){
        return $id ? mysqliQuery('Select * from `group` where idGroups=?;', 'Group', array("i"), array($id)) : mysqliQuery('Select * from `group`;','Group');
    }

    function getStudentsCountForPerson($id){
    	$return = mysqliQuery('SELECT SUM(students) as countStudents FROM `lecture` as l LEFT JOIN subject as s ON s.id=l.subject_id LEFT JOIN year as y ON y.id=s.year WHERE person_id = ? AND y.active = 1 ', null, array("i"), array($id));
    	if($return){
    		if(strlen(((array)$return[0])["countStudents"]) == 0){
    			return 0;
    		} else {
    			return ((array)$return[0])["countStudents"];
    		}
    	}
    }
    
    function getLecturesByPerson($ids = array()){
        $lectures = array();
        foreach ($ids as $personId) {
            $params = array(array("value"=>$personId, "name"=>"person_id", "type"=>"i"));
            $ids = $this->getLecturesIdByParam($params);
            if(!empty($ids)){
                $tempArray = $this->getLecture($ids);
                foreach ($tempArray as $value) {
                    array_push($lectures, $value);
                }
            }
        }
        return $lectures;
    }

    function getLecturesBySubject($ids = array()){
        foreach ($ids as $subjectId) {
            $params = array(array("value"=>$subjectId, "name"=>"subject_id", "type"=>"i"));
            $ids = $this->getLecturesIdByParam($params);
            if(!empty($ids)){
                $tempArray = $this->getLecture($ids);
                foreach ($tempArray as $value) {
                    array_push($lectures, $value);
                }
            }
        }
        return $lectures;
    }
            
    function getScheduleByCreatorId($creatorId){
        //$schedule = mysqliQuery("Select * from schedule where creator_id=?", "Schedule", array("i"), array($creatorId))[0];         //pre php 5.4
        $pom=mysqliQuery("Select * from schedule where creator_id=?", "Schedule", array("i"), array($creatorId));         //pre php 5.3
        $schedule = $pom[0];                                                                                              //pre php 5.3
        $params = array(array("value"=>$schedule->getId(), "name"=>"schedule_id", "type"=>"i"));
        $ids = $this->getLecturesIdByParam($params, array("lecture.id = schedule_lecture.lecture_id"), array("schedule_lecture"));
        if(!empty($ids)){
            $schedule->setCourses($this->getLecture($ids), $db->getLastYearId());
        }
        return $schedule;
    }
    
    function getScheduleBySubject($subjectId){   
        $params = array(array("value"=>$subjectId, "name"=>"subject_id", "type"=>"i"));
        $sched = new Schedule(); 
        $ids = $this->getLecturesIdByParam($params);
        if(!empty($ids)){
            $sched->setCourses($this->getLecture($ids), $this->getActiveYear());
        }
        return $sched;
    }
    
    function getScheduleByRoom($roomId){   
        $params = array(array("value"=>$roomId, "name"=>"room_id", "type"=>"i"));
        $sched = new Schedule(); 
        $ids = $this->getLecturesIdByParam($params);
        if(!empty($ids)){
            $sched->setCourses($this->getLecture($ids), $this->getActiveYear());
        }
        return $sched;
    }
    
    function getScheduleByGroup($groupId, $cons){   
        $params = array(array("value"=>$groupId, "name"=>"person.idGroup", "type"=>"i"));
        $sched = new Schedule(); 
        $ids = $this->getLecturesIdByParam($params, array("person.id = lecture.person_id"), array("person"));
        if(!empty($ids)){
            $sched->setCourses($this->getLecture($ids), $this->getActiveYear());
        }
        if($cons){
            $sched->setConsultations($this->getConsultationByGroup($groupId));
        }
        return $sched;
    }
    
    function getScheduleByDay($day, $cons){
        $params = array(array("value"=>$day, "name"=>"day", "type"=>"i"));
        $sched = new Schedule(); 
        $ids = $this->getLecturesIdByParam($params);
        if(!empty($ids)){
            $sched->setCourses($this->getLecture($ids), $this->getActiveYear());
        }
        if($cons){
            $sched->setConsultations($this->getConsultationByDay($day));
        }
        return $sched;
    }
    
    function getScheduleByPerson($personIds, $cons){
        $sched = new Schedule();
        $sched->setCourses($this->getLecturesByPerson($personIds), $this->getActiveYear());
        if($cons){
            $sched->setConsultations($this->getConsultationByPerson($personIds));
        }
        
        return $sched;
    }
}

?>
