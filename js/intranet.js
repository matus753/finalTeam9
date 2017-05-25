/**
 * Created by Matus on 5/23/2017.
 */
function novaKategoria(page, name) {

    $.ajax({
        type: "POST",
        url: " newCategory.php",
        data:{ name: name,
               page: page},
        success: function(data){
            window.location.href = window.location.href;
        }
    })
}

function novyNakup(name) {

    $.ajax({
        type: "POST",
        url: " newCategory.php",
        data:{ name: name},
        success: function(data){
            window.location.href = window.location.href;
        }
    })
}

function deleteRecord(isFile, info) {
    if(isFile){
        $.ajax({
            type: "POST",
            url: "delete.php",
            data:{ file: info},
            success: function(data){
                window.location.href = window.location.href;
            }
        })
    } else {
        $.ajax({
            type: "POST",
            url: "delete.php",
            data:{ urlId: info},
            success: function(data){
                window.location.href = window.location.href; 
            }
        })
    }
}


function deletePurchase(id) {
    $.ajax({
        type: "POST",
        url: "deletePurchase.php",
        data:{ id: id},
        success: function(data){
            window.location.href = window.location.href;
        }
    })
}

function saveInlineEdit(editableObj,column,id) {
    if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
        return false;

    $(editableObj).css("background","#FFF url(img/loader.gif) no-repeat right");
    var editval= editableObj.innerHTML.replace("&nbsp;","");

    $.ajax({
        url: "saveedit.php",
        type: "POST",
        data:{  column: column,
                editval: editval,
                id: id},
        success: function(response) {
            $(editableObj).attr('data-old_value',editableObj.innerHTML);
            $(editableObj).css("background","#FDFDFD");
        },
        error: function () {
            console.log("errr");
        }
    });
}

function fileUpload(input, id){
    if(input.files.length == 0){
        $('#'+id).attr('disabled', 'disabled');
    } else {
        $('#'+id).removeAttr('disabled');
    }
}

function urlUpload(url, id){
    if(url === ''){
        $('#'+id).attr('disabled', 'disabled');
    } else {
        $('#' + id).removeAttr('disabled');
    }
}

/**
 * Created by user on 3/1/2017.
 */
window.onload = init;
var skratka, viewId;

function generateTable(mesiac, rok) {
    $.ajax({
        type: "POST",
        url: "table.php",
        data:{ month: mesiac,
            year: rok},
        success: function(data){
            document.getElementById("calendar").innerHTML = data;
        },
        error: function(data){
            alert(data);
        }
    })
    $("#editing").prop('checked', false).change();
    changeEdit();
}

function changeEdit() {
    var q = document.getElementById("editingForm");
    if(document.getElementById("editing").checked){
        q.style.display = "block";
        setEvent('white');
        skratka = "x";
    } else {
        q.style.display = "none";
        document.getElementById("uspech").style.display = "none";
        document.getElementById("type_nep").value = '{"farba":"white","skratka":"x"}';
        $('td').off('mouseover');
        $('td').off('mousedown');
        $('td').off('mouseup');
    }
}

function changeEditView() {
    var q = document.getElementById("editingFormView");
    if(document.getElementById("editingView").checked){
        q.style.display = "block";
        setEventView('white');
        skratka = "x";
    } else {
        q.style.display = "none";
        document.getElementById("uspech").style.display = "none";
        document.getElementById("type_nep_view").value = '{"farba":"white","skratka":"x"}';
        $('td').off('mouseover');
        $('td').off('mousedown');
        $('td').off('mouseup');
    }
}

function changeType(json) {
    var array = JSON.parse(json);
    skratka = array["skratka"];
    $('td').off('mouseover');
    $('td').off('mousedown');
    $('td').off('mouseup');
    setEvent(array["farba"]);
}

function changeTypeView(json) {
    var array = JSON.parse(json);
    skratka = array["skratka"];
    $('td').off('mouseover');
    $('td').off('mousedown');
    $('td').off('mouseup');
    setEventView(array["farba"]);
}

function setEvent(color) {
    var isDown = false;   // Tracks status of mouse button
    var isSetParent = false;
    var parent;

    $('td').mousedown(function() {
        if(!(skratka == "x" && this.innerHTML == "")){
            if(!isSetParent){
                isSetParent = true;
                parent = this.parentElement;
            }
            $(this).css('backgroundColor', color);
            $(this).html(skratka);
            isDown = true;
        }
    })
        .mouseup(function() {
            isDown = false;    // When mouse goes up, set isDown to false
            isSetParent = false;
        });

    $('td').mouseover(function () {
        if(!(skratka == "x" && this.innerHTML == "")) {
            if (isDown && parent===this.parentElement) {
                $(this).css('backgroundColor', color);
                $(this).html(skratka);
            }
        }
    })
}

function setEventView(color) {
    var isDown = false;   // Tracks status of mouse button

    $('td').mousedown(function() {
        if(!(this.innerHTML == "&nbsp;")) {
            if (!((color == "white") && $(this).css('backgroundColor') == "rgba(0, 0, 0, 0)")) {
                $(this).css('backgroundColor', color);
                this.setAttribute('rel', skratka);
                isDown = true;
            }
        }
    })
        .mouseup(function() {
            isDown = false;    // When mouse goes up, set isDown to false
        });

    $('td').mouseover(function () {
        if(!(this.innerHTML == "&nbsp;")) {
            if (!(color == "white" && $(this).css('backgroundColor') == "rgba(0, 0, 0, 0)")) {
                if (isDown) {
                    $(this).css('backgroundColor', color);
                    this.setAttribute('rel', skratka);
                }
            }
        }
    })
}

function save() {
    var table = document.getElementById("table");
    var month = document.getElementById("slc_m").value;
    var year = document.getElementById("slc_y").value;
    var employees = {
        employee: []
    };
    var absent = new Array();
    for (var i = 2, row; row = table.rows[i]; i++) {
        employees.employee.push({
            "id": row.cells[0].innerHTML,
            "absent": []
        });
        for (var j = 2, col; col = row.cells[j]; j++) {
            if(col.innerHTML != "") {
                if(j < 11) {
                    var tmp = new Number(j);
                    tmp = tmp - 1;
                    var day = "0" + tmp.toString();
                } else {
                    day = j - 1;
                }
                var date = year + "-" + month + "-" + day;
                employees.employee[i - 2].absent.push({
                    "type" : col.innerHTML,
                    "date" : date
                });
            }
        }
    }

    var tableData = JSON.stringify(employees);

    $.ajax({
        type: "POST",
        url: "saveDochadzka.php",
        data: {data: tableData},
        success: function(data){
            document.getElementById("uspech").style.display = 'block';
            if(data != "")
                alert(data);
        }
    })
}

function saveView() {
    var table = document.getElementById("table_view");
    var month = document.getElementById("slc_m").value;
    var year = document.getElementById("slc_y").value;
    var employees = {
        employee: []
    };
    var absent = new Array();

    employees.employee.push({
        "id": viewId,
        "absent": []
    });

    for (var i = 1, row; row = table.rows[i]; i++) {
        for (var j = 0, col; col = row.cells[j]; j++) {
            if(col.innerHTML != "&nbsp;" && col.getAttribute('rel') != "") {
                if(parseInt(col.innerHTML) < 10) {
                    var day = "0" + col.innerHTML;
                } else {
                    day = col.innerHTML;
                }
                var date = year + "-" + month + "-" + day;
                employees.employee[0].absent.push({
                    "type" : col.getAttribute('rel'),
                    "date" : date
                });
            }
        }
    }

    var tableData = JSON.stringify(employees);

    $.ajax({
        type: "POST",
        url: "saveDochadzka.php",
        data: {data: tableData},
        success: function(data){
            document.getElementById("uspech").style.display = 'block';
            document.getElementById("viewer").style.display = "none";
            $("#editingView").prop('checked', false).change();
            changeEditView();
            generateTable(document.getElementById("slc_m").value,document.getElementById("slc_y").value);
            if(data != "")
                alert(data);
        }
    })
}

function init(){
    var element = document.getElementById('slc_m');
    var result = new Date().getMonth() + 1;
    if(result < 10){
        result = "0" + result.toString();
    }
    element.value = result;
}

function cancelOut(event, element){
    if(amIclicked(event,element)){
        document.getElementById("viewer").style.display = "none";
        $("#editingView").prop('checked', false).change();
        changeEditView();
    }
}

function amIclicked(e, element){
    e = e || event;
    var target = e.target || e.srcElement;
    if(target.id==element.id)
        return true;
    else
        return false;
}

function show(element) {
    var table = document.getElementById("table");
    var rowIndex = $(element).closest('tr').index() + 2;
    var mesiac = $('#slc_m').val();
    var rok = $('#slc_y').val()
    viewId = table.rows[rowIndex].cells[0].innerHTML;


    document.getElementById("viewer").style.display = "block";
    $.ajax({
        type: "POST",
        url: "tableMonth.php",
        data:{ month: mesiac,
            year: rok,
            id: viewId},
        success: function(data){
            document.getElementById("cal_month").innerHTML = data;
            $("[data-toggle='toggle']").bootstrapToggle('destroy')
            $("[data-toggle='toggle']").bootstrapToggle();
        }
    })
}

function generatePdf() {
    $.ajax({
        type: "POST",
        url: "generatePdf.php",
        success: function(){
            window.location = 'generatePdf.php';
        },
        error: function(data){
            alert(data);
        }
    })
}

function generateMonthPdf(id, mesiac, rok) {
    $.ajax({
        type: "POST",
        url: "generateMonthPdf.php",
        data:{ month: mesiac,
               year: rok,
               id: id},
        success: function(){
            window.location = 'generateMonthPdf.php';
        },
        error: function(data){
            alert(data);
        }
    })
}
