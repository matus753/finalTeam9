<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 4; // opravit
}
?>

<script>

    $(function () {
        $("#semEnd").datepicker({
            dateFormat: 'yymmdd',
            onSelect: function (dateText) {
                $("#export").click(function () {
                    window.location = "modules/export_calendar.php?id=" + $("#hidden").text() + "&end=" + dateText;
                    return false;
                });
            }
        });
    });

</script>



<div class="bs-docs-section">
    <?php if (isset($_SESSION['user_name']) && (isset($_SESSION['teacher_id']) || isset($_SESSION['admin_id']))) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1 id="nav">Akcie</h1>
                </div>
                <div class="form-group">
                    <label for="semesterEnd" class="col-lg-2 control-label">Koniec semestra</label>
                    <div class="col-lg-5">
                        <input type="text" id="semEnd" class="form-control" value="<?php ?>" name="semEnd" placeholder="Koniec semestra">
                    </div>              
                </div>  

                <div class="form-group">
                    <div class="col-lg-5 col-lg-offset-2">
                        <div id="hidden" style="display: none;"><?php echo $id; ?></div>
                        <a id="export" class="btn btn-default">Stiahni kalendár</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1 id="nav">Export databázy</h1>
                </div>
            </div>
        </div>            
        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-2">
                <a class="btn btn-default" href="modules/db_backup.php">Exportovať databázu</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1 id="nav">Import databázy</h1>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-2">
                <a class="btn btn-default" href="modules/db_import.php">Importovať databázu</a>
            </div>
        </div>
    <?php
}
?>
</div>



<?php
