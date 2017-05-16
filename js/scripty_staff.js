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
