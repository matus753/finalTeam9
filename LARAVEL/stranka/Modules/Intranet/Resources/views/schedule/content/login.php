<?php 
if (isset($_GET['off'])) {
    unset($_SESSION['user_name'],$_SESSION['teacher_id'],$_SESSION['admin_id'],$_SESSION['access_token']);
    header('Location: index.php');
}
if (isset($_GET['code'])) {
    header('Location: index.php');
}
if (!isset($_SESSION['user_name'])) {

    if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!=NULL && $_POST['password']!=NULL ) {
        $ldap_server = 'ldap.stuba.sk';
        $ldapconn = ldap_connect($ldap_server);
        $ldaprdn = "uid=".$_POST['username'].", ou=People, DC=stuba, DC=sk";
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        $res=ldap_bind($ldapconn, $ldaprdn, $_POST['password']);

        /*
        echo '<pre>';
        var_dump($ldaprdn);
        var_dump($res);
        echo '</pre>';
*/


        if ($res) {       
            $pom=$db->getPersonByLdap($_POST['username']);     
            $person = $pom[0];
            if ($person) {
                // vytvor session a presmeruj
                $_SESSION['user_name'] = $_POST['username'];
                if (($person->getPerson_type()==1)||($person->getPerson_type()==3)) {
                    $_SESSION['teacher_id'] = $person->getId();
                }
                else {
                    $_SESSION['admin_id'] = $person->getId();
                }
                header('Location: index.php');
            }
            else {
                echo $lang['LOGIN_ERROR_STU_TYPE'];
                // uloz do db, vytvor session a presmeruj
                /*
                $person = new Person();
                $person->setPerson_type(1);
                $person->setLdap(strtolower($_POST['username']));
                $db->insertPerson($person);
                $_SESSION['user_name'] = $_POST['username'];
                header('Location: index.php');
                */
            }
        }
        else {
                echo $lang['LOGIN_ERROR_STU'];
        }
        ldap_close($ldapconn);
    }
}
else {
    header('Location: index.php');
}
?>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
	<div class="well bs-component">
              <form class="form-horizontal" method="POST" action="index.php?login">
                <fieldset>
                  <legend><?php echo $lang['LOGIN_FORM_TITLE']; ?></legend>
                  <div class="form-group">
                    <label for="username" class="col-lg-2 control-label"><?php echo $lang['LOGIN_FORM_NAME']; ?></label>
                    <div class="col-lg-10">
                        <input class="form-control" id="username" placeholder="<?php echo $lang['LOGIN_FORM_NAME']; ?>" type="text" name="username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-lg-2 control-label"><?php echo $lang['LOGIN_FORM_PASS']; ?></label>
                    <div class="col-lg-10">
                      <input class="form-control" id="password" placeholder="<?php echo $lang['LOGIN_FORM_PASS']; ?>" type="password" name="password" required>
                    </div>
                  </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="radio">
                        </div>
                    </div>
			<div class="col-lg-10 col-lg-offset-7">
                            <button class="btn btn-primary" type="submit"><?php echo $lang['LOGIN_FORM_LOGIN_BUTTON']; ?></button>
                            <?php require_once 'google.php'; ?>
                        </div>
                </fieldset>
              </form>
            <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div>
	</div>
    </div>
</div>
