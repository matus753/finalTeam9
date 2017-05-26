<?php
require_once '../general_functions.php';
require_once 'generalIntra.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['role'])){
    header("HTTP/1.1 401 Unauthorized");
    generate401Html();
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Rozdelenie úloh | ÚAMT FEI STU</title>
    <?php
    loadHead();
    ?>
    <link rel="stylesheet" href="../css/intranet.css">
    <link rel="stylesheet" href="../css/intra_general.css">
    <link rel="stylesheet" href="../css/study.css">
    <link rel="stylesheet" href="../css/intra_general.css">
    

</head>
<body>
    <?php
    loadLanguageNavbar(true);
    ?>

    <!-- Page Content -->
    <div id="emPAGEcontent">
        <div class="container">
            <?php
            loadNavbarIntra();
            ?>
            <div class="benefits">
                <h1>Rozdelenie úloh</h1>
                <hr>
                <div class="jumbotron">
                            <div class="harmonogram">
                                <table class="table">
                                    <thead style="font-weight: bold;">
                                    <td>Úloha / Stránka</td>
                                    <td>Podúloha / Podstránka</td>
                                    <td>Ivan Biačko</td>
                                    <td>Emília Brišová</td>
                                    <td>Matúš Džačovský</td>
                                    <td>Simona Šimčíková</td>
                                    <td>Branislav Ujmiak</td>
                                    </thead>
                                    <tbody>
                                         <tr>
                                            <td>Index (ul. 5)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>O nás</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Pracovníci (ul. 7)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Štúdium</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Voľné BP a DP</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Výskum</td>
                                            <td>Projekty (ul. 8)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Výskumné oblasti</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                        </tr>
                                        <tr>
                                            <td>Aktuality (ul. 9)</td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Aktivity</td>
                                            <td>Fotogaléria (ul. 11)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Videá (ul. 12)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Média (ul. 13)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                        </tr>
                                        <tr>
                                            <td>Kontakt (ul. 10)</td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Intranet (ul. 15)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Profil</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Pedagogika</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Doktorandi</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Publikácie</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Služobné cesty</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Nákupy</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Dochádzka</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Rozdelenie úloh</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Pomoc s dizajnom</td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Prihlasovanie a práca s rolami (ul. 14)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Menu (ul. 4)</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>                                        
                                        <tr>
                                            <td>Pätka (ul. 6)</td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Celkový dizajn *</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Responzivita * (ul. 2) </td>
                                            <td></td>
                                            <td>x</td>
                                            <td>x</td>
                                            <td></td>
                                            <td>x</td>
                                            <td>x</td>
                                        </tr>
                                        <tr>
                                            <td>Dvojjazyčnosť *  (ul. 3)</td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Github (ul. 1)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>x</td>
                                            <td></td>
                                            <td></td>
                                        </tr>                                       
                                    </tbody>
                                </table>
                                <p style="font-weight: bold;">* Databázu, dizajn, responzivitu, SK a EN verziu stránok si riešil každý člen skupiny sám v rámci svojej podúlohy.</p>



            </div>
        </div>
    </div>
    </div>

    <script src="../js/intranet.js"></script>
    <?php
    loadLanguageFooter();
    loadJScripts();
    ?>
    <script src="../js/scripty_intra.js"></script>
    </body>
</html>

