<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'en';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/study.css">
    <title>Study | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
</head>
<body data-spy="scroll" data-target="#navbar-custom" data-offset="20">
<?php
loadLanguageNavbar();
//loadNavbarSK();
?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Study</h1>
                <hr>
                <div id="section1" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH1">For aspirants to study</h2>
                    <div id="sectContent1">
                        <div class="bpStudy">
                            <h3>Bachelor study</h3>
                            <p>Information will be added later</p>
                            <p>Complete study plan for academic year 2017-2018: <a href="../docs/SP20172018b.pdf">SP20172018b.pdf</a></p>
                            <p>Additional information at <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                        <div class="ingStudy">
                            <h3>Master study</h3>
                            <b><p class="question">Prečo študovať na našom ústave?</p></b>
                            <div class="answers">
                                <p><span class="glyphicon glyphicon-ok-circle"></span> lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> Lorem ipsum dolor sit amet</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque</p>
                            </div>
                            <b><p class="question">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque?</p></b>
                            <div class="answers">
                                <p><span class="glyphicon glyphicon-briefcase"></span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque. Etiam a tempus massa, eu euismod lorem. Nam ac orci purus. Fusce ante lorem, vulputate vitae consectetur ut, euismod id enim.</p>
                            </div>
                            <div class="studyProgram jumbotron">
                                <h3 id="toggle1" class="line">Study program – 1. year</h3><button type="button" class="btn btn-lg" id="btnTogStudProgram">show <span class="glyphicon glyphicon-menu-down"></span></button>
                                <div class="studyProgramContent">
                                    <div class="winterSem">
                                        <hr class="hrStudy">
                                        <h3><b>Winter term</b></h3>
                                        <div class="winterSemContent answers">
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>CAE mechatronických systémov </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Metóda konečných prvkov </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Optimalizácia procesov v mechatronike </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Vývojové programové prostredia pre mechatronické systémy </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Lorem ipsum dolor sit amet</b></p>
                                        </div>
                                    </div>
                                    <div class="summerSem">
                                        <hr class="hrStudy">
                                        <h3><b>Summer term</b></h3>
                                        <div class="summerSemContent answers">
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Diplomový projekt 1 </b></p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Metódy číslicového riadenia  </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Multifyzikálne procesy v mechatronike </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Pokročilé informačné technológie </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Lorem ipsum dolor sit amet</b></p>
                                        </div>
                                    </div>
                                    <hr class="hrStudy">
                                    <div class="pvpElektronika">
                                        <h3 class="line nazovPVP">Lorem ipsum dolor sit amet, consectetur </h3>
                                        <button type="button" class="btn line" id="btnTogPVPe">show <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpElektronikaContent answers">
                                            <p><span class="glyphicon glyphicon-cd"></span> <b>Inteligentné mechatronické systémy </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><span class="glyphicon glyphicon-cd"></span> <b>MEMS - inteligentné senzory a aktuátory </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque. Etiam a tempus massa, eu euismod lorem. </p>
                                        </div>
                                    </div>
                                    <div class="pvpAutomobily">
                                        <h3 class="line nazovPVP">Lorem ipsum dolor sit amet, consectetur </h3>
                                        <button type="button" class="btn line" id="btnTogPVPa">show <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpAutomobilyContent answers">
                                            <p><img src="../images/icons/glyphicons-6-car.png"> <b>Transmisné systémy automobilov a elektromobilov </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><img src="../images/icons/glyphicons-6-car.png"> <b>Pohonné systémy a zdroje v elektromobiloch </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                    <div class="pvpInformatika">
                                        <h3 class="line nazovPVP">Lorem ipsum dolor sit amet, consectetur </h3>
                                        <button type="button" class="btn line" id="btnTogPVPi">show <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpInfoContent answers">
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>Inteligentné mechatronické systémy </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>Vybrané kapitoly z automatického riadenia pre mechatroniku </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>MEMS - inteligentné senzory a aktuátory </b>- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque. Etiam a tempus massa, eu euismod lorem.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>Complete study plan for academic year 2017-2018: <a href="../docs/SP20172018b.pdf">SP20172018b.pdf</a></p>
                            <table class="table tableStudy">
                                <tbody>
                                <tr><th>Admission exams to Master study</th><td>28.6.2017 o 10:00 v D124</td></tr>
                                <tr><th rowspan="5">Admission committee</th><td>prof. Ing. Mikuláš Huba, PhD. (head of committee)</td></tr>
                                <tr><td>prof. Ing. Justín Murín, DrSc. (head of committee)</td></tr>
                                <tr><td>prof. Ing. Viktor Ferencey, PhD.</td></tr>
                                <tr><td>prof. Ing. Štefan Kozák, PhD.</td></tr>
                                <tr><td>doc. Ing. Katarína Žáková, PhD.</td></tr>
                                </tbody>
                            </table>
                            <p>Additional information at <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section2" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH2">Bachelor study</h2>
                    <div class="generalInfo">
                        <h3 class="h3Study">General information</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy"><b>Schedule of bachelor study</b></h4>
                            <div class="harmonogram">
                                <table class="table">
                                    <tbody>
                                        <tr><th colspan="2">Winter term</th></tr>
                                        <tr><td>Education starts</td><td>19. 09. 2016</td></tr>
                                        <tr><td rowspan="3">Vacation</td><td>31. 10. 2016</td></tr>
                                        <tr><td>18. 11. 2016</td></tr>
                                        <tr><td>23. 12. 2016 – 01. 01. 2017</td></tr>
                                        <tr><td>Exam period starts</td><td>02. 01. 2017</td></tr>
                                        <tr><td>Exam period ends</td><td>12. 02. 2017</td></tr>
                                        <tr><th colspan="2">Summer term</th></tr>
                                        <tr><td>Education starts</td><td>13. 02. 2017</td></tr>
                                        <tr><td>Vacation</td><td>14. 04. 2017 – 18. 04. 2017</td></tr>
                                        <tr><td>Exam period starts</td><td>22. 05. 2017</td></tr>
                                        <tr><td>Exam period ends</td><td>02. 07. 2017</td></tr>
                                        <tr><th colspan="2">The end of bachelor study</th></tr>
                                        <tr><td>Assignment of final thesis</td><td>13. 02. 2017</td></tr>
                                        <tr><td>Handing-over of final thesis</td><td>19. 05. 2017</td></tr>
                                        <tr><td>State exams bachelor study</td><td>06. 07. 2017 – 07. 07. 2017</td></tr>
                                        <tr><td>Promotions of graduates bachelor study </td><td>14. 09. 2016</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <p>Study plan 2016-2017 <a href="../docs/SP20162017b.pdf">SP20162017b.pdf</a></p>
                            <p>Study order (<a href="../docs/studijny_poriadok.pdf">studijny_poriadok.pdf</a>)</p>
                            <p>Classification scale (<a href="../docs/klasifikacna_stupnica.pdf">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="bpPrace">
                        <h3>Bachelor thesis</h3>
                        <div class="bpPraceContent">
                            <div >
                                <h4 ><b>Instructions</b></h4>
                            <div>
                                <h4 class="hKoniec">Closing of subjects BP1, BP2, BZP</h4>
                                <div class="hKoniecDiv">
                                    <!--<p>Bakalársky projekt 1</p>-->
                                    <button type="button" class="btn lg" id="btnTogBP1">Bachelor project 1 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBP1" class="jumbotron">
                                    <table class="table">
                                        <!--<tr><th colspan="2">Bakalársky projekt 1</th></tr>-->
                                        <tr><td>Responsible</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                        <tr><td>Evaluation of subject</td><td>Lorem ipsum</td></tr>
                                        <tr><td>Standard time for fulfillment</td><td>3. year of bachelor study, winter term</td></tr>
                                        <tr><td colspan="2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vitae nisi eu pellentesque. Etiam a tempus massa, eu euismod lorem. Nam ac orci purus. Fusce ante lorem, vulputate vitae consectetur ut, euismod id enim.</td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogBP2">Bachelor project 2 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBP2" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Responsible</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                        <tr><td>Evaluation of subject</td><td>lorem ipsum</td></tr>
                                        <tr><td>Standard time for fulfillment</td><td>lorem ipsum dolor sit amet </td></tr>
                                        <tr><td colspan="2"><p>Pre získanie klasifikovaného zápočtu musí študent do dátumu špecifikovanom v harmonograme štúdia FEI STU odovzdať bakalársku prácu:</p>
                                                <p>1.	v elektronickej forme do AIS</p>
                                                <p>2.	v tlačenej forme v počte 2 kusy Ing. Sedlárovi? (A803)</p>
                                                <p>alebo odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku.</p>
                                                <p>Prácu na projekte hodnotí vedúci práce.</p>
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogBZP">Bakalárska záverečná práca <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBZP" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápočet</td></tr>
                                        <tr><td>Štandardný čas plnenia</td><td>3. roč. bakalárskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie skúšky musí študent obhájiť tému svojej diplomovej práce pred štátnicovou komisiou, ktorá zároveň udeľuje známku za obhajobu.
                                            </td></tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <h4><b>Voľné témy</b></h4>
                            <div class="volneTemyContentBP">
                                <h2 id="SIMKA">SIMKA TUTO</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section3" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH3">Inžinierske štúdium</h2>
                    <div class="generalInfo">
                        <h3>Všeobecné informácie</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy"><b>Harmonogram inžinierskeho štúdia</b></h4>
                            <div class="harmonogram">
                                <table class="table">
                                    <tbody>
                                    <tr><th colspan="2">Zimný semester</th></tr>
                                    <tr><td>Začiatok výučby v semestri</td><td>19. 09. 2016</td></tr>
                                    <tr><td rowspan="3">Prázdniny</td><td>31. 10. 2016</td></tr>
                                    <tr><td>18. 11. 2016</td></tr>
                                    <tr><td>23. 12. 2016 – 01. 01. 2017</td></tr>
                                    <tr><td>Začiatok skúškového obdobia</td><td>02. 01. 2017</td></tr>
                                    <tr><td>Ukončenie skúškového obdobia</td><td>12. 02. 2017</td></tr>
                                    <tr><th colspan="2">Letný semester</th></tr>
                                    <tr><td>Začiatok výučby v semestri</td><td>13. 02. 2017</td></tr>
                                    <tr><td>Prázdniny</td><td>14. 04. 2017 – 18. 04. 2017</td></tr>
                                    <tr><td>Začiatok skúškového obdobia</td><td>22. 05. 2017</td></tr>
                                    <tr><td>Ukončenie skúškového obdobia</td><td>02. 07. 2017</td></tr>
                                    <tr><th colspan="2">Záver inžinierskeho štúdia</th></tr>
                                    <tr><td>Zadanie diplomovej práce</td><td>13. 02. 2017</td></tr>
                                    <tr><td>Odovzdanie diplomovej práce</td><td>19. 05. 2017</td></tr>
                                    <tr><td>Štátne skúšky inžinierskeho štúdia</td><td>13. 06. 2017 – 16. 06. 2017</td></tr>
                                    <tr><td>Termín promócií </td><td>10. 07. 2017 – 14. 07. 2017</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <p>Študijný plán 2016-2017 <a href="../docs/SP20162017b.pdf">SP20162017b.pdf</a></p>
                            <p>Študijný poriadok (<a href="../docs/studijny_poriadok.pdf">studijny_poriadok.pdf</a>)</p>
                            <p>Klasifikačná stupnica (<a href="../docs/klasifikacna_stupnica.pdf">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="dpPrace">
                        <h3>Diplomové práce</h3>
                        <div class="dpPraceContent">
                            <h4><b>Pokyny</b></h4>
                            <div>
                                <h4 class="hKoniec">Ukončovanie predmetov DP1, DP2, DP3, DZP</h4>
                                <div class="hKoniecDiv">
                                    <button type="button" class="btn lg" id="btnTogDP1">Diplomový projekt 1 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP1" class="jumbotron">
                                    <table class="table">
                                        <!--<tr><th colspan="2">Bakalársky projekt 1</th></tr>-->
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápočet</td></tr>
                                        <tr><td>Štandardný čas plnenia</td><td>1. roč. inžinierskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie klasifikovaného zápočtu musí študent odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku. Prácu na projekte hodnotí vedúci práce.</td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP2">Diplomový projekt 2 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP2" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápočet</td></tr>
                                        <tr><td>Štandardný čas plnenia</td><td>2. roč. inžinierskeho štúdia, zimný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie klasifikovaného zápočtu musí študent odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.januára daného roku a obhájiť svoje priebežné výsledky pred minimálne 2-člennou komisiou (jej členom by mal byť vedúci práce). Prácu na projekte hodnotí komisia pri obhajobe, ktorá zoberie do úvahy hodnotenie vedúceho práce.
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP3">Diplomový projekt 3 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP3" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápočet</td></tr>
                                        <tr><td>Štandardný čas plnenia</td><td>2. roč. inžinierskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2"><p>Pre získanie klasifikovaného zápočtu musí študent do dátumu špecifikovanom v harmonograme štúdia FEI STU odovzdať diplomovú prácu:</p>
                                                <p>1.	v elektronickej forme do AIS</p>
                                                <p>2.	v tlačenej forme v počte 2 kusy Ing. Sedlárovi? (A803)</p>
                                                <p>alebo odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku.</p>
                                                <p>Prácu na projekte hodnotí vedúci práce.</p>
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDZP">Diplomová záverečná práca <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDZP" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>skúška</td></tr>
                                        <tr><td>Štandardný čas plnenia</td><td>2. roč. inžinierskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie skúšky musí študent obhájiť tému svojej diplomovej práce pred štátnicovou komisiou, ktorá zároveň udeľuje známku za obhajobu.
                                            </td></tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <h4><b>Voľné témy</b></h4>
                            <div class="volneTemyContentDP">
                                <h2 id="SIMKA">SIMKA TUTO</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section4" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH4">Doktorandské štúdium</h2>
                    <p>Informácie budú dodané neskôr.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
loadLanguageFooter();
loadJScripts();
?>
<script src="../js/scripty_study.js"></script>
</body>
</html>