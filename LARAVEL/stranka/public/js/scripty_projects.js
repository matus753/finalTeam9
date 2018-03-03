$('.m').on("click",function(){
    $isClicked = 'sub' + $(this).data("id");
    if ($('.'+$isClicked).css("text-transform") == "uppercase"){
        $('.'+$isClicked).css("text-transform", "none");
    } else {
        $('.'+$isClicked).css("text-transform", "uppercase");
        $('.'+$isClicked).css("font-weight", "bold");
    }
});
$('.m').hover(function () {
    $(this).css("background-color", "rgb(230, 230, 230)");
}, function () {
    $isClicked = 'sub' + $(this).data("id");
    if ($('.'+$isClicked).css("text-transform") == "uppercase"){
        $(this).css("background-color", "rgb(242, 242, 242)")
    } else {
        $(this).css("background-color", "#fff")
    }
});