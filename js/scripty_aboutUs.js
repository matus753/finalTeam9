/*
/!**
 * Created by mirec on 24/05/2017.
 *!/

$("#sectContent1").hide();
$("#sectContent2").hide();
$("#sectContent3").hide();
$("#sectContent31").hide();
$("#sectContent32").hide();
$("#sectContent33").hide();
$("#sectContent34").hide();


$(document).ready(function(){
    $(".sectItem").click(function(){
        hideAll();
        var id = $(this).attr('id');
        var id_num = id.match(/\d+$/)[0];
        //var id_num = parseInt(id, 10);
        var nameOfSect = "#sectContent" + id_num;
        var nameOfColorSect = "#section" + id_num;
        if ($(nameOfColorSect).hasClass("opened")){
            $(nameOfColorSect).removeClass("opened");
            if (id_num == 3){
                if ($("#section31").hasClass("opened")) {
                    $("#section31").removeClass("opened");
                    $("#section31").css('background-color', 'transparent');
                    $("#sectContent31").slideToggle();
                } else if ($("#section32").hasClass("opened")) {
                    $("#section32").removeClass("opened");
                    $("#section32").css('background-color', 'transparent');
                    $("#sectContent32").slideToggle();
                } else if ($("#section33").hasClass("opened")) {
                    $("#section33").removeClass("opened");
                    $("#section33").css('background-color', 'transparent');
                    $("#sectContent33").slideToggle();
                } else if ($("#section34").hasClass("opened")) {
                    $("#section34").removeClass("opened");
                    $("#section34").css('background-color', 'transparent');
                    $("#sectContent34").slideToggle();
                }
            }
            $(nameOfColorSect).css('background-color', 'transparent');
        } else {
            if (id_num > 30) {
                $(nameOfColorSect).css('background-color', 'rgb(98, 230, 197)');
            }
            else
                $(nameOfColorSect).css('background-color', 'rgb(25, 206, 161)');
            $(nameOfColorSect).addClass("opened");
        }
        $(nameOfSect).slideToggle();
    });
});

function prepareDiv() {
    hideAll();
    var id = $(this).attr('id');
    var id_num = id.match(/\d+$/)[0];
    //var id_num = parseInt(id, 10);
    var nameOfSect = "#sectContent" + id_num;
    var nameOfColorSect = "#section" + id_num;
    if ($(nameOfColorSect).hasClass("opened")){
        $(nameOfColorSect).removeClass("opened");
        if (id_num == 3){
            if ($("#section31").hasClass("opened")) {
                $("#section31").removeClass("opened");
                $("#section31").css('background-color', 'transparent');
                $("#sectContent31").slideToggle();
            } else if ($("#section32").hasClass("opened")) {
                $("#section32").removeClass("opened");
                $("#section32").css('background-color', 'transparent');
                $("#sectContent32").slideToggle();
            } else if ($("#section33").hasClass("opened")) {
                $("#section33").removeClass("opened");
                $("#section33").css('background-color', 'transparent');
                $("#sectContent33").slideToggle();
            } else if ($("#section34").hasClass("opened")) {
                $("#section34").removeClass("opened");
                $("#section34").css('background-color', 'transparent');
                $("#sectContent34").slideToggle();
            }
        }
        $(nameOfColorSect).css('background-color', 'transparent');
    } else {
        if (id_num > 30) {
            $(nameOfColorSect).css('background-color', 'rgb(98, 230, 197)');
        }
        else
            $(nameOfColorSect).css('background-color', 'rgb(25, 206, 161)');
        $(nameOfColorSect).addClass("opened");
    }
    $(nameOfSect).slideToggle();
}
function hideAll() {
    /!*
    if ($("#section1").hasClass("opened")) {
        $("#section1").removeClass("opened");
        $("#section1").css('background-color', 'transparent');
        $("#sectContent1").slideToggle();
    } else if ($("#section2").hasClass("opened")) {
        $("#section2").removeClass("opened");
        $("#section2").css('background-color', 'transparent');
        $("#sectContent2").slideToggle();
    } else if ($("#section3").hasClass("opened")) {
        if ($("#section31").hasClass("opened")) {
            $("#section31").removeClass("opened");
            $("#section31").css('background-color', 'transparent');
            $("#sectContent31").slideToggle();
        } else if ($("#section32").hasClass("opened")) {
            $("#section32").removeClass("opened");
            $("#section32").css('background-color', 'transparent');
            $("#sectContent32").slideToggle();
        } else if ($("#section33").hasClass("opened")) {
            $("#section33").removeClass("opened");
            $("#section33").css('background-color', 'transparent');
            $("#sectContent33").slideToggle();
        } else if ($("#section34").hasClass("opened")) {
            $("#section34").removeClass("opened");
            $("#section34").css('background-color', 'transparent');
            $("#sectContent34").slideToggle();
        } else{
            $("#section3").removeClass("opened");
            $("#section3").css('background-color', 'transparent');
            $("#sectContent3").slideToggle();
        }
    }*!/

}*/
