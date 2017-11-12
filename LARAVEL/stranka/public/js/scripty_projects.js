$(document).on('click', '.m', function(){
    var val = $(this).attr('data-id');

    $.ajax({
        type: 'GET',
        url: "projects_modal.php",
        data: {id : val},
        success: function(msg){
            $("#modalProjects").html(msg);
        }
    });
});
