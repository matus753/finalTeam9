<?php
    require_once '../general_functions.php';
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'sk';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Domov | ÚAMT FEI STU</title>
    <?php
        loadHead();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/scripty_themesBP.js"></script>
   <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style_themes.css">
</head>
<body>
   <?php loadLanguageNavbar();  ?>
   <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"> 
                    
                    <h1>Voľné diplomové témy</h1>
                    <hr>
                    <?php  
                       if (!isset($_POST['potvrd_ustav'])) {
                          $ustav_typ = "642";
                        }
                        else {
                            $ustav_typ = $_POST['ustav'];
                        }
                      ?>
     
                    <form action="#" method="post"  name="form1" class="form-inline"> 
                      <h2>Ústav: </h2>
                      <select name="ustav" id="ustav_opt" class="form-control">
                        <option value="642" <?php if ($ustav_typ=="642") {echo "selected";} else {echo "";} ?>>Ústav automobilovej mechatroniky</option>
                        <option value="548" <?php if ($ustav_typ=="548") {echo "selected";} else {echo "";} ?>>Ústav elektroenergetiky a aplikovanej elektrotechniky </option>
                        <option value="549" <?php if ($ustav_typ=="549") {echo "selected";} else {echo "";} ?>>Ústav elektroniky a fotoniky</option>
                        <option value="550" <?php if ($ustav_typ=="550") {echo "selected";} else {echo "";} ?>>Ústav elektrotechniky</option>
                        <option value="816" <?php if ($ustav_typ=="816") {echo "selected";} else {echo "";} ?>>Ústav informatiky a matematiky</option>
                        <option value="817" <?php if ($ustav_typ=="817") {echo "selected";} else {echo "";} ?>>Ústav jadrového a fyzikálneho inžinierstva</option>
                        <option value="818" <?php if ($ustav_typ=="818") {echo "selected";} else {echo "";} ?>>Ústav multimediálnych informačných a komunikačných technológií</option>
                        <option value="356" <?php if ($ustav_typ=="356") {echo "selected";} else {echo "";} ?>>Ústav robotiky a kybernetiky</option>
                      </select>                  
                      <input type="submit" name="potvrd_ustav" value="Zobraz" id="ustav_submit" class="btn btn-md btn-zobraz" />
                    </form>
                                                     
                    <h2>Filter:</h2>
                    <div class="form-inline themes-filter">
                        <input type="text" id="SS-input-skolitel" onkeyup="filterSkolitel()" placeholder="Filter pre školiteľov.." title="Zadajte meno školiteľa" class="form-control mb-2 mr-sm-2 mb-sm-0">
                        <input type="text" id="SS-input-program" onkeyup="filterProgram()" placeholder="Filter pre študiný program.." title="Zadaj študiný program" class="form-control mb-2 mr-sm-2 mb-sm-0">
                    </div>                             
            
                    <?php    
                        $urltopost = "http://is.stuba.sk/pracoviste/prehled_temat.pl";
                        $datatopost = array (
                            "lang" => "sk",
                            "filtr_typtemata2" => 2,
                            "filtr_programtemata2" => "1",
                            "filtr_vedtemata2" => "0",
                            "pracoviste" => $ustav_typ,
                            'omezit_temata2' => 'Obmedziť',
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
                        $tableRows = $xPath->query('//html/body/div/div/div/form/table[last()]/tbody/tr');

                    ?>
                    <div class="jumbotron" style="overflow-x: auto">
                        <table id="SS-table-themes-BP" class="table table-hover">
                            <tr class="dark-blue-color-bg">
                                <th onclick="sortTable(0)" style="cursor:pointer"><i class="fa fa-sort"></i> Názov projektu</th>
                                <th onclick="sortTable(1)" style="cursor:pointer" class="center"><i class="fa fa-sort"></i> Meno školiteľa</th>
                                <th onclick="sortTable(2)" style="cursor:pointer" class="center"><i class="fa fa-sort"></i> Študiný program</th>
                            </tr>
                            <?php

                                foreach ($tableRows as $value) {
                                    $obsadenost = explode('/',trim($value->childNodes[8]->textContent));
                                    if (((string)$obsadenost[1] == (string)" --")  || (intval($obsadenost[0]) < intval($obsadenost[1])) ) {                             
                                        echo '<tr class="m" data-url="'. $value->childNodes[7]->firstChild->firstChild->getAttribute('href').'" data-title="'.$value->childNodes[2]->textContent.'" data-toggle="modal" data-target="#modal-bp-themes">';
                                            echo '<td><i class="fa fa-search-plus themes-icon-plus"> </i>'.$value->childNodes[2]->textContent.'</td>';
                                            echo "<td class='center'>".$value->childNodes[3]->textContent."</td>";
                                            echo "<td class='center'>".$value->childNodes[5]->textContent."</td>";
                                        echo "</tr>";
                                    }
                                }                    
                            ?>
                        </table>
                    </div> 
                    <div class=" btn-center">
                        <a href="study.php#section3" class="btn btn-md btn-zobraz" role="button">Späť na Štúdium</a>
                    </div>
                    </div>
                  </div>

                  <!-- Modal -->
                    <div class="modal fade" id="modal-bp-themes" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           </div>
                            <div class="modal-body">
                                <h2 class="bold">Názov práce: </h2>
                                <h3 id="modalAnotacia" class="modal-theme-title"></h3>
                                <h2 class="bold">Anotácia:</h2>
                              <p id="anotaciaObsah"></p>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        loadLanguageFooter();
        loadJScripts();
    ?>

</body>
</html>