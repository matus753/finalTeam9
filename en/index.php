<?php
    require_once '../general_functions.php';
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'en';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home | ÚAMT FEI STU</title>
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
                              <p>Do you want to find out more about us? Go to the "About Us" and "Staff" subpages to find out more of our history, learn more about each department and staff.</p>
                              <p><a href="aboutUs.php" class="btn btn-default btn-dark-blue" role="button">About us</a> <a href="staff.php" class="btn btn-default btn-blue" role="button">Staffs</a></p>
                            </div>
                          </div> 
                        </div>
                          <div class="col-sm-6 col-md-3">
                          <div class="thumbnail thumbfb">
                            <img src="../images/indexPhoto/t2.JPG" alt="...">
                            <div class="caption">
                              <h3>News</h3>
                              <p>What is going on and what has ever been done at our institute can be found on the News subpage.</p>
                              <p><a href="news.php" class="btn btn-default btn-dark-blue" role="button">News</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="thumbnail thumbfb">
                            <img src="../images/indexPhoto/t3.JPG" alt="...">
                            <div class="caption">
                              <h3>Photos</h3>
                              <p>Photos and videos from our stock will bring you closer to life on our faculty.</p>
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
                                    <a href="https://www.facebook.com/UAMTFEISTU/?fref=ts">Institute of Automotive Mechatronics FEI STU</a>
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
                          <h4>Distanct master study</h4>
                          <p class="con-text">From the school year 2017/2018, we are opening the distance form of engineering studies in the modern study program Applied Mechatronics and Electromobility.</p>
                        </div>
                        <div class="col-sm-4">
                          <span class="glyphicon glyphicon-certificate gicon"></span>
                          <h4>QUALITY OF STUDIES</h4>
                          <p class="con-text">Are you interested in computer science, electronic systems, mechanics and automatic control? All these areas can be studied simultaneously in one study program.</p>
                        </div>
                        <div class="col-sm-4">
                          <span class="glyphicon glyphicon-cog gicon"></span>
                          <h4>Working on interesting projects</h4>
                          <p class="con-text">Our institute cooperates with a number of companies and is involved in several domestic or international projects.</p>
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