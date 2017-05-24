<?php
require_once __DIR__ . '/../general_functions.php';

function generateTable($m,$y){
    $conn = new_connection();
    $days = array("Ne", "Po", "Ut", "St", "Št", "Pi", "So");

    $sql = "SELECT id, name, surname FROM staff ORDER BY surname";
    $result = $conn->query($sql);

    $number = cal_days_in_month(CAL_GREGORIAN, $m, $y);
    echo '<table class="table table-bordered" id="table"><thead><tr><th></th>';

    for ($x = 1; $x <= $number; $x++) {
        echo "<th class=\"fixed\">$x</th>";
    }
    echo '</tr><tr><th style="display: none">ID</th><th>Meno</th>';
    for ($x = 1; $x <= $number; $x++){
        $day = $days[date("w",strtotime($y . "-" . $m . "-" . $x))];
        if(strcmp($day,"Ne") == 0 || strcmp($day,"So") == 0)
            echo "<th style='background: slategray'>$day</th>";
        else
            echo "<th>$day</th>";
    }
    echo '</tr></thead>';
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><th style=\"display: none\">". $row["id"] . "</th><th class='unselectable name' onclick='show(this)'>" . $row["name"] ." " . $row["surname"] . "</th>";
            $sql = "SELECT id_typu, datum from nepritomnosti where id_zamestnanca = " . $row["id"] . ' AND MONTH(datum) = ' . $m . ' ORDER BY datum';
            $nepr = $conn->query($sql);
            if($nepr->num_rows > 0){
                $d = $nepr->fetch_assoc();
                $timestamp = DateTime::createFromFormat("Y-m-d",$d["datum"])->format("d");
            } else {
                $d = null;
            }
            for ($x = 1; $x <= $number; $x++) {
                if($d != null){
                    if($timestamp == $x) {
                        $sql = "SELECT skratka,farba from typ_nepritomnosti where id = " . $d["id_typu"];
                        $typ = $conn->query($sql);
                        $typsk = $typ->fetch_assoc();
                        echo '<td class="unselectable" style="background-color: '. $typsk["farba"].'">' . $typsk["skratka"] . "</td>";
                        $d = $nepr->fetch_assoc();
                        if($d != null)
                            $timestamp = DateTime::createFromFormat("Y-m-d", $d["datum"])->format("d");
                    }
                    else {
                        echo "<td class='unselectable'></td>";
                    }
                } else {
                    echo "<td class='unselectable'></td>";
                }
            }
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    echo '</table>';
}

function build_month($month,$year, $id) {

    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Ne','Po','Ut','St','Št','Pi','So');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    $conn = new_connection();
    $sql = "SELECT * FROM staff WHERE id = " . $id;
    $result = $conn->query($sql);
    $emp = $result->fetch_assoc();

    $calendar = '<div class="container"><div class="col-xs-3"><h2 style="margin-bottom: 5px">'. $emp["name"] . ' ' . $emp["surname"] .'</h2></div>';

    $calendar .= "<div class=\"col-xs-1\" style=\"margin-top: 15px\">
        <input id=\"editingView\" type=\"checkbox\" data-toggle=\"toggle\" onchange=\"changeEditView()\">
    </div>
    <form id=\"editingFormView\" style=\"display: none\">
        <div class=\"col-xs-3\" id=\"choice\" style=\"margin-top: 15px\">
            <select name=\"type_nep\" id=\"type_nep_view\" class=\"form-control\" onchange=\"changeTypeView(this[this.selectedIndex].value)\">
                <option value=" .'{"farba":"white","skratka":"x"}' . " selected>zrušiť</option>";

    $sql = "SELECT * from typ_nepritomnosti";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $calendar .= '<option value=\'{"farba":"'.$row["farba"].'","skratka":"'.$row["skratka"].'"}\'>' . $row["nazov"] . '</option>';
    }

    $calendar .= "</select></div> <div class=\"col-xs-1\" style=\"margin-top: 10px\">
                            <button type=\"button\" class=\"btn btn-primary\" style=\"margin-top: 5px\" onclick=\"saveView()\">Uložiť</button>
                        </div>
                    </form></div>";

    // Create the table tag opener and day headers

    $calendar .= "<table class='table table-bordered' id='table_view'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    // Create the calendar headers

    foreach($daysOfWeek as $day) {
        $calendar .= "<th class='monthDay'>$day</th>";
    }

    // Create the rest of the calendar

    // Initiate the day counter, starting with the 1st.

    $currentDay = 1;

    $calendar .= "</tr><tr>";

    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    $sql = "SELECT id_typu, datum from nepritomnosti where id_zamestnanca = " . $id. ' AND MONTH(datum) = ' . $month . ' ORDER BY datum';
    $nepr = $conn->query($sql);

    if($nepr->num_rows > 0){
        $d = $nepr->fetch_assoc();
    } else {
        $d = null;
    }
    $sql = "SELECT * FROM typ_nepritomnosti";
    $result = $conn->query($sql);

    $typy = [];
    $skratky = [];
    while($row = $result->fetch_assoc()) {
        $typy[$row["id"]] = $row["farba"];
        $skratky[$row["id"]] = $row["skratka"];
    }


    while ($currentDay <= $numberDays) {

        // Seventh column (Saturday) reached. Start a new row.

        if ($dayOfWeek == 7) {

            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";

        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

        $date = "$year-$month-$currentDayRel";
        if($d  != null) {
            if (strcmp($d["datum"], $date) == 0) {
                $calendar .= "<td class='unselectable' rel='".$skratky[$d["id_typu"]]."' style='background-color: " . $typy[$d["id_typu"]] . "'>$currentDay</td>";
                $d = $nepr->fetch_assoc();
            } else {
                $calendar .= "<td class='unselectable' rel=''>$currentDay</td>";
            }
        } else {
            $calendar .= "<td class='unselectable' rel=''>$currentDay</td>";
        }

        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
    }
    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;

}