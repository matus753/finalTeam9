<?php

function import($file){
    $host = "localhost";
    $user = "iia_team_user";
    $pass = "iiatimak";
    $db_name = "iia_db";
    
    $cmd = "mysql -h $host -u $user --password=$pass $db_name < $file";   

    exec( $cmd );
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="file" id="filePath" name="filePath">
    <input type="submit" id="send" name="send" value="Upload">
</form>

<?php

if (isset($_POST['send'])){
    import($_POST['filePath']);
}

?>