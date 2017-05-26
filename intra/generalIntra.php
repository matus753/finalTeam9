<?php
require_once '../general_functions.php';

function loadNavbarIntra(){
    echo '<div class="navbarIntra">
            <ul class="nav">
                <li id="item1" class="intraItem"><a href="profil.php">Profil</a></li>
                <li id="item2" class="intraItem"><a href="pedagogika.php" >Pedagogika</a></li>
                <li id="item3" class="intraItem"><a href="doktorandi.php">Doktorandi</a></li>
                <li id="item4" class="intraItem"><a href="publikacie.php">Publikácie</a></li>
                <li id="item5" class="intraItem"><a href="sluzobneCesty.php">Služobné cesty</a></li>
                <li id="item6" class="intraItem"><a href="nakupy.php">Nákupy</a></li>
                <li id="item7" class="intraItem"><a href="dochadzka.php">Dochádzka</a></li>';
    if(isAdmin())
    echo        '<li id="item8" class="intraItem"><a href="changeRole.php">Spravovanie rolí</a></li>';
    echo        '<li id="item9" class="intraItem"><a href="rozdelenieUloh.php">Rozdelenie úloh</a></li>
            </ul>
        </div>';

}