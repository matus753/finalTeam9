<!DOCTYPE html>
<?php
    require_once __DIR__ . "/staff_functions.php";
    session_start();
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    $_SESSION['lang'] = 'en';
?>
<html>
  <head>      
        <?php loadHead(); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="../js/scripty_staff.js"></script>
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/style_staff.css">
        <title>Staffs | ÚAMT FEI STU</title>
  </head>
  <body>
      <?php loadLanguageNavbar();  ?>  
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Staff</h1>
                    <hr>
                    <h2>Filter:</h2>
                    <div class="form-inline staff-filter">
                        <div class='row'> 
                            <div class='col-md-3'></div>
                            <div class="col-md-3 col-xs-6">
                                <input type="text" id="SS-filterDep" onkeyup="filterDepartment()" placeholder="Department Filter" title="Department Filter" class="form-control mb-2 mr-sm-2 mb-sm-0">
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <input type="text" id="SS-filterRole" onkeyup="filterRole()" placeholder="Staff role Filter" title="Staff role Filter" class="form-control mb-2 mr-sm-2 mb-sm-0">
                            </div>
                            <div class='col-md-3'></div>
                        </div>
                    </div>
                    <?php zobraz_zoznam_pracovnikov(); ?>
                </div>
            </div>
        </div>

        <?php
        loadLanguageFooter();
        loadJScripts();
        ?>
    </body>
</html>