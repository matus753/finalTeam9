var act;

function setProfileActive() {
    $("#item1").addClass("actItem");
    act = "#item1";
}

$(document).ready(function () {
    $(".intraItem").click(function(){
/*        e.preventDefault();*/
        $(act).removeClass("actItem");
        act = "#" + $(this).attr("id");
        $(this).addClass("actItem");
        /*return false;*/
    });
});
