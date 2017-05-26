<?php
    require_once '../general_functions.php';
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'en';
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
                        <p class="slider-text">Welcome to page</p>
                      <h3 class="slider-h3 slider-bg-white">Automotive Mechatronics</h3>                     
                    </div>      
                  </div>

                  <div class="item">
                    <img src="../images/indexPhoto/slider3.jpg" alt="UAMT" width="100%">
                    <div class="carousel-caption">
                      <h3 class="slider-h3 slider-bg-white">"Our priority are successful students"</h3>
                      <p class="slider-text">doc. Ing. Peter DRAHOŠ, PhD.</p>
                    </div>      
                  </div>

                  <div class="item">
                    <img src="../images/indexPhoto/slider1.jpg" alt="UAMT" width="100%">
                    <div class="carousel-caption">
                      <h3 class="slider-h3 slider-bg-black">Automotive Mechatronics</h3>
                      <p class="slider-text">Visit our promotion page <a href="http://www.automobilova-mechatronika.fei.stuba.sk/webstranka/" class="slider-a">HERE</a></p>
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
                    <div class="row thumb-fb-row">
                        <div class="col-sm-6 col-md-3">
                          <div class="thumbnail thumbfb">
                            <img src="../images/indexPhoto/t1.JPG" alt="...">
                            <div class="caption">
                              <h3>About us</h3>
                              <p>Chcete sa o nás dozvedieť čosi viac? Prejdite na podstránky "O nás" a "Pracovníci" a zistite niečo viac z našej histórie, dozviete sa bližšie informácie o jednotlivých oddeleniach 
                              a pracovníkoch.</p>
                              <p><a href="aboutUs.php" class="btn btn-default btn-dark-blue" role="button">About us</a> <a href="staff.php" class="btn btn-default btn-blue" role="button">Staffs</a></p>
                            </div>
                          </div> 
                        </div>
                          <div class="col-sm-6 col-md-3">
                          <div class="thumbnail thumbfb">
                            <img src="../images/indexPhoto/t2.JPG" alt="...">
                            <div class="caption">
                              <h3>News</h3>
                              <p>Čo sa chystá a čo sa niekedy chystalo na našom ústave nájdete na podstránke Aktuality.</p>
                              <p><a href="news.php" class="btn btn-default btn-dark-blue" role="button">News</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="thumbnail thumbfb">
                            <img src="../images/indexPhoto/t3.JPG" alt="...">
                            <div class="caption">
                              <h3>Photos</h3>
                              <p>Fotografie a videá z našich akcií Vám priblížia život na našej fakulte o čosi bližšie.</p>
                              <p><a href="photo.php" class="btn btn-default btn-dark-blue" role="button">Photos</a> <a href="video.php" class="btn btn-default btn-blue" role="button">Videos</a></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">                          
                            <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.9";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                                </script>
                            <div class="fb-page" data-href="https://www.facebook.com/UAMTFEISTU/?fref=ts" data-tabs="timeline" data-height="430" data-width="320" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                                <blockquote cite="https://www.facebook.com/UAMTFEISTU/?fref=ts" class="fb-xfbml-parse-ignore">
                                    <a href="https://www.facebook.com/UAMTFEISTU/?fref=ts">Ústav automobilovej mechatroniky FEI STU</a>
                                </blockquote>
                            </div>
                       </div>
                    </div>
                    
                    <!-- Container (Services Section) -->
                    <div class="container-fluid text-center">
                      <h2 class="bold">WHAT WE OFFER</h2>
                      <br>
                      <div class="row">                        
                        <div class="col-sm-4">
                          <span class="glyphicon glyphicon-education gicon"></span>
                          <h4>Dištančné inžinierske štúdium</h4>
                          <p class="con-text">Od školského roka 2017/2018 otvárame dištančnú formu inžinierskeho štúdia v modernom študijnom programe Aplikovaná mechatronika a elektromobilita.</p>
                        </div>
                        <div class="col-sm-4">
                          <span class="glyphicon glyphicon-certificate gicon"></span>
                          <h4>KVALITU ŠTÚDIA</h4>
                          <p class="con-text">Máš záujem o informatiku, elektronické systémy, mechaniku a automatické riadenie? Všetky tieto oblasti môžeš študovať súčasne v jednom študijnom programe.</p>
                        </div>
                        <div class="col-sm-4">
                          <span class="glyphicon glyphicon-cog gicon"></span>
                          <h4>Prácu na zaujímavých projektoch</h4>
                          <p class="con-text">Náš ústav spolupracuje s množstvom firiem a je zapojený do niekoľkých domácich či medzinárodných projektov.</p>
                        </div>
                      </div>
                    </div>
                    <div class="row video-index">  
                        <div class="col-md-3"> 
                        </div>
                        <div class="col-md-6 col-xs-12">                    
                            <iframe width="100%" height="320px" src="https://www.youtube.com/embed/vCYq4JspSCI" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-3"> 
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