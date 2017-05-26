<?php
require_once __DIR__ . '/../general_functions.php';

function generateTable($m,$y,$isPdf, $filter){
    $str = "";

    if($isPdf){
        $str .= "<h1>Dochádzka za $m. $y</h1>";
    }

    $conn = new_connection();
    $days = array("Ne", "Po", "Ut", "St", "Št", "Pi", "So");
    if($filter == 0) {
        $sql = "SELECT id, name, surname FROM staff ORDER BY surname";
    } else if ($filter == 1) {
        $sql = "SELECT id, name, surname FROM staff WHERE staffRole='teacher' ORDER BY surname";
    } else {
        $sql = "SELECT id, name, surname FROM staff WHERE staffRole='doktorand' ORDER BY surname";
    }

    $result = $conn->query($sql);

    $number = cal_days_in_month(CAL_GREGORIAN, $m, $y);
    $str .= '<table class="table table-bordered" id="table"><thead><tr><th></th>';

    for ($x = 1; $x <= $number; $x++) {
        if(!$isPdf) {
            $str .= "<th class=\"fixed\">$x</th>";
        } else {
            $str .= "<th style=\"width: 35px; height: 35px; text-align: center\">$x</th>";
        }
    }
    $str .= '</tr><tr>';
    if(!$isPdf) {
        $str .= '<th style="display: none">ID</th>';
        $str .= '<th>Meno</th>';
    } else {
        $str .= '<th style="height: 35px; padding: 5px; text-align: center" >Meno</th>';
    }
    for ($x = 1; $x <= $number; $x++){
        $day = $days[date("w",strtotime($y . "-" . $m . "-" . $x))];
        if(!$isPdf) {
            if (strcmp($day, "Ne") == 0 || strcmp($day, "So") == 0)
                $str .= "<th style='background: slategray'>$day</th>";
            else
                $str .= "<th>$day</th>";
        } else {
            if (strcmp($day, "Ne") == 0 || strcmp($day, "So") == 0)
                $str .= "<th style='background: slategray; width: 35px; height: 35px; text-align: center'>$day</th>";
            else
                $str .= "<th style=\"width: 35px; height: 35px; text-align: center\">$day</th>";
        }
    }
    $str .= '</tr></thead>';
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["name"] !== "Admin") {
                $str .= '<tr>';
                if (!$isPdf) {
                    $str .= "<th style=\"display: none\">" . $row["id"] . "</th>";
                }
                $str .= "<th class='unselectable name' style=\"height: 35px; padding: 5px; text-align: center\" onclick='show(this)'>" . $row["name"] . " " . $row["surname"] . "</th>";
                $sql = "SELECT id_typu, datum from nepritomnosti where id_zamestnanca = " . $row["id"] . ' AND MONTH(datum) = ' . $m . ' AND YEAR(datum) = ' . $y .' ORDER BY datum';
                $nepr = $conn->query($sql);
                if ($nepr->num_rows > 0) {
                    $d = $nepr->fetch_assoc();
                    $timestamp = DateTime::createFromFormat("Y-m-d", $d["datum"])->format("d");
                } else {
                    $d = null;
                }
                for ($x = 1; $x <= $number; $x++) {
                    if ($d != null) {
                        if ($timestamp == $x) {
                            $sql = "SELECT skratka,farba from typ_nepritomnosti where id = " . $d["id_typu"];
                            $typ = $conn->query($sql);
                            $typsk = $typ->fetch_assoc();
                            $str .= '<td class="unselectable" style="background-color: ' . $typsk["farba"] . '">' . $typsk["skratka"] . "</td>";
                            $d = $nepr->fetch_assoc();
                            if ($d != null)
                                $timestamp = DateTime::createFromFormat("Y-m-d", $d["datum"])->format("d");
                        } else {
                            $str .= "<td class='unselectable'></td>";
                        }
                    } else {
                        $str .= "<td class='unselectable'></td>";
                    }
                }
                $str .= "</tr>";
            }
        }
    } else {
        $str .= "0 results";
    }
    $str .= '</table>';

    if($isPdf){
        $str .= '<div>';
        $sql = "SELECT * from typ_nepritomnosti";
        $result = $conn->query($sql);
        $str .= '<h3>Legenda</h3><ul>';
        while($row = $result->fetch_assoc()) {
            $str .= '<li><span style="background:'.$row["farba"].';">___</span>   '. $row["nazov"] .'</li>';
        }
        $str .= '</ul></div>';
    }

    return $str;
}

function build_month($month,$year, $id, $isPdf = false) {

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
    $calendar = "";
    $name = $emp["name"];
    $surname = $emp["surname"];
    session_start();

    if(!$isPdf) {
        $calendar .= '<div class="container"><form><div class="col-xs-3"><h2 style="margin-bottom: 5px">' . $name . ' ' . $surname . '</h2></div>';
        if(isAdmin() || isHr() || $emp["ldapLogin"] == $_SESSION["user"]) {
            $calendar .= "<div class=\"col-xs-1\">
                                <button type=\"button\" class=\"btn btn-primary\" style=\"margin-top: 16px\" onclick=\"generateMonthPdf($id,$month,$year)\">PDF</button>
                          </div>";
        }
        if(isAdmin() || isHr() || $emp["ldapLogin"] == $_SESSION["user"]) {
            $calendar .= "<div class=\"col-xs-1\" style=\"margin-top: 15px\">
                            <input id=\"editingView\" type=\"checkbox\" data-toggle=\"toggle\" onchange=\"changeEditView()\">
                        </div>";
        }
        $calendar .= "<div id=\"editingFormView\" style='display: none'><div class=\"col-xs-3\" id=\"choice\" style=\"margin-top: 15px\">
                            <select name=\"type_nep\" id=\"type_nep_view\" class=\"form-control\" onchange=\"changeTypeView(this[this.selectedIndex].value)\">
                                <option value=" . '{"farba":"white","skratka":"x"}' . " selected>zrušiť</option>";
                                if(isAdmin() || isHr()) {
                                    $sql = "SELECT * from typ_nepritomnosti";
                                } else {
                                    $sql = "SELECT * from typ_nepritomnosti WHERE skratka = 'PD'";
                                }
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {
                                    $calendar .= '<option value=\'{"farba":"' . $row["farba"] . '","skratka":"' . $row["skratka"] . '"}\'>' . $row["nazov"] . '</option>';
                                }
        $calendar .= "</select></div> <div class=\"col-xs-1\" style=\"margin-top: 10px\">
                            <button type=\"button\" class=\"btn btn-primary\" style=\"margin-top: 5px\" onclick=\"saveView()\">Uložiť</button>
                        </div></div>
                    </form></div>";
    }

    if($isPdf){
        $calendar .= "<h1>$name $surname</h1>";
    }

    // Create the table tag opener and day headers
    $calendar .= "<table class='table table-bordered' id='table_view'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    // Create the calendar headers
    foreach($daysOfWeek as $day) {
        $calendar .= "<th class='monthDay' style='text-align: center'>$day</th>";
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

    $sql = "SELECT id_typu, datum from nepritomnosti where id_zamestnanca = " . $id. ' AND MONTH(datum) = ' . $month . ' AND YEAR(datum) = ' . $year .' ORDER BY datum';
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

    if($isPdf){
        $calendar .= '<div>';
        $sql = "SELECT * from typ_nepritomnosti";
        $result = $conn->query($sql);
        $calendar .= '<h3>Legenda</h3><ul>';
        while($row = $result->fetch_assoc()) {
            $calendar .= '<li><span style="background:'.$row["farba"].';">___</span>   '. $row["nazov"] .'</li>';
        }
        $calendar .= '</ul></div>';
    }

    return $calendar;

}

function getCheckBox($id, $role, $type, $hasRole = ''){
    return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class='btn $type $hasRole' onclick='changeRole($id,$role)'>
				<input type='checkbox' autocomplete='off'>
				<span class='glyphicon glyphicon-ok'></span>
		  </label></div>";
}