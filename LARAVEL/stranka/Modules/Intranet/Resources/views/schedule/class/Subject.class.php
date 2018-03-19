<?php

require_once 'DbClass.abstractClass.php';

class Subject extends DbClass{
    private $id;
    private $code;
    private $name;
    private $acronym;
    private $lectureDuration;
    private $exceriseDuration;
    private $color;
    private $term;
    private $year;
    private $active;
    private $yearObject;
    private $lect_num;
    private $ex_num;


    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getYear() {
        return $this->year;
    }

    public function getYearObject() {
    	return $this->yearObject;
    }
    
    public function getActive() {
        return $this->active;
    }

    public function getAcronym() {
        return $this->acronym;
    }

    public function getLectureDuration() {
        return $this->lectureDuration;
    }

    public function getExceriseDuration() {
        return $this->exceriseDuration;
    }

    public function getColor() {
        return $this->color;
    }

    public function getTerm() {
        return $this->term;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAcronym($acronym) {
        $this->acronym = $acronym;
    }

    public function setLectureDuration($lectureDuration) {
        $this->lectureDuration = $lectureDuration;
    }

    public function setExceriseDuration($exceriseDuration) {
        $this->exceriseDuration = $exceriseDuration;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setTerm($term) {
        $this->term = $term;
    }

    public function setYear($year) {
    	$this->year = $year;
    }

    public function setYearObject($yearObject) {
    	$this->yearObject = $yearObject;
    }
    
    function getLectureCount() {
        return $this->lect_num;
    }
    
    function getExcerciseCount() {
        return $this->ex_num;
    }
    
    function hasLectures() {
        return $this->lect_num>0;
    }

    public function getUpdateArray() {
        return array($this->code, $this->name, $this->acronym, $this->lectureDuration, $this->exceriseDuration, $this->color, $this->term,$this->year,$this->active, $this->id);
    }

}
?>