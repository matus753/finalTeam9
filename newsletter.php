<?php
require_once 'general_functions.php';
session_start();
$web_lang = $_SESSION['lang'];

if($web_lang == 'sk'){
    $prihl = "<p>Email úspešne prihlásený na newsletter.</p>";
    $odhl = "<p>Email úspešne odhlásený z newsletteru.</p>";
    $mod = "Zadajte svoju emailovú adresu a prihláste sa na odoberanie noviniek";
    $badmail = "Nesprávna emailová adresa";
    $p = "Prihlásiť sa";
    $o = "Odhlásiť sa";
} else {
    $prihl = "<p>You have been successfully signed in for newsletter.</p>";
    $odhl = "<p>You have been successfully signed out of newsletter.</p>";
    $mod = "Sign in for newsletter with your email address";
    $badmail = "Invalid email address";
    $p = "Sign in";
    $o = "Sign out";
}

if(isset($_POST['bool']) && isset($_POST['lang']) && isset($_POST['email'])){
    $bool = $_POST['bool'];
    $lang = $_POST['lang'];
    $email = $_POST['email'];
    $conn = new_connection();
    $output = "";

    if($bool == 1){
        $sql = "INSERT INTO newsletter VALUES (null,'".$email."', '".$lang."')";
    } else {
        $sql = "delete from newsletter where email = '".$email."'";
    }

    if($conn->query($sql) == TRUE){
        if($bool == 1){
            $output .= "<p>".$prihl."</p>";
        } else {
            $output .= "<p>".$odhl."</p>";
        }
        $output .= "<button type='button' class='btn btn-default' data-dismiss='modal' onclick='newModal()'>OK</button>";
        echo $output;
    }

}

if(isset($_POST['newModal'])){
    echo "<p>".$mod."</p>
                    <div class='input-prepend'><span class='add-on'><i class='glyphicon glyphicon-envelope'></i></span>
                        <input type='email' data-error='".$badmail."' required id='ib-newsletter-email' name='' placeholder='your@email.com'><select id='ib-newsletter-select'><option>SK</option><option>EN</option></select>
                    </div>
                    <br />
                    <input id='1'  type='submit' value='".$p."' class='btn btn-large' onclick='newsletter(this.id)'/>
                    <input id='0'  type='submit' value='".$o."' class='btn btn-large' onclick='newsletter(this.id)'/>";
}