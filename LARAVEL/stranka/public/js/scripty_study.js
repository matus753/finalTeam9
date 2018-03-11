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

var isDownSP = false;
var isPVPe = false;
var isPVPa = false;
var isPVPi = false;
var isBP1 = false;
var isBP2 = false;
var isBZP = false;
var isDP1 = false;
var isDP2 = false;
var isDP3 = false;
var isDP4 = false;

function studProgram1() {
    $(".studyProgramContent").slideToggle();
    isDownSP = !isDownSP;
    if (isDownSP == true){
        $('#btnTogStudProgram').removeClass('fa-arrow-circle-o-down');
        $('#btnTogStudProgram').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnTogStudProgram').addClass('fa-arrow-circle-o-down');
        $('#btnTogStudProgram').removeClass('fa-arrow-circle-o-up');
    }
}
$("#btnTogStudProgram").click(function(){
    studProgram1();
});
$("#toggle1").click(function(){
    studProgram1();
});

function pvpE() {
    $(".pvpElektronikaContent").slideToggle();
    isPVPe = !isPVPe;
    if (isPVPe == true){
        $('#btnTogPVPe').removeClass('fa-arrow-circle-o-down');
        $('#btnTogPVPe').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnTogPVPe').addClass('fa-arrow-circle-o-down');
        $('#btnTogPVPe').removeClass('fa-arrow-circle-o-up');
    }
}
$("#btnTogPVPe").click(function(){
    pvpE();
});
$("#toggle2").click(function(){
    pvpE();
});

function pvpA() {
    $(".pvpAutomobilyContent").slideToggle();
    isPVPa = !isPVPa;
    if (isPVPa == true){
        $('#btnTogPVPa').removeClass('fa-arrow-circle-o-down');
        $('#btnTogPVPa').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnTogPVPa').addClass('fa-arrow-circle-o-down');
        $('#btnTogPVPa').removeClass('fa-arrow-circle-o-up');
    }
}
$("#btnTogPVPa").click(function(){
    pvpA();
});
$("#toggle3").click(function(){
    pvpA();
});

function pvpI() {
    $(".pvpInfoContent").slideToggle();
    isPVPi = !isPVPi;
    if (isPVPi == true){
        $('#btnTogPVPi').removeClass('fa-arrow-circle-o-down');
        $('#btnTogPVPi').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnTogPVPi').addClass('fa-arrow-circle-o-down');
        $('#btnTogPVPi').removeClass('fa-arrow-circle-o-up');
    }
}
$("#btnTogPVPi").click(function(){
    pvpI();
});
$("#toggle4").click(function(){
    pvpI();
});

$("#btnTogBP1").click(function(){
    $("#tableBP1").slideToggle();
    isBP1 = !isBP1;
    if (isBP1 == true){
        $('#btnBp1').removeClass('fa-arrow-circle-o-down');
        $('#btnBp1').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnBp1').addClass('fa-arrow-circle-o-down');
        $('#btnBp1').removeClass('fa-arrow-circle-o-up');
    }
});
$("#btnTogBP2").click(function(){
    $("#tableBP2").slideToggle();
    isBP2 = !isBP2;
    if (isBP2 == true){
        $('#btnBp2').removeClass('fa-arrow-circle-o-down');
        $('#btnBp2').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnBp2').addClass('fa-arrow-circle-o-down');
        $('#btnBp2').removeClass('fa-arrow-circle-o-up');
    }
});
$("#btnTogBZP").click(function(){
    $("#tableBZP").slideToggle();
    isBZP = !isBZP;
    if (isBZP == true){
        $('#btnBp3').removeClass('fa-arrow-circle-o-down');
        $('#btnBp3').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnBp3').addClass('fa-arrow-circle-o-down');
        $('#btnBp3').removeClass('fa-arrow-circle-o-up');
    }
});
$("#btnTogDP1").click(function(){
    $("#tableDP1").slideToggle();
    isDP1 = !isDP1;
    if (isDP1 == true){
        $('#btnDp1').removeClass('fa-arrow-circle-o-down');
        $('#btnDp1').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnDp1').addClass('fa-arrow-circle-o-down');
        $('#btnDp1').removeClass('fa-arrow-circle-o-up');
    }
});
$("#btnTogDP2").click(function(){
    $("#tableDP2").slideToggle();
    isDP2 = !isDP2;
    if (isDP2 == true){
        $('#btnDp2').removeClass('fa-arrow-circle-o-down');
        $('#btnDp2').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnDp2').addClass('fa-arrow-circle-o-down');
        $('#btnDp2').removeClass('fa-arrow-circle-o-up');
    }
});
$("#btnTogDP3").click(function(){
    $("#tableDP3").slideToggle();
    isDP3 = !isDP3;
    if (isDP3 == true){
        $('#btnDp3').removeClass('fa-arrow-circle-o-down');
        $('#btnDp3').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnDp3').addClass('fa-arrow-circle-o-down');
        $('#btnDp3').removeClass('fa-arrow-circle-o-up');
    }
});
$("#btnTogDZP").click(function(){
    $("#tableDZP").slideToggle();
    isDP4 = !isDP4;
    if (isDP4 == true){
        $('#btnDp4').removeClass('fa-arrow-circle-o-down');
        $('#btnDp4').addClass('fa-arrow-circle-o-up');
    } else{
        $('#btnDp4').addClass('fa-arrow-circle-o-down');
        $('#btnDp4').removeClass('fa-arrow-circle-o-up');
    }
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
$( ".cSubject" ).hover(function() {
    $( this ).find($("i")).css( "color", "#fff" );
}, function() {
    $( this ).find($("i")).css( "color", "rgb(10, 97, 188)" );
});