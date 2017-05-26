<!DOCTYPE html>
<?php
    require_once __DIR__ . "/projects_functions.php";
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'en';
?>
<html>
  <head>
      <?php
      loadHead();
      ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="../js/scripty_projects.js"></script>
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/style_projects.css">
        <title>Projects | ÚAMT FEI STU</title>
  </head>

  <body>
  <?php
  loadLanguageNavbar();
  ?>     
     <!-- Page Content -->
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"> 
                    <h1>Projects</h1>
                    
                    <hr>
                    <h2>International projects</h2>
                    <?php zobraz_projekty("Program"); ?>
                    <h2>VEGA projects</h2>
                    <?php zobraz_projekty("VEGA"); ?>
                    <h2>APVV projects</h2>
                    <?php zobraz_projekty("APVV"); ?>
                    <h2>KEGA projects</h2>
                    <?php zobraz_projekty("KEGA"); ?>
                    <h2>Other projects</h2>
                    <?php zobraz_projekty("Iné"); ?> 
                </div>
            </div>
        </div>

        <?php
        loadLanguageFooter();
        loadJScripts();
        ?>
    </body>
</html>