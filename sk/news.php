<?php
require_once '../general_functions.php';
session_start();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
$_SESSION['lang'] = 'sk';
setcookie('lang', 'sk', time() + (86400 * 30), "/"); // 86400 = 1 day

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aktuality | ÚAMT FEI STU</title>
    <link rel="stylesheet" href="../css/ib_style.css">
    <?php
    loadHead();
    ?>
</head>
<body>
<?php
loadLanguageNavbar();
?>
<div id="emPAGEcontent" class="container">
        <div class="row" style="margin-bottom: 10px">
            <div class="ib-inline ib-left">
                <div class="ib-in">
                    <h3>Aktuality</h3>
                </div>
                <div class="ib-in">
                    <button type='button' class='btn  ib-add' data-toggle='modal' data-target='#newsletter'>Newsletter</button>
                </div>
            </div>
            <div class="ib-inline ib-right">
                Typ:
                <select onchange="updateType()" id="ib-news-select">
                    <option>Propagácia</option>
                    <option>Oznamy</option>
                    <option>Zo života ústavu</option>
                    <option selected>Všetky</option>
                </select>

                Expirované:
                <input id="ib-news-chb" type="checkbox" onclick="toggleExpired()">

                <?php if(isReporter() || isAdmin()) {echo "<button type='button' class='btn  ib-add' data-toggle='modal' data-target='#myModal'>Pridať</button>";}?>
            </div>
<!--            <hr>-->
        </div>

    <div class="row" id="news-content">
        <div class="col-md-12">

        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vloženie novej aktuality</h4>
            </div>
            <div class="modal-body">
                Dátum expirácie:
                <input class="form-control ib-inline2" type="date" id="ib-modal-date">
                Kategória:
                <select class="form-control ib-inline2" id="ib-modal-type-add">
                    <option>Propagácia</option>
                    <option>Oznamy</option>
                    <option>Zo života ústavu</option>
                </select>
                <hr>
                <div>
                    SVK<br>
                    <input class="form-control" type="text" placeholder="Titulok" style="padding-bottom: 7px;" id="ib-modal-title-sk">
                    <textarea class="form-control" rows="5" cols="70" id="ib-modal-content-sk"></textarea>
                </div>
                <hr>
                <div>
                    ENG<br>
                    <input class="form-control" type="text" placeholder="Titulok" style="padding-bottom: 7px;" id="ib-modal-title-eng">
                    <textarea class="form-control" rows="5" cols="70" id="ib-modal-content-eng"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addNews();sendEmail();">Pridať</button>
            </div>
        </div>

    </div>
</div>

<div id="newsletter" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="span5">
            <div class="thumbnail center well well-small text-center">
                <h2>Newsletter</h2>
                <div id="ib-newsletter-modal-body">
                    <p>Zadajte svoju emailovú adresu a prihláste sa na odoberanie noviniek</p>
                    <div class="input-prepend"><span class="add-on"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="email" data-error="Nesprávna emailová adresa" required id="ib-newsletter-email" name="" placeholder="your@email.com"><select id="ib-newsletter-select"><option>SK</option><option>EN</option></select>
                    </div>
                    <br />
                    <input id="1"  type="submit" value="Prihlásiť sa" class="btn btn-large" onclick="newsletter(this.id)"/>
                    <input id="0"  type="submit" value="Odhlásiť sa" class="btn btn-large" onclick="newsletter(this.id)"/>
                </div>
            </div>
        </div>

    </div>
</div>


<?php
loadLanguageFooter();
loadJScripts();
?>
<script type="text/javascript" src="../js/ib-news.js"></script>
</body>
</html>