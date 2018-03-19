<?php
/**
 * Description of Lecture
 *
 * @author Matej
 */

require_once 'DbClass.abstractClass.php';

class Lecture extends DbClass{
    private $id;
    private $subject_id;
    private $person_id;
    private $type_id;
    private $room_id;
    private $start_time;
    private $day;
    private $typeName;
    
    private $person;
    private $subject;
    private $room;
    private $students;
            
    function getId() {
        return $this->id;
    }

    function getStudents() {
    	return $this->students;
    }
    
    function getSubject_id() {
        return $this->subject_id;
    }

    function getType_id() {
        return $this->type_id;
    }

    function getRoom_id() {
        return $this->room_id;
    }

    function getStart_time() {
        return $this->start_time;
    }
            
    function getPerson_id() {
        return $this->person_id;
    }

    function setSubject_id($subject_id) {
        $this->subject_id = $subject_id;
    }

    function setPerson_id($person_id) {
        $this->person_id = $person_id;
    }

    function setStudents($students) {
    	$this->students = $students;
    }
    
    function setType_id($type_id) {
        $this->type_id = $type_id;
    }

    function setRoom_id($room_id) {
        $this->room_id = $room_id;
    }

    function setStart_time($start_time) {
        $this->start_time = $start_time;
    }
    
    function setPerson($person) {
        $this->person = $person;
    }
    
    function getName(){
        return $this->subject->getName();
    }
    
    function getColor(){
        return $this->subject->getColor();
    }

    function setSubject($subject) {
        $this->subject = $subject;
    }
    
    function getPerson() {
        return $this->person;
    }

    function getSubject() {
        return $this->subject;
    }
    
    function getRoom() {
        return $this->room;
    }

    function setRoom($room) {
        $this->room = $room;
    }
    
    function getDay($lang) {
        if($lang=="sk"){
            switch ($this->day) {
            case 1:
                return "Pondelok";
            case 2:
                return "Utorok";
            case 3:
                return "Streda";
            case 4:
                return "Štvrtok";
            case 5:
                return "Piatok";
            default:
                return "Neplatný deň";
            }
        }else if($lang=="en"){
            switch ($this->day) {
            case 1:
                return "Monday";
            case 2:
                return "Tuesday";
            case 3:
                return "Wednesday";
            case 4:
                return "Thursday";
            case 5:
                return "Friday";
            default:
                return "Neplatný deň";
            }
        }
    }
    
    function getStartHour(){
        return intval(substr($this->start_time, 0, 2));
    }
    
    function getDuration(){
        return $this->type_id==1 ? $this->subject->getLectureDuration() : $this->subject->getExceriseDuration();
    }
    
    function getClassName(){
        return $this->type_id==1 ? "lecture" : "excersise";
    }
    
    function getDayNum(){
        return $this->day;
    }

    function setDay($day) {
        $this->day = $day;
    }
    
    function getTypeName() {
        return $this->typeName;
    }
    
    function getCell($edit = false){
        if($edit){
            return '<span class="name"><a href="index.php?editLecture&id='.$this->getId().'">'.$this->subject->getName().'</a></span><br>'
                . '<span class="teacher">'.$this->person->getfullName().'</span><br>'
                . '<span class="room">'.$this->room->getRoom().'</span>';
        }
        return '<span class="name">'.$this->subject->getName().'</span><br>'
                . '<span class="teacher">'.$this->person->getfullName().'</span><br>'
                . '<span class="room">'.$this->room->getRoom().'</span>';
    }
    
//    function getTdBlock(){
//        return '<td colspan="'. $this->getType_id()==1 ? $this->subject->getExceriseDuration() : $this->subject->getLectureDuration().'">'
//                .$this->subject->getName().'</td>';
//    }

    public function getUpdateArray() {
        return array($this->subject_id, $this->person_id, $this->type_id, $this->room_id, $this->start_time, $this->day, $this->students, $this->id);
    }

}

?>