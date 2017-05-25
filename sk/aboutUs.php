<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'sk';
?>
<!DOCTYPE html>
<html>
<head>
    <title>O nás | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link href="../css/aboutUs.css" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#navbar-custom" data-offset="20">
<?php
    loadLanguageNavbar();

?>

<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>O nás</h1>
                <hr>
                    <div id="section1" class="sectionDiv">
                        <h3 class="sectionH2 sectItem" id="secH1">História</h3>
                        <div id="sectContent1">
                        <p>Ústav automobilovej mechatroniky bol zriadený k 1. júlu 2013 ako pedagogické a vedecko-výskumné pracovisko Fakulty elektrotechniky a informatiky STU v Bratislave. Zriadenie ústavu Automobilovej mechatroniky bolo logickým vyústením zámerov  vedenia Fakulty elektrotechniky a informatiky STU v Bratislave vytvoriť taký ústav, ktorý by zohľadňoval súčasné požiadavky a potreby automobilového priemyslu  na  Slovensku  s  hlavným  cieľom  pripravovať  absolventov bakalárskeho a  inžinierského štúdia pre oblasť automobilovej mechatroniky.</p>
                        <p class="y1">V súčasnosti Ústav automobilovej mechatroniky zabezpečuje výskum, vývoj a vzdelávanie  vo viacerých  oblastiach aplikovanej mechatroniky so špeciálnym dôrazom vo sfére  automobilovej mechatroniky  a  mechatronických  systémov  na  základe  integrácie  a synergie mechanických, elektronických,   informačných,   komunikačných   a   riadiacich   technológií   do   komplexných mechatronických systémov automobilov.</p>
                        <p>Ústav garantuje študijné programy vo všetkých stupňoch štúdia akreditovaných na STU v Bratislave. Pre  širokospektrálnu  oblasť  výučby  a  výskumu  zabezpečuje  integráciu  výskumníkov  a pedagógov  z  FEI STU do výskumného a výučbového procesu v jednotlivých študijných programoch.</p>
                        </div>
                    </div>
                <hr class="aboutUsHR">
                    <div id="section2" class="sectionDiv">
                        <h3 class="sectionH2 sectItem" id="secH2">Vedenie ústavu</h3>
                        <div id="sectContent2" class="row">
                            <div class="col-md-6">
                                <p>Riaditeľ ústavu</p>
                                <p>Zástupca riaditeľa ústavu pre vedeckú činnosť</p>
                                <p>Zástupca riaditeľa ústavu pre rozvoj ústavu</p>
                                <p>Zástupca riaditeľa ústavu pre pedagogickú činnosť</p>
                            </div>
                            <div class="col-md-6">
                                <p>prof. Ing. Mikuláš Huba, PhD.</p>
                                <p>prof. Ing. Justín Murín, DrSc.</p>
                                <p>prof. Ing. Štefan Kozák, PhD.</p>
                                <p>doc. Ing. Katarína Žáková, PhD.</p>
                            </div>
                        </div>
                    </div>
                <hr class="aboutUsHR">
                    <div id="section3" class="sectionDiv">

                        <div id="sectContent3">
                            <h3 class="sectionH2 sectItem" id="secH3">Oddelenia ústavu automobilovej mechatroniky</h3>
                        <div id="section31">
                            <h4 class="sectItem" id="secH31">Oddelenie aplikovanej mechaniky a mechatroniky (OAMM)</h4>
                            <div id="sectContent31">
                            <div class="row col-lg-12">
                                <div class="col-md-2">
                                    <p>Vedúci: </p>
                                    <p>Zástupca: </p>
                                </div>
                                <div class="col-md-10">
                                    <p>prof. Ing. Justín Murín, DrSc.</p>
                                    <p>doc. Ing. Vladimír Kutiš, PhD.</p>
                                </div>
                            </div>
                            <p>Oddelenie v rámci pedagogiky zabezpečuje v bakalárskom stupni ŠP výučbu predmetov s hlavným dôrazom na mechaniku a mechatronické prvky. V inžinierskom stupni ŠP zabezpečuje výučbu predmetov s dôrazom na simuláciu a modelovanie mechanických a mechatronických systémov tak z pohľadu mechaniky a dynamiky, ako aj z pohľadu multifyzikálneho previazania jednotlivých fyzikálnych domén.</p>
                            <p>Členovia oddelenia sa venujú formulácii nových matematických postupov a metód, ktoré sa používajú v multifyzikálnych analýzach napr. na opis funkcionálne gradovaných materiálov (FGM), v dynamických analýzach mechatronických a MEMS systémov, ako aj na opis piezoelektrických prvkov.</p>
                            <p>Členovia oddelenia využívajú moderné SW prostriedky, ako sú ANSYS, Catia a MSC.ADAMS na návrh, analýzu a optimalizáciu jednotlivých komponentov, ako aj celých subsystémov mechatronických prvkov.</p>
                            </div>
                        </div>

                        <div id="section32" class="sectionDiv">
                            <h4 class="sectItem" id="secH32">Oddelenie informačných, komunikačných a riadiacich systémov (OIKR)</h4>
                            <div id="sectContent32">
                            <div class="row col-lg-12">
                                <div class="col-md-2">
                                    <p>Vedúci: </p>
                                    <p>Zástupca: </p>
                                </div>
                                <div class="col-md-10">
                                    <p>doc. Ing. Danica Rosinová, PhD.</p>
                                    <p>doc. Ing. Katarína Žáková, PhD.</p>
                                </div>
                            </div>
                            <p>Informácie budú dodané neskôr.</p>
                            </div>
                        </div>

                        <div id="section33" class="sectionDiv">
                            <h4 class="sectItem" id="secH33">Oddelenie elektroniky, mikropočítačov a PLC systémov (OEMP)</h4>
                            <div id="sectContent33">
                            <div class="row col-lg-12">
                                <div class="col-md-2">
                                    <p>Vedúci: </p>
                                    <p>Zástupca: </p>
                                </div>
                                <div class="col-md-10">
                                    <p>prof. Ing. Štefan Kozák, PhD.</p>
                                    <p>Ing. Richard Balogh, PhD.</p>
                                </div>
                            </div>
                            <p>Informácie budú dodané neskôr.</p>
                            </div>
                        </div>

                        <div id="section34" class="sectionDiv">
                            <h4 class="sectItem" id="secH34">Oddelenie E-mobility, automatizácie a pohonov (OEAP)</h4>
                            <div id="sectContent34">
                            <div class="row col-lg-12">
                                <div class="col-md-2">
                                    <p>Vedúci: </p>
                                    <p>Zástupca: </p>
                                </div>
                                <div class="col-md-10">
                                    <p>prof. Ing. Mikuláš Huba, PhD.</p>
                                    <p>prof. Ing. Viktor Ferencey, CSc.</p>
                                </div>
                            </div>
                            <p>Informácie budú dodané neskôr.</p>
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
<script src="../js/scripty_aboutUs.js"></script>
</body>
</html>