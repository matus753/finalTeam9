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
    <title>Domov | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
</head>
<body>
<?php
loadLanguageNavbar();
//loadNavbarSK();
?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>O nás</h1>
                <hr>
                <div id="section1" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH1">Pre uchádzacov o štúdium</h2>
                    <div id="sectContent1">
                        <div class="bpStudy">
                            <h3>Bakalárske štúdium</h3>
                            <p>Informácie budú dodané neskôr.</p>
                            <p>Kompletný študijný plán pre akademický rok 2017-2018: <a href="../docs/SP20172018b.pdf">SP20172018b.pdf</a></p>
                            <p>Dalšie informácie na <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                        <div class="ingStudy">
                            <h3>Inžinierske štúdium</h3>
                            <b><p class="question">Preco študovat na našom ústave?</p></b>
                            <div class="answers">
                                <p><span class="glyphicon glyphicon-ok-circle"></span> možnost získat znalosti, ktoré sú implementovatelné v praxi</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> menšie skupiny študentov</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> možnost dohodnút si tému pre diplomovku s vybraným pedagógom na základe vlastných preferencií</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> možnost riešit diplomovú prácu a teda to, co každého zaujíma, až 3 semestre</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> pre vynikajúcich študentov možnost študovat dištancnou metódou</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> pre absolventov bakalárskeho štúdia na FEI STU odpustená prijímacia skúška</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> snaha o maximálnu informovanost študentov prostredníctvom web stránky v dostatocnom predstihu</p>
                            </div>
                            <b><p class="question">Nebudem mat problémy, ked som neštudoval mechatroniku aj na bakalárskom štúdiu?</p></b>
                            <div class="answers">
                                <p><span class="glyphicon glyphicon-briefcase"></span> Mechatronika predstavuje medziodborové štúdium, takže každý by sa tu mal nájst. Hned v prvom semestri inžinierskeho štúdia je pre študentov, ktorí predtým neštudovali mechatroniku pripravený vyrovnávací predmet z oblasti automatizácie.</p>
                            </div>
                            <div class="studyProgram jumbotron">
                                <h3 id="toggle1" class="line">Študijný program – 1. rocník</h3><button type="button" class="btn btn-lg" id="btnTogStudProgram">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                <div class="studyProgramContent">
                                    <div class="winterSem">
                                        <hr class="hrStudy">
                                        <h3><b>Zimný semester</b></h3>
                                        <div class="winterSemContent answers">
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>CAE mechatronických systémov </b>- tvorba virtuálnych dynamických modelov a ich simulácia</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Metóda konecných prvkov </b>- modelovanie a analýza mechatronických prvkov a systémov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Optimalizácia procesov v mechatronike </b>- optimalizacné úlohy a metódy v inžinierskych aplikáciách</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Vývojové programové prostredia pre mechatronické systémy </b>- programovanie mikroprocesorov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Povinne volitelný predmet</b></p>
                                        </div>
                                    </div>
                                    <div class="summerSem">
                                        <hr class="hrStudy">
                                        <h3><b>Letný semester</b></h3>
                                        <div class="summerSemContent answers">
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Diplomový projekt 1 </b></p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Metódy císlicového riadenia  </b>- návrh regulacných obvodov pre modely mechatronických systémov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Multifyzikálne procesy v mechatronike </b>- modelovanie tepelných, termoelastických, termoelektrických a piezoelektrických systémov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Pokrocilé informacné technológie </b>- klient-server aplikácie, riadenie mechatronických systémov v prostredí internetu, Internet vecí (IoT), Industry 4.0</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Povinne volitelný predmet</b></p>
                                        </div>
                                    </div>
                                    <hr class="hrStudy">
                                    <div class="pvpElektronika">
                                        <h3 class="line nazovPVP">Možné PVP pre záujemcov o elektroniku </h3>
                                        <button type="button" class="btn line" id="btnTogPVPe">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpElektronikaContent answers">
                                            <p><span class="glyphicon glyphicon-cd"></span> <b>Inteligentné mechatronické systémy </b>- implementácia metód výpoctovej a umelej inteligencie pre mechatronické systémy</p>
                                            <p><span class="glyphicon glyphicon-cd"></span> <b>MEMS - inteligentné senzory a aktuátory </b>- najmodernejšie senzory používané nielen v automobilovom priemysle (akcelerometre, gyroskopy, CCD senzory) a spracovanie signálov vnorenými mikropocítacmi</p>
                                        </div>
                                    </div>
                                    <div class="pvpAutomobily">
                                        <h3 class="line nazovPVP">Možné PVP pre záujemcov o automobily </h3>
                                        <button type="button" class="btn line" id="btnTogPVPa">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpAutomobilyContent answers">
                                            <p><img src="../images/icons/glyphicons-6-car.png"> <b>Transmisné systémy automobilov a elektromobilov </b>- prevodové mechanizmy automobilov a elektromobilov</p>
                                            <p><img src="../images/icons/glyphicons-6-car.png"> <b>Pohonné systémy a zdroje v elektromobiloch </b>- modelovanie a simulovanie cinnosti trakcného a energetického systému elektromobilu</p>
                                        </div>
                                    </div>
                                    <div class="pvpInformatika">
                                        <h3 class="line nazovPVP">Možné PVP pre záujemcov o informatiku </h3>
                                        <button type="button" class="btn line" id="btnTogPVPi">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpInfoContent answers">
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>Inteligentné mechatronické systémy </b>- implementácia metód výpoctovej a umelej inteligencie pre mechatronické systémy</p>
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>Vybrané kapitoly z automatického riadenia pre mechatroniku </b>- vyrovnávací predmet z automatizácie</p>
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>MEMS - inteligentné senzory a aktuátory </b>- najmodernejšie senzory používané nielen v automobilovom priemysle (akcelerometre, gyroskopy, CCD senzory) a spracovanie signálov vnorenými mikropocítacmi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>Kompletný študijný plán pre akademický rok 2017-2018: <a href="../docs/SP20172018b.pdf">SP20172018b.pdf</a></p>
                            <table class="table tableStudy">
                                <tbody>
                                <tr><th>Prijímacie skúšky na inžinierske štúdium</th><td>28.6.2017 o 10:00 v D124</td></tr>
                                <tr><th rowspan="5">Prijímacia komisia</th><td>prof. Ing. Mikuláš Huba, PhD. (predseda)</td></tr>
                                <tr><td>prof. Ing. Justín Murín, DrSc. (predseda)</td></tr>
                                <tr><td>prof. Ing. Viktor Ferencey, PhD.</td></tr>
                                <tr><td>prof. Ing. Štefan Kozák, PhD.</td></tr>
                                <tr><td>doc. Ing. Katarína Žáková, PhD.</td></tr>
                                </tbody>
                            </table>
                            <p>Dalšie informácie na <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section2" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH2">Bakalárske štúdium</h2>
                    <div class="generalInfo">
                        <h3 class="h3Study">Všeobecné informácie</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy"><b>Harmonogram bakalárskeho štúdia</b></h4>
                            <div class="harmonogram">
                                <table class="table">
                                    <tbody>
                                        <tr><th colspan="2">Zimný semester</th></tr>
                                        <tr><td>Zaciatok výucby v semestri</td><td>19. 09. 2016</td></tr>
                                        <tr><td rowspan="3">Prázdniny</td><td>31. 10. 2016</td></tr>
                                        <tr><td>18. 11. 2016</td></tr>
                                        <tr><td>23. 12. 2016 – 01. 01. 2017</td></tr>
                                        <tr><td>Zaciatok skúškového obdobia</td><td>02. 01. 2017</td></tr>
                                        <tr><td>Ukoncenie skúškového obdobia</td><td>12. 02. 2017</td></tr>
                                        <tr><th colspan="2">Letný semester</th></tr>
                                        <tr><td>Zaciatok výucby v semestri</td><td>13. 02. 2017</td></tr>
                                        <tr><td>Prázdniny</td><td>14. 04. 2017 – 18. 04. 2017</td></tr>
                                        <tr><td>Zaciatok skúškového obdobia</td><td>22. 05. 2017</td></tr>
                                        <tr><td>Ukoncenie skúškového obdobia</td><td>02. 07. 2017</td></tr>
                                        <tr><th colspan="2">Záver bakalárskeho štúdia</th></tr>
                                        <tr><td>Zadanie záverecnej práce</td><td>13. 02. 2017</td></tr>
                                        <tr><td>Odovzdanie záverecnej práce</td><td>19. 05. 2017</td></tr>
                                        <tr><td>Štátne skúšky bakalárskeho štúdia</td><td>06. 07. 2017 – 07. 07. 2017</td></tr>
                                        <tr><td>Promócie absolventov bakalárskeho štúdia </td><td>14. 09. 2016</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <p>Študijný plán 2016-2017 <a href="../docs/SP20162017b.pdf">SP20162017b.pdf</a></p>
                            <p>Študijný poriadok (<a href="../docs/studijny_poriadok.pdf">studijny_poriadok.pdf</a>)</p>
                            <p>Klasifikacná stupnica (<a href="../docs/klasifikacna_stupnica.pdf">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="bpPrace">
                        <h3>Bakalárske práce</h3>
                        <div class="bpPraceContent">
                            <div >
                                <h4 ><b>Pokyny</b></h4>
                            <div>
                                <h4 class="hKoniec">Ukoncovanie predmetov BP1, BP2, BZP</h4>
                                <div class="hKoniecDiv">
                                    <!--<p>Bakalársky projekt 1</p>-->
                                    <button type="button" class="btn lg" id="btnTogBP1">Bakalársky projekt 1 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBP1" class="jumbotron">
                                    <table class="table">
                                        <!--<tr><th colspan="2">Bakalársky projekt 1</th></tr>-->
                                        <tr><td>Zodpovedný</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápocet</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>3. roc. bakalárskeho štúdia, zimný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie klasifikovaného zápoctu musí študent odovzdat technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.januára daného roku. Prácu na projekte hodnotí vedúci práce.</td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogBP2">Bakalársky projekt 2 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBP2" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápocet</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>3. roc. bakalárskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2"><p>Pre získanie klasifikovaného zápoctu musí študent do dátumu špecifikovanom v harmonograme štúdia FEI STU odovzdat bakalársku prácu:</p>
                                                <p>1.	v elektronickej forme do AIS</p>
                                                <p>2.	v tlacenej forme v pocte 2 kusy Ing. Sedlárovi? (A803)</p>
                                                <p>alebo odovzdat technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku.</p>
                                                <p>Prácu na projekte hodnotí vedúci práce.</p>
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogBZP">Bakalárska záverecná práca <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBZP" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápocet</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>3. roc. bakalárskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie skúšky musí študent obhájit tému svojej diplomovej práce pred štátnicovou komisiou, ktorá zároven udeluje známku za obhajobu.
                                            </td></tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <h4><b>Volné témy</b></h4>
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
                                    <tr><td>Zaciatok výucby v semestri</td><td>19. 09. 2016</td></tr>
                                    <tr><td rowspan="3">Prázdniny</td><td>31. 10. 2016</td></tr>
                                    <tr><td>18. 11. 2016</td></tr>
                                    <tr><td>23. 12. 2016 – 01. 01. 2017</td></tr>
                                    <tr><td>Zaciatok skúškového obdobia</td><td>02. 01. 2017</td></tr>
                                    <tr><td>Ukoncenie skúškového obdobia</td><td>12. 02. 2017</td></tr>
                                    <tr><th colspan="2">Letný semester</th></tr>
                                    <tr><td>Zaciatok výucby v semestri</td><td>13. 02. 2017</td></tr>
                                    <tr><td>Prázdniny</td><td>14. 04. 2017 – 18. 04. 2017</td></tr>
                                    <tr><td>Zaciatok skúškového obdobia</td><td>22. 05. 2017</td></tr>
                                    <tr><td>Ukoncenie skúškového obdobia</td><td>02. 07. 2017</td></tr>
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
                            <p>Klasifikacná stupnica (<a href="../docs/klasifikacna_stupnica.pdf">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="dpPrace">
                        <h3>Diplomové práce</h3>
                        <div class="dpPraceContent">
                            <h4><b>Pokyny</b></h4>
                            <div>
                                <h4 class="hKoniec">Ukoncovanie predmetov DP1, DP2, DP3, DZP</h4>
                                <div class="hKoniecDiv">
                                    <button type="button" class="btn lg" id="btnTogDP1">Diplomový projekt 1 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP1" class="jumbotron">
                                    <table class="table">
                                        <!--<tr><th colspan="2">Bakalársky projekt 1</th></tr>-->
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápocet</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>1. roc. inžinierskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie klasifikovaného zápoctu musí študent odovzdat technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku. Prácu na projekte hodnotí vedúci práce.</td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP2">Diplomový projekt 2 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP2" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápocet</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>2. roc. inžinierskeho štúdia, zimný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie klasifikovaného zápoctu musí študent odovzdat technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.januára daného roku a obhájit svoje priebežné výsledky pred minimálne 2-clennou komisiou (jej clenom by mal byt vedúci práce). Prácu na projekte hodnotí komisia pri obhajobe, ktorá zoberie do úvahy hodnotenie vedúceho práce.
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP3">Diplomový projekt 3 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP3" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovaný zápocet</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>2. roc. inžinierskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2"><p>Pre získanie klasifikovaného zápoctu musí študent do dátumu špecifikovanom v harmonograme štúdia FEI STU odovzdat diplomovú prácu:</p>
                                                <p>1.	v elektronickej forme do AIS</p>
                                                <p>2.	v tlacenej forme v pocte 2 kusy Ing. Sedlárovi? (A803)</p>
                                                <p>alebo odovzdat technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku.</p>
                                                <p>Prácu na projekte hodnotí vedúci práce.</p>
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDZP">Diplomová záverecná práca <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDZP" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedný</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>skúška</td></tr>
                                        <tr><td>Štandardný cas plnenia</td><td>2. roc. inžinierskeho štúdia, letný semester</td></tr>
                                        <tr><td colspan="2">Pre získanie skúšky musí študent obhájit tému svojej diplomovej práce pred štátnicovou komisiou, ktorá zároven udeluje známku za obhajobu.
                                            </td></tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <h4><b>Volné témy</b></h4>
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