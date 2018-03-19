<?php

require_once 'DbClass.abstractClass.php';

//@author Matej Rábek <xrabek@stuba.sk>

class Day{
    private $tableArray = array(array());
    private $courses = array();
    private $dayString;
    
    private function checkSpotAvailable($startHour, $duration, $row){
        $isAvailable = true;
        foreach ($this->tableArray[$row] as $value) {
            for ($i = 0; $i < $duration; $i++) {
                if($value['startHour']<=($startHour+$i) && ($value['startHour']+$value['duration'])>($startHour+$i)){
                    $isAvailable = false;
                    break;
                }
            }
        }
        return $isAvailable;
    }
    
    private function getNextTableCellIndex($tableSubRow) {

        reset($tableSubRow);
        $testElement =  current($tableSubRow);
        $returnIndex = array_search($testElement, $tableSubRow);
        
        foreach ($tableSubRow as $key => $value) {
            if($value['startHour']<$testElement['startHour']){
                $testElement = $value;
                $returnIndex = $key;
            }
        }
        
        return $returnIndex;
    }
    
    private function getTableSubRowString($subRow, $edit=false){
        $returnString = '';
        $position = 0;
        $isHalf = false;
        while (count($subRow)>0) {
            $index = $this->getNextTableCellIndex($subRow);
           /* echo '<pre>';
            var_dump($subRow[$index]['startHour']);
            echo($subRow[$index]['course']->getName());
            echo '</pre>';*/
            while ($position<(($subRow[$index]['startHour']-7)) && ($position+1)<=(($subRow[$index]['startHour']-7))) {
                if($isHalf){
                    $returnString .= '<td></td>';
                    $position+=0.5;
                    $isHalf = false;
                }else{
                    $returnString.='<td colspan="2"></td>';
                    $position++;
                }
            }
            if($subRow[$index]['duration'] < 1){
                if($subRow[$index]['startHour']==floor($subRow[$index]['startHour'])){
                    if($isHalf){
                        $returnString .= '<td></td>';
                        $position+=0.5;
                    }
                    $returnString .= '<td class="'.$subRow[$index]['course']->getClassName().'" style="background-color:'.$subRow[$index]['course']->getColor().';width:34px;">'
                    . $subRow[$index]['course']->getCell($edit)
                    . '</td>';
                    $isHalf = true;
                    $position+=0.5;
                }else{
                    if(!$isHalf){
                        $returnString .= '<td></td>';
                        $position+=0.5;
                    }
                    $returnString .= '<td class="'.$subRow[$index]['course']->getClassName().'" style="background-color:'.$subRow[$index]['course']->getColor().';width:34px;">'
                    . $subRow[$index]['course']->getCell($edit)
                    . '</td>';
                    $isHalf = false;
                    $position+=0.5;
                }
                
            }else{
                if($isHalf){
                    $returnString .= '<td></td>';
                    $position+=0.5;
                }
                $isHalf = false;
                $returnString .= '<td colspan="'.($subRow[$index]['duration']*2).'" class="'.$subRow[$index]['course']->getClassName().'" style="background-color:'.$subRow[$index]['course']->getColor().';">'
                    . $subRow[$index]['course']->getCell($edit)
                    . '</td>';
                $position+=$subRow[$index]['duration'];
            }
            
            unset($subRow[$index]);
        }
        for ($i = $position; $i < 15; $i++) {
            if($isHalf){
                $returnString .= '<td></td>';
                $position+=0.5;
                $isHalf = false;
            }else{
                $returnString.='<td colspan="2"></td>';
            }
            
        }
        return $returnString;
    }

    public function addCourse($course) {
        array_push($this->courses, $course);
    }
    
    public function isEmpty(){
        return count($this->courses)>0;
    }
    
    public function setDayString($dayString){
        $this->dayString = $dayString;
    }

    public function getDayTableRow($edit = false){
        $row = 0;
        
        for ($i = 0; $i < count($this->courses); $i++) {
            if($this->checkSpotAvailable($this->courses[$i]->getStartHour(), $this->courses[$i]->getDuration(), $row)){
                array_push($this->tableArray[$row], array('course'=>$this->courses[$i], 'startHour'=>$this->courses[$i]->getStartHour(), 'duration'=>$this->courses[$i]->getDuration()));
                $row = 0;
            }else{
                $row++;
                if(!array_key_exists($row, $this->tableArray)){
                    $this->tableArray[$row] = array();
                }
                $i--;
            }
        }
        
        $isFirst = true;
        $tableRowString = "";
        
        foreach ($this->tableArray as $tableSubRow) {
            $tableRowString.= $isFirst ? '<tr><td rowspan="'.count($this->tableArray).'" class="zahlavie">'.$this->dayString.'</td>' : '<tr>';
            $tableRowString.= $this->getTableSubRowString($tableSubRow, $edit).'</tr>';
            $isFirst = false;
        }
        
        return $tableRowString;
    }
}

class Schedule extends DbClass{
    
    private $id;
    private $creator_id;
    private $create_date;
    private $note;
    private $days = array();
    private $lectures;
    private $consultations;
    
    function getId() {
        return $this->id;
    }

    function getCreator_id() {
        return $this->creator_id;
    }

    function getCreate_date() {
        return $this->create_date;
    }

    function getNote() {
        return $this->note;
    }
    
    function addDay($day){
        array_push($this->days, $day);
    }

    function setCreator_id($creator_id) {
        $this->creator_id = $creator_id;
    }

    function setCreate_date($create_date) {
        $this->create_date = $create_date;
    }

    function setNote($note) {
        $this->note = $note;
    }
    
    function getLectures() {
        return $this->lectures;
    }

    function getConsultations() {
        return $this->consultations;
    }
    
    function setConsultations($consultations) {
        $this->consultations = $consultations;
        foreach ($consultations as $value) {
            if(!array_key_exists($value->getDayNum(), $this->days)){
                $this->days[$value->getDayNum()] = new Day();
            }
            $this->days[$value->getDayNum()]->addCourse($value);
            $this->days[$value->getDayNum()]->setDayString($value->getDay($_SESSION['lang']));
        }
    }
  
    function setCourses($courses, $lastYearId) {
    	$tmpLectures = array();
    	foreach($courses as $c){
    		if($c->getSubject()->getYear() == $lastYearId){
    			if($c->getSubject()->getTerm() == "S" && intval(date("m")) > 1 && intval(date("m")) < 9)
    				array_push($tmpLectures, $c);
    			elseif($c->getSubject()->getTerm() == "W" && (intval(date("m")) >= 9 || intval(date("m")) == 1))
    				array_push($tmpLectures, $c);
    		}
    	}
        $this->lectures = $tmpLectures;
        $dayNameArray = array(array('sk'=>"Pondelok", 'en'=>"Monday"), array('sk'=>"Utorok", 'en'=>"Tueseday"), array('sk'=>"Streda", 'en'=>"Wednesday"), array('sk'=>"Štvrtok", 'en'=>"Thursday"), array('sk'=>"Piatok", 'en'=>"Friday"));
        foreach ($this->lectures as $value) {
            if(!array_key_exists($value->getDayNum(), $this->days)){
                $this->days[$value->getDayNum()] = new Day();
                $this->days[$value->getDayNum()]->setDayString($value->getDay($_SESSION['lang']));
            }
            $this->days[$value->getDayNum()]->addCourse($value);
            
        }
    }

    public function addVoidDays(){
        $dayNameArray = array(array('sk'=>"Pondelok", 'en'=>"Monday"), array('sk'=>"Utorok", 'en'=>"Tueseday"), array('sk'=>"Streda", 'en'=>"Wednesday"), array('sk'=>"Štvrtok", 'en'=>"Thursday"), array('sk'=>"Piatok", 'en'=>"Friday"));
        for ($i=1; $i < 6; $i++) { 
            if(!array_key_exists($i, $this->days)){
                $this->days[$i] = new Day();
                $this->days[$i]->setDayString($dayNameArray[$i-1][$_SESSION['lang']]);
            }
        }
    }
    
    public function getScheduleTable($edit = false){
        $table = "<table><thead><tr><th></th>";
        for ($i = 0; $i < 15; $i++) {
            $table .= '<th colspan="2">'. ($i+7) .'</th>';
        }
        $table .= '</tr><tbody>';
        
        ksort($this->days);

        foreach ($this->days as $day) {
            $table .= $day->getDayTableRow($edit);
        }
        $table .= '</tbody></table>';

        $pomBool = false;
        if($this->consultations != null && is_array($this->consultations)){
	        foreach ($this->consultations as $consultation) {
	            if($consultation->getDuration()<1){
	                $pomBool = true;
	                break;
	            }
	        }
        }

        if ($pomBool) {
            $table .= '<ul style="margin-top:20px;">';
        
            foreach ($this->consultations as $consultation) {
                if($consultation->getDuration()<1){
                    $table .= '<li>'.$consultation->getLegend().'</li>';
                }
                
            }

            $table .= '</ul>';
        }

        return $table;
    }
    
    public function getInsertSQL(){
        $sql = "Insert into schedule (creator_id, note) values (".$this->creator_id.", ".$this->note.");";
        foreach ($this->lectures as $lecture) {
            $sql.="Insert into schedule_lecture (lecture_id, schedule_id) values(".$lecture->getId().", ".$this->id.");";
        }
        return $sql;
    }

    public function getUpdateArray() {
        return array($this->creator_id, $this->note, $this->id);
    }

}

?>
