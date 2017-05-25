<?php
require_once '../general_functions.php';

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
            $output .= "<p>Email úspešne prihlásený na newsletter.</p>";
        } else {
            $output .= "<p>Email úspešne odhlásený z newsletteru.</p>";
        }
        $output .= "<button type='button' class='btn btn-default' data-dismiss='modal' onclick='newModal()'>OK</button>";
        echo $output;
    }

}

if(isset($_POST['newModal'])){
    echo "<p>Zadajte svoju emailovú adresu a prihláste sa na odoberanie noviniek</p>
                    <div class='input-prepend'><span class='add-on'><i class='glyphicon glyphicon-envelope'></i></span>
                        <input type='email' data-error='Nesprávna emailová adresa' required id='ib-newsletter-email' name='' placeholder='your@email.com'><select id='ib-newsletter-select'><option>SK</option><option>EN</option></select>
                    </div>
                    <br />
                    <input id='1'  type='submit' value='Prihlásiť sa' class='btn btn-large' onclick='newsletter(this.id)'/>
                    <input id='0'  type='submit' value='Odhlásiť sa' class='btn btn-large' onclick='newsletter(this.id)'/>";
}