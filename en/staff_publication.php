<?php

        if(isset($_GET['AISid'])){
	    $AISid  = $_GET['AISid'];
	}
        
 $urltopost = "http://is.stuba.sk/lide/clovek.pl";
    $datatopost = array (
        "lang" => "en",
        "zalozka" => "5",
        "id" => $AISid,
        "rok"=>"1",
        "order_by"=>"rok_uplatneni"
    );
    

    $ch = curl_init ($urltopost);

    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

    $returndata = curl_exec($ch);

    curl_close($ch);

    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($returndata);
    $xPath = new DOMXPath($doc);
    $tablePublikacia = $xPath->query('//html/body/div/div/div/table[3]/tbody/tr');
    $vys = "";
    $vys .= '<div style="overflow-x: auto;">';
    $vys .= '<table id="staff-table-publikace" class="table-horizontal table-bordered table-hover">
            <thead class="staff-table-publikace-head">
                <tr>
                    <th class="center">Ord.</th> 
                    <th class="center">Publications</th>
                    <th class="center">Type of result</th>
                    <th class="center">Year</th>
                </tr>
            </thead>';

    $por = 1;
    foreach ($tablePublikacia as $publ) {
        if ((intval($publ->childNodes[3]->textContent) > 2012) && (strpos($publ->childNodes[2]->textContent,"monographs") === 0)) {
            $vys .= '<tr>';
                $vys .= '<td class="bold" style="color: #5e6060;">'.$por++.'</td>';
                $vys .= '<td>'.$publ->childNodes[1]->textContent.'</td>';
                $vys .= '<td  style="color: #4890DB;">'.$publ->childNodes[2]->textContent.'</td>';
                $vys .= '<td>'.$publ->childNodes[3]->textContent.'</td>';
            $vys .= "</tr>";
        }
    }

    foreach ($tablePublikacia as $publ) {
        if ((intval($publ->childNodes[3]->textContent) > 2012) && (strpos($publ->childNodes[2]->textContent,"articles") === 0)) {
            $vys .= '<tr>';
                $vys .= '<td class="bold" style="color: #5e6060;">'.$por++.'</td>';
                $vys .= '<td>'.$publ->childNodes[1]->textContent.'</td>';
                $vys .= '<td  style="color: #3CDAB2;">'.$publ->childNodes[2]->textContent.'</td>';
                $vys .= "<td>".$publ->childNodes[3]->textContent."</td>";
            $vys .= "</tr>";
        }
    }

    foreach ($tablePublikacia as $publ) {
        if ((intval($publ->childNodes[3]->textContent) > 2012) && (strpos($publ->childNodes[2]->textContent,"contributions") === 0)) {
            $vys .= '<tr>';
                $vys .= '<td class="bold" style="color: #5e6060;">'.$por++.'</td>';
                $vys .= '<td>'.$publ->childNodes[1]->textContent.'</td>';
                $vys .= '<td  style="color: #FFD446;">'.$publ->childNodes[2]->textContent.'</td>';
                $vys .= "<td>".$publ->childNodes[3]->textContent."</td>";
            $vys .= "</tr>";
        }
    }
    $vys .= "</div>";
    echo $vys;
