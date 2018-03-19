
 

<div class="col-lg-12">
    <h2><?php echo $lang['PEOPLE']; ?></h2>
    
 


<?php
 if (isset($_SESSION['user_name']) && isset($_SESSION['admin_id'])) {
    $osoby = $db->getPersonActiveYear();
    //var_dump($osoby);
   /* echo '<pre>';
    var_dump($_SESSION['sort']);
    echo '</pre>';
   */
echo '<table class="tablesorter table table-striped table-hover zobraz" id="tabPerson">
    <thead>
            <tr>
                <th>#</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['USER_NAME'].'</th>
                <th class="sort_char">'.$lang['USER_DEPARTMENT'].'</th>
                <th class="sort_char">LDAP</th>
                <th>'.$lang['EDITS'].'</th>
            </tr>
    </thead>';
    $i=1;
    if($_SESSION['sort'] == 'way_desc'){
        $osoby = array_reverse($osoby);
        $j = count($osoby);
    }
    foreach ($osoby as $value) {
        if ($value->getActive() > 0) {
            $pom = $value->getGroup();
            echo "<tr>";
            if ($_SESSION['sort'] == 'way_desc') {
                echo '<td>' . $j-- . '</td>';
            } else {
                echo '<td>' . $i++ . '</td>';
            }

            echo '<td><span style="display:none;">' . $value->getSurname() . '</span>' . $value->getTitle1() . ' ' . $value->getName() . ' ' . $value->getSurname() . ' ' . $value->getTitle2() . '</td>';
            echo '<td>' . $pom[0]->getCode() . '</td>';
            echo '<td>' . $value->getLdap() . '</td>';
            echo '<td><a class="btn btn-warning btn-xs" href="index.php?editPerson&AMP;id=' . $value->getId() . '">' . $lang['BUTTON_EDIT'] . '</a>'
                . '  <a class="btn btn-danger btn-xs" href="index.php?erasePerson&AMP;id=' . $value->getId() . '">' . $lang['BUTTON_DELETE'] . '</a></td>';
            echo '</tr>';

        }
    }

echo '</table>';

?>

<script>
    
$(document).ready(function() {
    $('#tabPerson').each(function() {
        var $table = $(this);

        $('th', $table).each(function(column) {
            var $header = $(this);

            if ($header.is('.sort_char')) {
                $header.click(function() {



                    way = 1;
                    data =  {'sort': 'way_asc'};
                    if ($header.is('.way_asc')){
                        way = -1;
                        data =  {'sort': 'way_desc'};
                    }
                    

                    $.post("ajax.php", data, function (response) {
                    });

                    var rows = $table.find('tbody > tr').get();
                    
                    $.each(rows, function(index, row) {
                        var $cell = $(row).children('td').eq(column);

                        row.sortKey = $cell.text();
//                      row.sortKey = $cell.text().toUpperCase();  // nie je podmienkou

                    });

                    rows.sort(function(a, b) {
                        return sort_SK_CZ(a.sortKey, b.sortKey);
                    });
                    
                    $.each(rows, function(index, row) {
                        $table.children('tbody').append(row);
                        row.sortKey = null;
                    });

                    $table.find('th').removeClass('way_asc')
                        .removeClass('way_desc');
                    
                    if (way==1) $header.addClass('way_asc');
                        else $header.addClass('way_desc');
                });
            }
        });
    });
});

</script>

<?php } ?>