/**
 * Created by Matus on 5/23/2017.
 */
function novaKategoria(page, name) {

    $.ajax({
        type: "POST",
        url: "intra/newCategory.php",
        data:{ name: name,
               page: page},
        success: function(data){
            location.reload();
        }
    })
}