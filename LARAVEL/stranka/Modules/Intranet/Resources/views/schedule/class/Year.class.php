<?php

//@author Matej Rábek <xrabek@stuba.sk>

require_once 'DbClass.abstractClass.php';

class Year extends DbClass{
    private $id;
    private $year;
    private $active;


    function getId() {
        return $this->id;
    }

    function getYear() {
        return $this->year;
    }

    function setYear($year) {
        $this->year = $year;
    }
    function getActive() {
        return $this->active;
    }

    function setActive($active) {
        $this->active = $active;
    }

    public function getUpdateArray() {
        return array($this->year, $this->id, $this->active);
    }
}

?>
