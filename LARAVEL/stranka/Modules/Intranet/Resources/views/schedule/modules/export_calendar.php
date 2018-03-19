<?php

require_once '../config.php';

$id = 0;
$end = 0;

if (isset($_SESSION['teacher_id']) && isset($_GET['end'])){
    $id = $_SESSION['teacher_id'];
    $end = $_GET['end'];
}
else{
    //echo "hyba jak delo";
    $id = 0;
}

function generateCalendar($idPerson ,$endSemester) {
    
    $uid = "";
    $url = "http://www.fei.stuba.sk";
    
    $fileName = "rozvrh_export";
    
    $header = "BEGIN:VCALENDAR\n".
        "CALSCALE:GREGORIAN\n".
        "VERSION:2.0\n".
        "METHOD:PUBLISH\n".
        "X-WR-CALNAME:". 'meno rozvrhu' ."\n".
        "X-WR-TIMEZONE:Europe/Bratislava\n".
        "X-APPLE-CALENDAR-COLOR:#AAAAFF\n".
        "BEGIN:VTIMEZONE\n".
        "TZID:Europe/Bratislava\n".
        "BEGIN:DAYLIGHT\n".
        "TZOFFSETFROM:+0100\n".
        "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU\n".
        "DTSTART:19810329T020000\n".
        "TZNAME:CET\n".
        "TZOFFSETTO:+0200\n".
        "END:DAYLIGHT\n".
        "BEGIN:STANDARD\n".
        "TZOFFSETFROM:+0200\n".
        "RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU\n".
        "DTSTART:19961027T030000\n".
        "TZNAME:CET\n".
        "TZOFFSETTO:+0100\n".
        "END:STANDARD\n".
        "END:VTIMEZONE\n";
    
    $db = new DbManager();
    $schedule = $db->getScheduleByPerson(array($idPerson));
    $lectures = $schedule->getLectures();
    
    foreach ($lectures as $l) {
       //var_dump($l);
       $lecture = $l;
       $subject = $lecture->getSubject();
       
       $semester = $subject->getTerm();
       if ($semester == 'S'){ // summer
            $month = date('n');
            if ($month > 2 && $month < 9){
                $flag = 1;
            }
            else{
                $flag = 0;
            }
       }
       else { //winter
            if ($month > 2 && $month < 9){
                $flag = 0;
            }
            else{
                $flag = 1;
            }
       }
       if ($flag == 1){
       
       $person = $lecture->getPerson();
       $room = $lecture->getRoom();

       $endTime = date("His",strtotime($lecture->getStart_time()) + $lecture->getDuration()*60*60);
       
       $now = time();
       $dateForDayIndex = getdate($now);
       if($dateForDayIndex ){
           
       }
       $currentDay = ($dateForDayIndex['wday']);
       $day = ($lecture->getDayNum());
       $diff = intval($day) - intval($currentDay);
       $startDate= date('Ymd', strtotime("+" . $diff . " days"));
       
       $uid = uniqid();
       $header .= generateEvent(
           $startDate,
           $startDate,
           date("His", strtotime($lecture->getStart_time())),
           $endTime, 
           $room->getRoom(), 
           $uid, 
           $url, 
           $person->getTitle1() . " " . $person->getName() . " " . $person->getSurname() . ", " . $person->getTitle2(), 
           $subject->getName(), 
           $endSemester)
       ;
       }
    }

    $header .= "END:VCALENDAR";
    
    header_remove(); 

    header("Cache-Control: private");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: text/calendar; "); 
    header("Content-Transfer-Encoding: binary");

    echo $header;
}

function generateEvent($startDate, $endDate, $startTime, $endTime, $room, $uid, $url, $description, $subjectName, $endSemester){
    $event =
    "BEGIN:VEVENT\n".
    "TRANSP:OPAQUE\n".
    "DTEND;TZID=Europe/Bratislava:". date("Ymd", strtotime($endDate)) . "T" . $endTime . "\n".
    "UID:" . $uid . "\n".
    "DTSTAMP:". date("Ymd", time()) . "T" . date("His", time()) . "Z\n".
    "LOCATION:" . $room . "\n".
    "DESCRIPTION:" . $description . "\n".
    "URL;VALUE=URI:" . $url. "\n".
    "SEQUENCE:0\n".
    "SUMMARY:" . $subjectName . "\n".
    "DTSTART;TZID=Europe/Bratislava:". date("Ymd", strtotime($startDate)) . "T" . $startTime . "\n".
    "CREATED:". date("Ymd", time()) . "T" . date("His", time()) . "Z\n".
    "RRULE:FREQ=WEEKLY;INTERVAL=1;UNTIL=". date("Ymd", strtotime($endSemester)) . "T" . $endTime . "Z\n".
    "END:VEVENT\n";
    
    return $event;
}

generateCalendar($id, date("Ymd", strtotime($end)));

?>