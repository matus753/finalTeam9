
<?php
 if (isset($_SESSION['user_name']) && (isset($_SESSION['admin_id']) || isset($_SESSION['teacher_id'])))  {
     $osoby = $db->getPersonActiveYear();
     foreach ($osoby as $value) {
         if($value->getLdap()==$_SESSION['user_name']) {
             $typ = $value->getPerson_type();
             $group=$value->getIdGroup();
         }
     }
     //echo $typ;
 ?>
<div class="col-lg-12">
    <a class="btn btn-warning" href="index.php?addConsultation"><?php echo $lang['CONSULT_ADD']; ?></a>
    
    <a class="btn btn-danger" href="index.php?showConsultations"><?php echo $lang['CONSULT_SHOW']; ?></a>
    
    <h2><?php echo $lang['PEOPLE']; ?></h2>
<?php

    $osoby = $db->getPersonActiveYear();
    if($_SESSION['sort'] == 'way_desc'){
        $osoby = array_reverse($osoby);
    }
    //var_dump($osoby);
echo '<table class="table table-striped table-hover zobraz" id="tabPerson2">
    <thead>
            <tr>';
				echo '<th>'.$lang['ORDER'].'</th>';
                echo '<th class="sort_char '.$_SESSION['sort'].'">'.$lang['NAME'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['LECTURES'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['EXERCISES'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['TOTAL'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['CNTHOURS'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['SUMSTUDENTS'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['CNTSUM'].'</th>
                <th class="sort_char '.$_SESSION['sort'].'">'.$lang['EFFORT'].'</th>
                
            </tr>
    </thead>';
    $i=1;
    if ($typ==1){
        foreach ($osoby as $value) {
            if($value->getActive()>0) {
                if ($value->getLdap()==$_SESSION['user_name']) {


                    echo "<tr>";
                    echo '<td class="ix">' . $i . '</td>';$i++;
                    echo '<td><span style="display:none">' . $value->getSurname() . '</span><a href="index.php?showPersonDetail&AMP;id=' . $value->getId() . '">' . $value->getFullName() . '</a></td>';
                    echo '<td data-sorter="false">' . $value->getLectureCount() . '</td>';
                    echo '<td data-sorter="false">' . $value->getExcersiseCount() . '</td>';
                    echo '<td>' . $value->getAllCoursesCount() . '</td>';
                    echo '<td>' . "CNTHOURS" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . $db->getStudentsCountForPerson($value->getId()) . '</td>';
                    echo '<td>' . "CNTSUM" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . "EFFORT" /*$value->getAllCoursesCount()*/ . '</td>';

                    echo '</tr>';
                }
                else{
                    echo "<tr>";
                    echo '<td class="ix">' . $i . '</td>';$i++;  
                  echo '<td>' . "xxx" . '</td>';
                    echo '<td data-sorter="false">' . $value->getLectureCount() . '</td>';
                    echo '<td data-sorter="false">' . $value->getExcersiseCount() . '</td>';
                    echo '<td>' . $value->getAllCoursesCount() . '</td>';
                    echo '<td>' . "CNTHOURS" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . $db->getStudentsCountForPerson($value->getId()) . '</td>';
                    echo '<td>' . "CNTSUM" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . "EFFORT" /*$value->getAllCoursesCount()*/ . '</td>';

                    echo '</tr>';
                }
            }

        }
    }
    else if ($typ==2) {
        foreach ($osoby as $value) {
            if ($value->getActive() > 0) {

                echo "<tr>";
                echo '<td class="ix">' . $i . '</td>';$i++;
                echo '<td><span style="display:none">' . $value->getSurname() . '</span><a href="index.php?showPersonDetail&AMP;id=' . $value->getId() . '">' . $value->getFullName() . '</a></td>';
				echo '<td data-sorter="false">' . $value->getLectureCount() . '</td>';
                echo '<td data-sorter="false">' . $value->getExcersiseCount() . '</td>';
                echo '<td>' . $value->getAllCoursesCount() . '</td>';
                echo '<td>' . "CNTHOURS" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . $db->getStudentsCountForPerson($value->getId()) . '</td>';
                echo '<td>' . "CNTSUM" /*$value->getAllCoursesCount()*/ . '</td>';
                echo '<td>' . "EFFORT" /*$value->getAllCoursesCount()*/ . '</td>';

                echo '</tr>';
            }

        }
    }
    else if ($typ==3) {
        foreach ($osoby as $value) {
            if ($value->getActive() > 0) {
                if ($value->getIdGroup()==$group) {

                echo "<tr>";

                echo '<td class="ix">' . $i . '</td>';$i++;
                echo '<td><span style="display:none">' . $value->getSurname() . '</span><a href="index.php?showPersonDetail&AMP;id=' . $value->getId() . '">' . $value->getFullName() . '</a></td>';
                echo '<td data-sorter="false">' . $value->getLectureCount() . '</td>';
                echo '<td data-sorter="false">' . $value->getExcersiseCount() . '</td>';
                echo '<td>' . $value->getAllCoursesCount() . '</td>';
                echo '<td>' . "CNTHOURS" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . $db->getStudentsCountForPerson($value->getId()) . '</td>';
                echo '<td>' . "CNTSUM" /*$value->getAllCoursesCount()*/ . '</td>';
                echo '<td>' . "EFFORT" /*$value->getAllCoursesCount()*/ . '</td>';

                echo '</tr>';
            }
                else{
                    echo "<tr>";

                    echo '<td class="ix">' . $i . '</td>';$i++;
                    echo '<td>' . "xxx" . '</td>';
                    echo '<td data-sorter="false">' . $value->getLectureCount() . '</td>';
                    echo '<td data-sorter="false">' . $value->getExcersiseCount() . '</td>';
                    echo '<td>' . $value->getAllCoursesCount() . '</td>';
                    echo '<td>' . "CNTHOURS" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . $db->getStudentsCountForPerson($value->getId()) . '</td>';
                    echo '<td>' . "CNTSUM" /*$value->getAllCoursesCount()*/ . '</td>';
                    echo '<td>' . "EFFORT" /*$value->getAllCoursesCount()*/ . '</td>';

                    echo '</tr>';
                }

        }
    }
}


echo '</table>';

?>
    <input class="btn btn-warning" value="Exportuj ako CSV" type="button" onclick="$('#tabPerson2').table2CSV({header:['Full Name','Exercises','Lectures','Count']})">
</div>

<script>
 


$(document).ready(function() {

    $("#tabPerson2").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false
            }, 
        } 
    });







    $('#tabPerson2').each(function() {

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
                      //row.sortKey = $cell.text().toUpperCase();  // nie je podmienkou

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

                    setTimeout(function(){
                        var i = 1;
                    	$('#tabPerson2 > tbody  > tr').each(function(){
                        	$(this).children('td:first').text(i);
                            i++;
                        });
                    }, 100);
                    
                });
            }
        });
    });
   /* $i=1;
    $poc=1;
    $(this).find('td').each(function () {
        if (($i%9)==1) {
            (this).innerHTML =$poc++;
        }
        $i++;

    });*/
});

</script>
<?php } ?>