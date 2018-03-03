$('.m').on("click",function(){
    $help = 'nothing' + $(this).data("id");
    $project = 'project' + $(this).data("id");
    if($('#'+$project).html().replace(/\s/g, '').length == 0){
        if($('#lang').html() == "sk"){
            $('#'+$project).html("<p style='padding-top: 20px;padding-bottom: 10px;'>Bližšie informácie nie sú k dispozícii.</p>");
        } else {
            $('#'+$project).html("<p style='padding-top: 20px;padding-bottom: 10px;'>No additional information is available.</p>");
        }
    }
    if ($('#'+$help).html() === "true"){
        $('#'+$help).html("false");
    } else {
        $('#'+$help).html("true");
    }
});
$('.m').hover(function () {
    $(this).css("background-color", "rgb(230, 230, 230)");
}, function () {
    $help = 'nothing' + $(this).data("id");
    $isClicked = 'sub' + $(this).data("id");
    if ($('#'+$help).html() == "true"){
        $(this).css("background-color", "rgb(242, 242, 242)")
    } else {
        $(this).css("background-color", "#fff")
    }
});