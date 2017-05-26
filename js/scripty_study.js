/**
 * Created by mirec on 25/05/2017.
 */
$(".studyProgramContent").hide();
$(".pvpElektronikaContent").hide();
$(".pvpAutomobilyContent").hide();
$(".pvpInfoContent").hide();
$("#tableBP1").hide();
$("#tableBP2").hide();
$("#tableBZP").hide();
$("#tableDP1").hide();
$("#tableDP2").hide();
$("#tableDP3").hide();
$("#tableDZP").hide();

$("#btnTogStudProgram").click(function(){
    $(".studyProgramContent").slideToggle();
});
$("#btnTogPVPe").click(function(){
    $(".pvpElektronikaContent").slideToggle();
});
$("#btnTogPVPa").click(function(){
    $(".pvpAutomobilyContent").slideToggle();
});
$("#btnTogPVPi").click(function(){
    $(".pvpInfoContent").slideToggle();
});
$("#btnTogBP1").click(function(){
    $("#tableBP1").slideToggle();
});
$("#btnTogBP2").click(function(){
    $("#tableBP2").slideToggle();
});
$("#btnTogBZP").click(function(){
    $("#tableBZP").slideToggle();
});
$("#btnTogDP1").click(function(){
    $("#tableDP1").slideToggle();
});
$("#btnTogDP2").click(function(){
    $("#tableDP2").slideToggle();
});
$("#btnTogDP3").click(function(){
    $("#tableDP3").slideToggle();
});
$("#btnTogDZP").click(function(){
    $("#tableDZP").slideToggle();
});
$(document).ready(function () {

    $(".sectItemS").click(function(){
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {
                window.location.hash = hash;
            });
        }
    });
});