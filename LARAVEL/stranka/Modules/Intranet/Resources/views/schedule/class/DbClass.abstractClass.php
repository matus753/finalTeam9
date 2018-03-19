<?php

//@author Matej Rábek <xrabek@stuba.sk>

abstract class DbClass {
    
    abstract public function getUpdateArray();
    
    public function getInsertArray(){
        $updateArray = $this->getUpdateArray();
        array_pop($updateArray);
        return $updateArray;
    }
}

?>
