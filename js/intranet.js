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