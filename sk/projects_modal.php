<?php
        require 'projects_functions.php';

	if(isset($_GET['id'])){
	    $id  = $_GET['id'];
	}
	else
            echo "niekde sa stala chyba";

	$conn = new mysqli($hostname, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 

        mysqli_set_charset($conn, "utf8");
        $sql = "SELECT * FROM project WHERE id = '$id'";
        $result = $conn->query($sql);

        $vys = "";
        while($row = $result->fetch_assoc()){
            ?>
            <div class='modal-projects'>         
               <p class='modal-project-title grey bold'><?php echo $row['titleSK']; ?> </p>
               <hr>
               <p class='modal-project-subtitle'>Typ projektu</p>
               <p class='modal-project-text'><?php echo $row['projectType']; ?></p>
               <hr>
               <p class='modal-project-subtitle'>Číslo projektu</p>
               <p class='modal-project-text'><?php echo $row['number']; ?></p>
               <hr>
               <p class='modal-project-subtitle'>Doba trvania</p>
               <p class='modal-project-text'><?php echo $row['duration']; ?></p>
               <hr>
               <p class='modal-project-subtitle'>Vedúci projektu</p>
               <p class='modal-project-text'><?php echo $row['coordinator']; ?></p> 
               <hr>
               <?php if (!empty($row['partners'])) { ?>
                    <p class='modal-project-subtitle'>Partneri</p>
                    <p class='modal-project-text'><?php echo $row['partners']; ?></p>
                    <hr>
                <?php } ?>
               <?php if (!empty($row['web'])) { ?>
                    <p class='modal-project-subtitle'>Webová stránka</p>
                    <p class='modal-project-text'><a href="<?php echo $row['web']; ?>" target="_blank"><?php echo $row['web']; ?></a></p>
                    <hr>
               <?php } ?>
               <?php if (!empty($row['internalCode'])) { ?>
                    <p class='modal-project-subtitle'>Interný kód</p>
                    <p class='modal-project-text'><?php echo $row['internalCode']; ?></p>
                    <hr>
               <?php } ?>
               <?php if (!empty($row['annotationSK'])) { ?>
                    <p class='modal-project-subtitle'>Anotácia</p>
                    <p class='modal-project-text modal-project-annotation'><?php echo $row['annotationSK']; ?></p>
               <?php } ?>
       <?php } ?>
</div>
       