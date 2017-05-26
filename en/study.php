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
    <title>Domov | �AMT FEI STU</title>
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
                <h1>O n�s</h1>
                <hr>
                <div id="section1" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH1">Pre uch�dzacov o �t�dium</h2>
                    <div id="sectContent1">
                        <div class="bpStudy">
                            <h3>Bakal�rske �t�dium</h3>
                            <p>Inform�cie bud� dodan� nesk�r.</p>
                            <p>Kompletn� �tudijn� pl�n pre akademick� rok 2017-2018: <a href="../docs/SP20172018b.pdf">SP20172018b.pdf</a></p>
                            <p>Dal�ie inform�cie na <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                        <div class="ingStudy">
                            <h3>In�inierske �t�dium</h3>
                            <b><p class="question">Preco �tudovat na na�om �stave?</p></b>
                            <div class="answers">
                                <p><span class="glyphicon glyphicon-ok-circle"></span> mo�nost z�skat znalosti, ktor� s� implementovateln� v praxi</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> men�ie skupiny �tudentov</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> mo�nost dohodn�t si t�mu pre diplomovku s vybran�m pedag�gom na z�klade vlastn�ch preferenci�</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> mo�nost rie�it diplomov� pr�cu a teda to, co ka�d�ho zauj�ma, a� 3 semestre</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> pre vynikaj�cich �tudentov mo�nost �tudovat di�tancnou met�dou</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> pre absolventov bakal�rskeho �t�dia na FEI STU odpusten� prij�macia sk��ka</p>
                                <p><span class="glyphicon glyphicon-ok-circle"></span> snaha o maxim�lnu informovanost �tudentov prostredn�ctvom web str�nky v dostatocnom predstihu</p>
                            </div>
                            <b><p class="question">Nebudem mat probl�my, ked som ne�tudoval mechatroniku aj na bakal�rskom �t�diu?</p></b>
                            <div class="answers">
                                <p><span class="glyphicon glyphicon-briefcase"></span> Mechatronika predstavuje medziodborov� �t�dium, tak�e ka�d� by sa tu mal n�jst. Hned v prvom semestri in�inierskeho �t�dia je pre �tudentov, ktor� predt�m ne�tudovali mechatroniku pripraven� vyrovn�vac� predmet z oblasti automatiz�cie.</p>
                            </div>
                            <div class="studyProgram jumbotron">
                                <h3 id="toggle1" class="line">�tudijn� program � 1. rocn�k</h3><button type="button" class="btn btn-lg" id="btnTogStudProgram">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                <div class="studyProgramContent">
                                    <div class="winterSem">
                                        <hr class="hrStudy">
                                        <h3><b>Zimn� semester</b></h3>
                                        <div class="winterSemContent answers">
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>CAE mechatronick�ch syst�mov </b>- tvorba virtu�lnych dynamick�ch modelov a ich simul�cia</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Met�da konecn�ch prvkov </b>- modelovanie a anal�za mechatronick�ch prvkov a syst�mov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Optimaliz�cia procesov v mechatronike </b>- optimalizacn� �lohy a met�dy v in�inierskych aplik�ci�ch</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>V�vojov� programov� prostredia pre mechatronick� syst�my </b>- programovanie mikroprocesorov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Povinne voliteln� predmet</b></p>
                                        </div>
                                    </div>
                                    <div class="summerSem">
                                        <hr class="hrStudy">
                                        <h3><b>Letn� semester</b></h3>
                                        <div class="summerSemContent answers">
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Diplomov� projekt 1 </b></p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Met�dy c�slicov�ho riadenia  </b>- n�vrh regulacn�ch obvodov pre modely mechatronick�ch syst�mov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Multifyzik�lne procesy v mechatronike </b>- modelovanie tepeln�ch, termoelastick�ch, termoelektrick�ch a piezoelektrick�ch syst�mov</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Pokrocil� informacn� technol�gie </b>- klient-server aplik�cie, riadenie mechatronick�ch syst�mov v prostred� internetu, Internet vec� (IoT), Industry 4.0</p>
                                            <p><span class="glyphicon glyphicon-list-alt"></span> <b>Povinne voliteln� predmet</b></p>
                                        </div>
                                    </div>
                                    <hr class="hrStudy">
                                    <div class="pvpElektronika">
                                        <h3 class="line nazovPVP">Mo�n� PVP pre z�ujemcov o elektroniku </h3>
                                        <button type="button" class="btn line" id="btnTogPVPe">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpElektronikaContent answers">
                                            <p><span class="glyphicon glyphicon-cd"></span> <b>Inteligentn� mechatronick� syst�my </b>- implement�cia met�d v�poctovej a umelej inteligencie pre mechatronick� syst�my</p>
                                            <p><span class="glyphicon glyphicon-cd"></span> <b>MEMS - inteligentn� senzory a aktu�tory </b>- najmodernej�ie senzory pou��van� nielen v automobilovom priemysle (akcelerometre, gyroskopy, CCD senzory) a spracovanie sign�lov vnoren�mi mikropoc�tacmi</p>
                                        </div>
                                    </div>
                                    <div class="pvpAutomobily">
                                        <h3 class="line nazovPVP">Mo�n� PVP pre z�ujemcov o automobily </h3>
                                        <button type="button" class="btn line" id="btnTogPVPa">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpAutomobilyContent answers">
                                            <p><img src="../images/icons/glyphicons-6-car.png"> <b>Transmisn� syst�my automobilov a elektromobilov </b>- prevodov� mechanizmy automobilov a elektromobilov</p>
                                            <p><img src="../images/icons/glyphicons-6-car.png"> <b>Pohonn� syst�my a zdroje v elektromobiloch </b>- modelovanie a simulovanie cinnosti trakcn�ho a energetick�ho syst�mu elektromobilu</p>
                                        </div>
                                    </div>
                                    <div class="pvpInformatika">
                                        <h3 class="line nazovPVP">Mo�n� PVP pre z�ujemcov o informatiku </h3>
                                        <button type="button" class="btn line" id="btnTogPVPi">zobraz <span class="glyphicon glyphicon-menu-down"></span></button>
                                        <div class="pvpInfoContent answers">
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>Inteligentn� mechatronick� syst�my </b>- implement�cia met�d v�poctovej a umelej inteligencie pre mechatronick� syst�my</p>
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>Vybran� kapitoly z automatick�ho riadenia pre mechatroniku </b>- vyrovn�vac� predmet z automatiz�cie</p>
                                            <p><img src="../images/icons/glyphicons-161-imac.png"> <b>MEMS - inteligentn� senzory a aktu�tory </b>- najmodernej�ie senzory pou��van� nielen v automobilovom priemysle (akcelerometre, gyroskopy, CCD senzory) a spracovanie sign�lov vnoren�mi mikropoc�tacmi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>Kompletn� �tudijn� pl�n pre akademick� rok 2017-2018: <a href="../docs/SP20172018b.pdf">SP20172018b.pdf</a></p>
                            <table class="table tableStudy">
                                <tbody>
                                <tr><th>Prij�macie sk��ky na in�inierske �t�dium</th><td>28.6.2017 o 10:00 v D124</td></tr>
                                <tr><th rowspan="5">Prij�macia komisia</th><td>prof. Ing. Mikul� Huba, PhD. (predseda)</td></tr>
                                <tr><td>prof. Ing. Just�n Mur�n, DrSc. (predseda)</td></tr>
                                <tr><td>prof. Ing. Viktor Ferencey, PhD.</td></tr>
                                <tr><td>prof. Ing. �tefan Koz�k, PhD.</td></tr>
                                <tr><td>doc. Ing. Katar�na ��kov�, PhD.</td></tr>
                                </tbody>
                            </table>
                            <p>Dal�ie inform�cie na <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section2" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH2">Bakal�rske �t�dium</h2>
                    <div class="generalInfo">
                        <h3 class="h3Study">V�eobecn� inform�cie</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy"><b>Harmonogram bakal�rskeho �t�dia</b></h4>
                            <div class="harmonogram">
                                <table class="table">
                                    <tbody>
                                        <tr><th colspan="2">Zimn� semester</th></tr>
                                        <tr><td>Zaciatok v�ucby v semestri</td><td>19. 09. 2016</td></tr>
                                        <tr><td rowspan="3">Pr�zdniny</td><td>31. 10. 2016</td></tr>
                                        <tr><td>18. 11. 2016</td></tr>
                                        <tr><td>23. 12. 2016 � 01. 01. 2017</td></tr>
                                        <tr><td>Zaciatok sk��kov�ho obdobia</td><td>02. 01. 2017</td></tr>
                                        <tr><td>Ukoncenie sk��kov�ho obdobia</td><td>12. 02. 2017</td></tr>
                                        <tr><th colspan="2">Letn� semester</th></tr>
                                        <tr><td>Zaciatok v�ucby v semestri</td><td>13. 02. 2017</td></tr>
                                        <tr><td>Pr�zdniny</td><td>14. 04. 2017 � 18. 04. 2017</td></tr>
                                        <tr><td>Zaciatok sk��kov�ho obdobia</td><td>22. 05. 2017</td></tr>
                                        <tr><td>Ukoncenie sk��kov�ho obdobia</td><td>02. 07. 2017</td></tr>
                                        <tr><th colspan="2">Z�ver bakal�rskeho �t�dia</th></tr>
                                        <tr><td>Zadanie z�verecnej pr�ce</td><td>13. 02. 2017</td></tr>
                                        <tr><td>Odovzdanie z�verecnej pr�ce</td><td>19. 05. 2017</td></tr>
                                        <tr><td>�t�tne sk��ky bakal�rskeho �t�dia</td><td>06. 07. 2017 � 07. 07. 2017</td></tr>
                                        <tr><td>Prom�cie absolventov bakal�rskeho �t�dia </td><td>14. 09. 2016</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <p>�tudijn� pl�n 2016-2017 <a href="../docs/SP20162017b.pdf">SP20162017b.pdf</a></p>
                            <p>�tudijn� poriadok (<a href="../docs/studijny_poriadok.pdf">studijny_poriadok.pdf</a>)</p>
                            <p>Klasifikacn� stupnica (<a href="../docs/klasifikacna_stupnica.pdf">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="bpPrace">
                        <h3>Bakal�rske pr�ce</h3>
                        <div class="bpPraceContent">
                            <div >
                                <h4 ><b>Pokyny</b></h4>
                            <div>
                                <h4 class="hKoniec">Ukoncovanie predmetov BP1, BP2, BZP</h4>
                                <div class="hKoniecDiv">
                                    <!--<p>Bakal�rsky projekt 1</p>-->
                                    <button type="button" class="btn lg" id="btnTogBP1">Bakal�rsky projekt 1 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBP1" class="jumbotron">
                                    <table class="table">
                                        <!--<tr><th colspan="2">Bakal�rsky projekt 1</th></tr>-->
                                        <tr><td>Zodpovedn�</td><td>doc. Ing. Vladim�r Kuti�, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovan� z�pocet</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>3. roc. bakal�rskeho �t�dia, zimn� semester</td></tr>
                                        <tr><td colspan="2">Pre z�skanie klasifikovan�ho z�poctu mus� �tudent odovzdat technick� dokument�ciu svojmu ved�cemu pr�ce v nim �pecifikovanom rozsahu najnesk�r do 20.janu�ra dan�ho roku. Pr�cu na projekte hodnot� ved�ci pr�ce.</td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogBP2">Bakal�rsky projekt 2 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBP2" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedn�</td><td>doc. Ing. Vladim�r Kuti�, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovan� z�pocet</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>3. roc. bakal�rskeho �t�dia, letn� semester</td></tr>
                                        <tr><td colspan="2"><p>Pre z�skanie klasifikovan�ho z�poctu mus� �tudent do d�tumu �pecifikovanom v harmonograme �t�dia FEI STU odovzdat bakal�rsku pr�cu:</p>
                                                <p>1.	v elektronickej forme do AIS</p>
                                                <p>2.	v tlacenej forme v pocte 2 kusy Ing. Sedl�rovi? (A803)</p>
                                                <p>alebo odovzdat technick� dokument�ciu svojmu ved�cemu pr�ce v nim �pecifikovanom rozsahu najnesk�r do 20.j�na dan�ho roku.</p>
                                                <p>Pr�cu na projekte hodnot� ved�ci pr�ce.</p>
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogBZP">Bakal�rska z�verecn� pr�ca <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableBZP" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedn�</td><td>doc. Ing. Vladim�r Kuti�, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovan� z�pocet</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>3. roc. bakal�rskeho �t�dia, letn� semester</td></tr>
                                        <tr><td colspan="2">Pre z�skanie sk��ky mus� �tudent obh�jit t�mu svojej diplomovej pr�ce pred �t�tnicovou komisiou, ktor� z�roven udeluje zn�mku za obhajobu.
                                            </td></tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <h4><b>Voln� t�my</b></h4>
                            <div class="volneTemyContentBP">
                                <h2 id="SIMKA">SIMKA TUTO</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section3" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH3">In�inierske �t�dium</h2>
                    <div class="generalInfo">
                        <h3>V�eobecn� inform�cie</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy"><b>Harmonogram in�inierskeho �t�dia</b></h4>
                            <div class="harmonogram">
                                <table class="table">
                                    <tbody>
                                    <tr><th colspan="2">Zimn� semester</th></tr>
                                    <tr><td>Zaciatok v�ucby v semestri</td><td>19. 09. 2016</td></tr>
                                    <tr><td rowspan="3">Pr�zdniny</td><td>31. 10. 2016</td></tr>
                                    <tr><td>18. 11. 2016</td></tr>
                                    <tr><td>23. 12. 2016 � 01. 01. 2017</td></tr>
                                    <tr><td>Zaciatok sk��kov�ho obdobia</td><td>02. 01. 2017</td></tr>
                                    <tr><td>Ukoncenie sk��kov�ho obdobia</td><td>12. 02. 2017</td></tr>
                                    <tr><th colspan="2">Letn� semester</th></tr>
                                    <tr><td>Zaciatok v�ucby v semestri</td><td>13. 02. 2017</td></tr>
                                    <tr><td>Pr�zdniny</td><td>14. 04. 2017 � 18. 04. 2017</td></tr>
                                    <tr><td>Zaciatok sk��kov�ho obdobia</td><td>22. 05. 2017</td></tr>
                                    <tr><td>Ukoncenie sk��kov�ho obdobia</td><td>02. 07. 2017</td></tr>
                                    <tr><th colspan="2">Z�ver in�inierskeho �t�dia</th></tr>
                                    <tr><td>Zadanie diplomovej pr�ce</td><td>13. 02. 2017</td></tr>
                                    <tr><td>Odovzdanie diplomovej pr�ce</td><td>19. 05. 2017</td></tr>
                                    <tr><td>�t�tne sk��ky in�inierskeho �t�dia</td><td>13. 06. 2017 � 16. 06. 2017</td></tr>
                                    <tr><td>Term�n prom�ci� </td><td>10. 07. 2017 � 14. 07. 2017</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <p>�tudijn� pl�n 2016-2017 <a href="../docs/SP20162017b.pdf">SP20162017b.pdf</a></p>
                            <p>�tudijn� poriadok (<a href="../docs/studijny_poriadok.pdf">studijny_poriadok.pdf</a>)</p>
                            <p>Klasifikacn� stupnica (<a href="../docs/klasifikacna_stupnica.pdf">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="dpPrace">
                        <h3>Diplomov� pr�ce</h3>
                        <div class="dpPraceContent">
                            <h4><b>Pokyny</b></h4>
                            <div>
                                <h4 class="hKoniec">Ukoncovanie predmetov DP1, DP2, DP3, DZP</h4>
                                <div class="hKoniecDiv">
                                    <button type="button" class="btn lg" id="btnTogDP1">Diplomov� projekt 1 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP1" class="jumbotron">
                                    <table class="table">
                                        <!--<tr><th colspan="2">Bakal�rsky projekt 1</th></tr>-->
                                        <tr><td>Zodpovedn�</td><td>prof. Ing. Mikul� Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovan� z�pocet</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>1. roc. in�inierskeho �t�dia, letn� semester</td></tr>
                                        <tr><td colspan="2">Pre z�skanie klasifikovan�ho z�poctu mus� �tudent odovzdat technick� dokument�ciu svojmu ved�cemu pr�ce v nim �pecifikovanom rozsahu najnesk�r do 20.j�na dan�ho roku. Pr�cu na projekte hodnot� ved�ci pr�ce.</td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP2">Diplomov� projekt 2 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP2" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedn�</td><td>prof. Ing. Mikul� Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovan� z�pocet</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>2. roc. in�inierskeho �t�dia, zimn� semester</td></tr>
                                        <tr><td colspan="2">Pre z�skanie klasifikovan�ho z�poctu mus� �tudent odovzdat technick� dokument�ciu svojmu ved�cemu pr�ce v nim �pecifikovanom rozsahu najnesk�r do 20.janu�ra dan�ho roku a obh�jit svoje priebe�n� v�sledky pred minim�lne 2-clennou komisiou (jej clenom by mal byt ved�ci pr�ce). Pr�cu na projekte hodnot� komisia pri obhajobe, ktor� zoberie do �vahy hodnotenie ved�ceho pr�ce.
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP3">Diplomov� projekt 3 <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDP3" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedn�</td><td>prof. Ing. Mikul� Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>klasifikovan� z�pocet</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>2. roc. in�inierskeho �t�dia, letn� semester</td></tr>
                                        <tr><td colspan="2"><p>Pre z�skanie klasifikovan�ho z�poctu mus� �tudent do d�tumu �pecifikovanom v harmonograme �t�dia FEI STU odovzdat diplomov� pr�cu:</p>
                                                <p>1.	v elektronickej forme do AIS</p>
                                                <p>2.	v tlacenej forme v pocte 2 kusy Ing. Sedl�rovi? (A803)</p>
                                                <p>alebo odovzdat technick� dokument�ciu svojmu ved�cemu pr�ce v nim �pecifikovanom rozsahu najnesk�r do 20.j�na dan�ho roku.</p>
                                                <p>Pr�cu na projekte hodnot� ved�ci pr�ce.</p>
                                            </td></tr>
                                    </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDZP">Diplomov� z�verecn� pr�ca <span class="glyphicon glyphicon-menu-down"></span></button>
                                    <div id="tableDZP" class="jumbotron">
                                    <table class="table">
                                        <tr><td>Zodpovedn�</td><td>prof. Ing. Mikul� Huba, PhD.</td></tr>
                                        <tr><td>Hodnotenie predmetu</td><td>sk��ka</td></tr>
                                        <tr><td>�tandardn� cas plnenia</td><td>2. roc. in�inierskeho �t�dia, letn� semester</td></tr>
                                        <tr><td colspan="2">Pre z�skanie sk��ky mus� �tudent obh�jit t�mu svojej diplomovej pr�ce pred �t�tnicovou komisiou, ktor� z�roven udeluje zn�mku za obhajobu.
                                            </td></tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <h4><b>Voln� t�my</b></h4>
                            <div class="volneTemyContentDP">
                                <h2 id="SIMKA">SIMKA TUTO</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section4" class="sectionDiv">
                    <h2 class="sectionH2 sectItem" id="secH4">Doktorandsk� �t�dium</h2>
                    <p>Inform�cie bud� dodan� nesk�r.</p>
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