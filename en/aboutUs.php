<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'en';
?>
<!DOCTYPE html>
<html>
<head>
    <title>About us | ÚAMT FEI STU</title>
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
                <h1>About us</h1>
                <hr>
                <div id="section1" class="sectionDiv">
                    <h3 class="sectionH2 sectItem" id="secH1">History</h3>
                    <div id="sectContent1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in mi et leo accumsan dignissim sit amet in diam. Proin gravida finibus aliquam. Morbi sit amet nunc eu eros scelerisque suscipit et vitae ante. Aenean eu rhoncus dui, id convallis lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis dolor id risus interdum hendrerit. Aliquam vitae sodales orci. Donec finibus quis tellus eget dictum. Integer ut suscipit ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus vestibulum commodo cursus. Suspendisse sed justo sit amet eros blandit dictum.</p>
                    </div>
                </div>
                <hr class="aboutUsHR">
                <div id="section2" class="sectionDiv">
                    <h3 class="sectionH2 sectItem" id="secH2">Head of Institute</h3>
                    <div id="sectContent2" class="row">
                        <div class="col-md-6">
                            <p>Executive Director</p>
                            <p>Deputy Director of Scientific Activity</p>
                            <p>Deputy Director of Institute Inovations</p>
                            <p>Deputy Director of Educational Acitivty</p>
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
                        <h3 class="sectionH2 sectItem" id="secH3">Departments of the Institute of Automotive Mechatronics</h3>
                        <div id="section31">
                            <h4 class="sectItem" id="secH31">Department of Mechanics and Mechatronics (OAMM)</h4>
                            <div id="sectContent31">
                                <div class="row col-lg-12">
                                    <div class="col-md-4">
                                        <p>Executive Director of Department: </p>
                                        <p>Deputy Director of Department: </p>
                                    </div>
                                    <div class="col-md-8">
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
                            <h4 class="sectItem" id="secH32">Department of Information, Communication and Control Systems (OIKR)</h4>
                            <div id="sectContent32">
                                <div class="row col-lg-12">
                                    <div class="col-md-4">
                                        <p>Executive Director of Department: </p>
                                        <p>Deputy Director of Department: </p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>doc. Ing. Danica Rosinová, PhD.</p>
                                        <p>doc. Ing. Katarína Žáková, PhD.</p>
                                    </div>
                                </div>
                                <p>Proin ipsum turpis, lobortis nec maximus et, mollis eu dolor. Nunc sed tortor ut mauris tristique efficitur. Fusce sed sagittis libero, non ultrices nibh. Etiam purus ligula, pretium sed lectus a, ullamcorper fringilla dolor. Praesent non cursus elit, quis euismod dolor. Curabitur aliquam enim in est rutrum placerat. Mauris elit elit, tempus ac enim sollicitudin, tristique laoreet elit. Cras imperdiet est ac ante sodales blandit. Vestibulum molestie dui a mauris porttitor, nec vestibulum lectus commodo. Sed malesuada nulla non mauris maximus, quis molestie nisi faucibus.</p>
                            </div>
                        </div>

                        <div id="section33" class="sectionDiv">
                            <h4 class="sectItem" id="secH33">Department of Electronics, Microcomputers and PLC (OEMP)</h4>
                            <div id="sectContent33">
                                <div class="row col-lg-12">
                                    <div class="col-md-4">
                                        <p>Executive Director of Department: </p>
                                        <p>Deputy Director of Department: </p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>prof. Ing. Štefan Kozák, PhD.</p>
                                        <p>Ing. Richard Balogh, PhD.</p>
                                    </div>
                                </div>
                                <p>Proin ipsum turpis, lobortis nec maximus et, mollis eu dolor. Nunc sed tortor ut mauris tristique efficitur. Fusce sed sagittis libero, non ultrices nibh. Etiam purus ligula, pretium sed lectus a, ullamcorper fringilla dolor. Praesent non cursus elit, quis euismod dolor. Curabitur aliquam enim in est rutrum placerat. Mauris elit elit, tempus ac enim sollicitudin, tristique laoreet elit. Cras imperdiet est ac ante sodales blandit. Vestibulum molestie dui a mauris porttitor, nec vestibulum lectus commodo. Sed malesuada nulla non mauris maximus, quis molestie nisi faucibus.</p>
                            </div>
                        </div>

                        <div id="section34" class="sectionDiv">
                            <h4 class="sectItem" id="secH34">Department of E-mobility, Automation and Drives (OEAP)</h4>
                            <div id="sectContent34">
                                <div class="row col-lg-12">
                                    <div class="col-md-4">
                                        <p>Executive Director of Department: </p>
                                        <p>Deputy Director of Department: </p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>prof. Ing. Mikuláš Huba, PhD.</p>
                                        <p>prof. Ing. Viktor Ferencey, CSc.</p>
                                    </div>
                                </div>
                                <p>Proin ipsum turpis, lobortis nec maximus et, mollis eu dolor. Nunc sed tortor ut mauris tristique efficitur. Fusce sed sagittis libero, non ultrices nibh. Etiam purus ligula, pretium sed lectus a, ullamcorper fringilla dolor. Praesent non cursus elit, quis euismod dolor. Curabitur aliquam enim in est rutrum placerat. Mauris elit elit, tempus ac enim sollicitudin, tristique laoreet elit. Cras imperdiet est ac ante sodales blandit. Vestibulum molestie dui a mauris porttitor, nec vestibulum lectus commodo. Sed malesuada nulla non mauris maximus, quis molestie nisi faucibus.</p>
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