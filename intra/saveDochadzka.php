<?php
require_once __DIR__ . '/../general_functions.php';

$data = json_decode(stripslashes($_POST['data']));
$conn = new_connection();

$sql = "SELECT * FROM typ_nepritomnosti";
$result = $conn->query($sql);

$typy = [];
while($row = $result->fetch_assoc()) {
    $typy[$row["skratka"]] = $row["id"];
}

foreach($data->employee as $emp){

    $sql = "SELECT * FROM nepritomnosti WHERE id_zamestnanca = " . $emp->id;
    $result = $conn->query($sql);

    $nepr = array();
    while($row = $result->fetch_assoc()) {
        array_push($nepr, $row);
    }

    foreach ($emp->absent as $item){
        $notFound = true;
        if(strcmp($item->type,"x") == 0){
            $delete = "DELETE FROM nepritomnosti WHERE id_zamestnanca = " . $emp->id . " AND datum = '" . $item->date . "'";
            updateSql($delete);
            continue;
        }
        foreach ($nepr as $row) {
            if(strcmp($row["datum"],$item->date) == 0){
                $notFound = false;
                if(strcmp($row["id_typu"], $typy[$item->type]) !== 0){
                    $update = "UPDATE nepritomnosti SET id_typu =" . $typy[$item->type] ." WHERE id = " . $row["id"];
                    updateSql($update);
                    break;
                }
            }
        }
        if($notFound){
            $insert = 'INSERT INTO nepritomnosti VALUES (NULL,'. $emp->id . ',' . $typy[$item->type] . ",'" . $item->date . "')";
            updateSql($insert);
        }
    }
}