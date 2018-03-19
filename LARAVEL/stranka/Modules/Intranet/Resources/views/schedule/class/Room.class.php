<?php

//@author Matej Rábek <xrabek@stuba.sk>

require_once 'DbClass.abstractClass.php';

class Room extends DbClass{
    private $id;
    private $room;
    
    function getId() {
        return $this->id;
    }

    function getRoom() {
        return $this->room;
    }

    function setRoom($room) {
        $this->room = $room;
    }

    public function getUpdateArray() {
        return array($this->room, $this->id);
    }
}

?>
