<?php
include('config.php');
$role = '';

function loginLDAP($login, $password){
    $ldap_server = "ldap.stuba.sk";

    //Valid if user have access to Intranet
    $conn = new_connection();
    $sql = "SELECT * FROM staff WHERE ldapLogin='$login'";
    $result = $conn->query($sql);
    if ($result->num_rows != 1){
        return false;
    }

    //LDAP login
    if($connect=@ldap_connect($ldap_server)){ // if connected to ldap server

        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        // bind to ldap connection
        if(($bind=@ldap_bind($connect)) == false){
            print "bind:__FAILED__<br>\n";
            return false;
        }

        // search for user
        if (($res_id = ldap_search( $connect,
                "dc=stuba, dc=sk",
                "uid=$login")) == false) {
            print "failure: search in LDAP-tree failed<br>";
            return false;
        }

        if (ldap_count_entries($connect, $res_id)) {
            print "failure: username $login found more than once<br>\n";
            return false;
        }

        if (( $entry_id = ldap_first_entry($connect, $res_id))== false) {
            print "failur: entry of searchresult couln't be fetched<br>\n";
            return false;
        }

        if (( $user_dn = ldap_get_dn($connect, $entry_id)) == false) {
            print "failure: user-dn coulnd't be fetched<br>\n";
            return false;
        }

        /* Authentifizierung des User */
        if (($link_id = ldap_bind($connect, $user_dn, $password)) == false) {
            print "failure: username, password didn't match: $user_dn<br>\n";
            return false;
        }
        try{
            $row = $result->fetch_assoc();
            global $role;
            $role =  $row["role"];
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    } else {                                  // no conection to ldap server
        echo "no connection to '$ldap_server'<br>\n";
    }

    echo "failed: ".ldap_error($connect)."<BR>\n";

    @ldap_close($connect);
    return(false);
}