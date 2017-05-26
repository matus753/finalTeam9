/*var act;

function setProfileActive() {
    $("#intraMenu").addClass("active");
}

$(document).ready(function () {
    $(".intraMenu").click(function(){
        $("#intraItem1").removeClass("active");
        //var id = $(this).attr("id");
        //act = id;
        //$(".intraMenu").removeClass("active");
        $(id).addClass("active");
    });
});*/
$(function(){
    if(window.location.hash!=''){
        var hash=window.location.hash;
        $('.nav-tabs a[href='+hash+']').click();
    }
});
