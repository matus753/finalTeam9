<?php

   function getLdapId($login){
    $ldap_server = "ldap.stuba.sk";

    if($connect=@ldap_connect($ldap_server)){ 
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        if(($bind=@ldap_bind($connect)) == false){
            print "bind:__FAILED__<br>\n";
            return false;
        }

        if (($id = ldap_search( $connect,
                "dc=stuba, dc=sk", "uid=$login")) == false) {
            print "chyba v ldap_search<br>";
            return false;
        }

        if (( $entry = ldap_first_entry($connect, $id))== false) {
            print "zadane AIS meno neexistuje<br>\n";
            return false;
        }

        try{
            $userId = ldap_get_values($connect, $entry, "uisid")[0];
            @ldap_close($connect);
            return $userId;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    } else {                                  // no conection to ldap server
        echo "no connection to '$ldap_server'<br>\n";
    }
    echo "failed: ".ldap_error($connect)."<br>\n";
    @ldap_close($connect);
   }