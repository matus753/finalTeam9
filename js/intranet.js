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