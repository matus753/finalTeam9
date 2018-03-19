<?php

require_once 'DbClass.abstractClass.php';

class Person extends DbClass{

    private $id;
    private $person_type;
    private $title1;
    private $name;
    private $surname;
    private $active;
    private $title2;
    private $idGroup;
    private $ldap;
    private $google;
    private $lect_cnt;
    private $ex_cnt;
    private $lect_koef;
    
    private $group;
            
    function getId() {
        return $this->id;
    }

    function getPerson_type() {
        return $this->person_type;
    }

    function getTitle1() {
        return $this->title1;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }
    function getActive() {
        return $this->active;
    }

    function getTitle2() {
        return $this->title2;
    }

    function getIdGroup() {
        return $this->idGroup;
    }

    function getLdap() {
        return $this->ldap;
    }

    function getGoogle() {
        return $this->google;
    }
    
    function getAllCoursesCount() {
        return $this->getLectureCount() + $this->getExcersiseCount();
    }

    function getAllStudentsCount() {
    	return $this->getLectureCount() + $this->getExcersiseCount();
    }
    
    function getLectureCount() {
        return ($this->lect_koef * $this->lect_cnt);
    }

    function getExcersiseCount() {
        return $this->ex_cnt;
    }
    
    function getFullName(){
        return $this->title1.' '.$this->name.' '.$this->surname.' '.$this->title2;
    }
    
    function setPerson_type($person_type) {
        $this->person_type = $person_type;
    }

    function setLectureCoefficient($lect_koef){
        $this->lect_koef = $lect_koef;
    }

    function setTitle1($title1) {
        $this->title1 = $title1;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }
    function setActive($active) {
        $this->active = $active;
    }

    function setTitle2($title2) {
        $this->title2 = $title2;
    }

    function setIdGroup($idGroup) {
        $this->idGroup = $idGroup;
    }

    function setLdap($ldap) {
        $this->ldap = $ldap;
    }

    function setGoogle($google) {
        $this->google = $google;
    }
    
    function setGroup($group) {
        $this->group = $group;
    }
    
    function getGroup() {
        return $this->group;
    }
    
    public function getUpdateArray() {
        return array($this->person_type, $this->title1, $this->name, $this->surname,$this->active, $this->title2, $this->idGroup, $this->ldap, $this->google, $this->id);
    }

}
?>