<!DOCTYPE html>
<?php
    require_once __DIR__ . "/staff_functions.php";
    require_once __DIR__ . "/config.php";  
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/scripty_staff.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style_staff.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <title>UAMT / Pracovníci</title>
  </head>
  <body>
      <div class="container"> 
        <h1>Pracovníci</h1>
        <p>Pre viac informácií o pracovníkoch, kliknite na jednotlivé riadky v tabuľke </p>
        <input type="text" id="SS-filterDep" onkeyup="filterDepartment()" placeholder="Filter oddelení.." title="Zadajte oddelenie">
        <input type="text" id="SS-filterRole" onkeyup="filterRole()" placeholder="Filter zaradenia.." title="Zadajte zaradenie">

  	    <?php
  	    	zobraz_zoznam_pracovnikov();              
  	    ?>
  	    
      </div>
  </body>