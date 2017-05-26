<?php
        require 'projects_functions.php';

	if(isset($_GET['id'])){
	    $id  = $_GET['id'];
	}
	else
            echo "error";

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
               <p class='modal-project-title grey bold'><?php echo $row['titleEN']; ?> </p>
               <hr>
               <p class='modal-project-subtitle'>Project type</p>
               <p class='modal-project-text'><?php echo $row['projectType']; ?></p>
               <hr>
               <p class='modal-project-subtitle'>Project number</p>
               <p class='modal-project-text'><?php echo $row['number']; ?></p>
               <hr>
               <p class='modal-project-subtitle'>Duration</p>
               <p class='modal-project-text'><?php echo $row['duration']; ?></p>
               <hr>
               <p class='modal-project-subtitle'>Coordinator</p>
               <p class='modal-project-text'><?php echo $row['coordinator']; ?></p> 
               <hr>
               <?php if (!empty($row['partners'])) { ?>
                    <p class='modal-project-subtitle'>Partners</p>
                    <p class='modal-project-text'><?php echo $row['partners']; ?></p>
                    <hr>
                <?php } ?>
               <?php if (!empty($row['web'])) { ?>
                    <p class='modal-project-subtitle'>Web</p>
                    <p class='modal-project-text'><a href="<?php echo $row['web']; ?>" target="_blank"><?php echo $row['web']; ?></a></p>
                    <hr>
               <?php } ?>
               <?php if (!empty($row['internalCode'])) { ?>
                    <p class='modal-project-subtitle'>Internal code</p>
                    <p class='modal-project-text'><?php echo $row['internalCode']; ?></p>
                    <hr>
               <?php } ?>
               <?php if (!empty($row['annotationSK'])) { ?>
                    <p class='modal-project-subtitle'>Annotation</p>
                    <p class='modal-project-text modal-project-annotation'><?php echo $row['annotationEN']; ?></p>
               <?php } ?>
       <?php } ?>
</div>
       