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
    <link rel="stylesheet" href="../css/style_index.css">
</head>
<body>
    <?php loadLanguageNavbar();  ?>
    <div id="emPAGEcontent">        
        <div class="carousel-item">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <img src="../images/indexPhoto/slider2.jpg" alt="UAMT" width="100%">
                    <div class="carousel-caption">
                        <p class="slider-text">Vitajte na stránke</p>
                      <h3 class="slider-h3 slider-bg-white">Automobilová Mechatronika</h3>                     
                    </div>      
                  </div>

                  <div class="item">
                    <img src="../images/indexPhoto/slider3.jpg" alt="UAMT" width="100%">
                    <div class="carousel-caption">
                      <h3 class="slider-h3 slider-bg-white">"Našou prioritou sú úspešní študenti"</h3>
                      <p class="slider-text">doc. Ing. Peter DRAHOŠ, PhD.</p>
                    </div>      
                  </div>

                  <div class="item">
                    <img src="../images/indexPhoto/slider1.jpg" alt="UAMT" width="100%">
                    <div class="carousel-caption">
                      <h3 class="slider-h3 slider-bg-black">Automobilová Mechatronika</h3>
                      <p class="slider-text">Navštívte našu propagačnú stránku <a href="http://www.automobilova-mechatronika.fei.stuba.sk/webstranka/" class="slider-a">TU</a></p>
                    </div>      
                  </div>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
            
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                          <div class="thumbnail">
                            <img src="../images/indexPhoto/slider2.jpg" alt="...">
                            <div class="caption">
                              <h3>Thumbnail label</h3>
                              <p>...</p>
                              <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>
                          </div> 
                        </div>
                          <div class="col-sm-6 col-md-3">
                          <div class="thumbnail">
                            <img src="../images/indexPhoto/slider2.jpg" alt="...">
                            <div class="caption">
                              <h3>Thumbnail label</h3>
                              <p>...</p>
                              <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="thumbnail">
                            <img src="../images/indexPhoto/slider2.jpg" alt="...">
                            <div class="caption">
                              <h3>Thumbnail label</h3>
                              <p>...</p>
                              <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                      
    
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
        </div>
    </div>

    <?php
        loadLanguageFooter();
        loadJScripts();
    ?>

</body>
</html>