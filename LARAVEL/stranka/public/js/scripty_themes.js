$(document).ready(function(){
    getThesis("642");
});

$('#ustavSelect').on('change', function(){
    var ustav = $( "#ustavSelect option:selected" ).val();
    getThesis(ustav);
});

function getThesis(ustav) {
    $("#SS-table-themes-BP > tbody").html("");
    $('#programSelect').find('option').not(':first').remove();

    var id = $(".loaded").data('type');
    var lang = $("#lang").html();
    if (id == 1){
        if (lang == 'sk'){
            $(".thesisType").html('bakalárske');
            $(".studyType").html('bakalárske');
        } else {
            $(".thesisType").html('bachelor');
            $(".studyType").html('bachelor');
        }
    } else {
        if ($("#lang").html() == 'sk'){
            $(".thesisType").html('diplomové');
            $(".studyType").html('inžinierske');
        } else {
            $(".thesisType").html('master');
            $(".studyType").html('master');
        }
    }

    $('.loading').css("display", "block");
    $('.loaded').css("display", "none");
    $.ajax ({
        type: 'GET',
        url: $(".loaded").data('href'),
        data: { 'ustav':ustav, 'id': id, 'lang': lang},
        success: function(response) {
            if (response.hodnoty.length == 0){
                $('.nothing').css("display", "block");
            } else {
                $("#selectUstav").val(response.ustav);
                $('.loading').css("display", "none");
                $('.loaded').css("display", "block");
                var hodnoty = response.hodnoty;
                var programs = response.studPrograms;
                programs.forEach(function (p) {
                    var o = document.createElement("option");
                    o.text = p;
                    o.value = p;
                    $("#programSelect").append(o);
                });
                hodnoty.forEach(function (h) {
                    var r1 = '<tr class="m" data-target="#' + h['a6'] + '" data-id="' + h['a6'] + '" data-toggle="collapse" data-url="' + h['a1'] + '" data-title="' + h['a2'] + '" >';
                    var r2 = '<td><i class="fa fa-search-plus themes-icon-plus"> </i><p class="thesisTitle">' + h['a3'];
                    var r3 = '</p><div id="' + h['a6'] + '" class="collapse"><div id="div' + h['a6'] + '" class="anotacia"> <i class="fa fa-spinner fa-pulse fa-2x fa-fw waitIcon"></i></div></div></td>';
                    var r4 = '<td class="center" style="text-align: center">' + h['a4'] + '</td>';
                    var r5 = '<td class="center" style="text-align: center">' + h['a5'] + '</td></tr>';
                    var r = r1 + r2 + r3 + r4 + r5;
                    $("table tbody").append(r);
                });
            }
        },
        error: function(response){
            console.log('Error'+response);
        }
    });
}

$(document).on('click', '.m', function() {
    callAjax($(this).data("url"), $(this).data("id"));
});

function callAjax(urlText, id) {
    $.ajax ({
        type: 'GET',
        url: '/thesis/anotation',
        data: { 'urlka': urlText },
        success: function(response) {
            document.getElementById('div'+id).innerHTML = response;
        },
        error: function(response){
            console.log('Error'+response);
        }
    });
}

$('#programSelect').on('change', function(){
    var filter = $( "#programSelect option:selected" ).val();
    var table, tr, td, i;
    table = document.getElementById("SS-table-themes-BP");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
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

});

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

function findThesis() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("inputFind");
    filter = input.value.toUpperCase();
    table = document.getElementById("SS-table-themes-BP");
    tr = table.getElementsByTagName("tr");

    var length = tr.length - 1;
    var countShown = length;

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByClassName("thesisTitle")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                if (countShown != length) {
                    countShown++;
                }
                tr[i].style.display = "";
                $('.nothing').css("display", "none");
            } else {
                tr[i].style.display = "none";
                countShown--;
                if (countShown == 0){
                    $('.nothing').css("display", "block");
                }
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
