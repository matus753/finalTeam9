<?php
    require_once '../general_functions.php';
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'sk';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Domov | ÚAMT FEI STU</title>
    <?php
        loadHead();
    ?>
</head>
<body>
    <?php
        loadLanguageNavbar();
        //loadNavbarSK();
    ?>

    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                            <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v2.9";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                               </script>
                            <div class="fb-page" data-href="https://www.facebook.com/UAMTFEISTU/?fref=ts" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                                <blockquote cite="https://www.facebook.com/UAMTFEISTU/?fref=ts" class="fb-xfbml-parse-ignore">
                                    <a href="https://www.facebook.com/UAMTFEISTU/?fref=ts">Ústav automobilovej mechatroniky FEI STU</a>
                                </blockquote>
                            </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        loadLanguageFooter();
        loadJScripts();
    ?>

</body>
</html>