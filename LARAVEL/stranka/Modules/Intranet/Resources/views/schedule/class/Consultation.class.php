<?php
/**
 * Description of Consultation
 *
 * @author Matej
 */

require_once 'DbClass.abstractClass.php';

class Consultation extends DbClass{
    
    private $id;
    private $person_id;
    private $start_time;
    private $day;
    private $duration;
    private $note;
    private $person;
    
    function getId() {
        return $this->id;
    }

    function getPerson_id() {
        return $this->person_id;
    }

    function getStart_time() {
        return $this->start_time;
    }

    function getDuration() {
        return $this->duration;
    }
    
    function getName() {
        return $this->note;
    }
    
    function getNote() {
        return $this->note;
    }
    function getDayNum() {
        return $this->day;
    }

    function setDay($day) {
        $this->day = $day;
    }

    function setPerson_id($person_id) {
        $this->person_id = $person_id;
    }

    function setStart_time($start_time) {
        $this->start_time = $start_time;
    }

    function setDuration($duration) {
        $this->duration = $duration;
    }
    
    function setPerson($person) {
        $this->person = $person;
    }

    function setNote($note) {
        $this->note = $note;
    }
    
    function getStartHour(){
        return (intval(substr($this->start_time, 0, 2)) + (intval(substr($this->start_time, 3, 2))>0 ? 0.5 : 0));
    }
    
    function getPerson() {
        return $this->person;
    }

    function getLegend(){
        return '<span>'.$this->id .' - '. $this->note .' ('.$this->person->getFullName().')</span>';
    }
    
    function getColor(){
        return "#991111";
    }
    
    function getCell($edit=false){
        //index.php?editConsultation&id=
        if($edit){
            if($this->duration<1){
                return '<span class="name"><a href="index.php?editConsultation&id='.$this->id.'" >'.$this->id.'</a></span><span class="tip-content">'.'<span class="name">'.$this->note.'</span><br>'
                    . '<span class="teacher">'.$this->person->getFullName().'</span>'.'</span>';
            }
            return '<span class="name"><a href="index.php?editConsultation&id='.$this->id.'">'.$this->note.'</a></span><br>'
                    . '<span class="teacher">'.$this->person->getFullName().'</span>';
        }
        if($this->duration<1){
            return '<span class="name">'.$this->id.'</span><span class="tip-content">'.'<span class="name">'.$this->note.'</span><br>'
                . '<span class="teacher">'.$this->person->getFullName().'</span>'.'</span>';
        }
        return '<span class="name">'.$this->note.'</span><br>'
                . '<span class="teacher">'.$this->person->getFullName().'</span>';
    }
    
    function getClassName(){
        return "consultation";
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

    public function getUpdateArray() {
        return array($this->person_id, $this->start_time, $this->day, $this->duration, $this->note, $this->id);
    }

}
