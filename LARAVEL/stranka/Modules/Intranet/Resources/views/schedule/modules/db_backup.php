<?php

function backup(){
    $host = "localhost";
    $user = "iia_team_user";
    $pass = "iiatimak";
    $db_name = "iia_db";
    
    $filename = "full_database_backup-" . date("d-m-Y") . ".sql.gz";
    $mime = "application/x-gzip";

    header( "Content-Type: " . $mime );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

    $cmd = "mysqldump --u=" .$user . " --password=" . $pass . " --host=" . $host . " " . $db_name . " | gzip --best";   

    passthru( $cmd );

    exit(0);
}

backup();

?>