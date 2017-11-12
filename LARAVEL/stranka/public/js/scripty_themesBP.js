$(document).ready(function() {
    $(".m").click(function() {
        document.getElementById('modalAnotacia').innerHTML = $(this).data("title");
        callAjax($(this).data("url"));
            });
        });
    
function callAjax(urlText) {
    $.ajax ({
        type: 'POST',
        url: 'themesBP_modal.php',       
        data: "url=" + urlText,
        success: function(data) {
            console.log(data);
            var mydata= document.getElementById('anotaciaObsah').innerHTML = data;
        }
    });
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("SS-table-themes-BP");
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
        if (removeAccents(x.innerHTML.toLowerCase()) > removeAccents(y.innerHTML.toLowerCase())) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (removeAccents(x.innerHTML.toLowerCase()) < removeAccents(y.innerHTML.toLowerCase())) {
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

function filterSkolitel() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("SS-input-skolitel");
  filter = input.value.toUpperCase();
  table = document.getElementById("SS-table-themes-BP");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function filterProgram() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("SS-input-program");
  filter = input.value.toUpperCase();
  table = document.getElementById("SS-table-themes-BP");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}