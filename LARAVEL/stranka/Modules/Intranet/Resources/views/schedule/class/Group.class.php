<?php
/**
 * Description of Group
 *
 * @author Matej
 */
class Group {
    private $idGroups;
    private $code;
    private $name;
    
    function getIdGroups() {
        return $this->idGroups;
    }

    function getCode() {
        return $this->code;
    }

    function getName() {
        return $this->name;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setName($name) {
        $this->name = $name;
    }
}
