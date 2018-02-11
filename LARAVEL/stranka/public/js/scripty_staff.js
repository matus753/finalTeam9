$(document).on('click', '.m', function(){
    var val = $(this).attr('data-id');

    $("#modalTit").text(val);
    $.ajax({
        type: 'GET',
        url: "staff_modal.php",
        data: {id : val},
        success: function(msg){
            $("#modalBody").html(msg);
        }
    });
});

$(document).on('click', '#modal-staff-more', function(){
    var val = $(this).attr('data-id');
    
    $('#modal-staff-more-content').html('<img src="../images/loading.gif" class="img-loading">');
     
    $.ajax({
        type: 'GET',
        url: "staff_publication.php",
        data: {AISid : val},
        success: function(msg){
            setTimeout(function () {
                $("#modal-staff-more-content").html(msg);
            }, 2000);
            
        }
    });
});

function removeAccents(str) {
    str=str.toLowerCase();
    var convMap = {
          "á": "a",
          "ä": "a",
          "č": "c",
          "ď": "d",
          "é": "e",
          "í": "i",
          "ľ": "l",
          "ň": "n",
          "ó": "o",
          "ř": "r",
          "ť": "t",
          "š": "s",
          "ú": "u",
          "ý": "y",
          "ž": "z"
    }
    for (var i in convMap) {
        str = str.replace(new RegExp(i, "g"), convMap[i]);
    }
    return str;
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("SS-table-staff");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("TR");
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function filterDepartment() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("SS-filterDep");
  filter = input.value.toUpperCase();
  table = document.getElementById("SS-table-staff");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function filterRole() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("SS-filterRole");
  filter = input.value.toUpperCase();
  table = document.getElementById("SS-table-staff");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}