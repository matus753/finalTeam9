// var bumpIt = function() {
//         $('body').css('margin-bottom', $('.footer').height());
//         // $('.push').css('height', $('.footer').height());
//         $(".push").css("height", $(".push").css("height"));
//     },
//     didResize = false;
//
// bumpIt();
//
// $(window).resize(function() {
//     didResize = true;
// });
//
//
// setInterval(function() {
//     if(didResize) {
//         didResize = false;
//         bumpIt();
//     }
// }, 250);

function update() {
    $('body').css('margin-bottom', $('.footer').height());
    $(".push").css("height", $(".push").css("height"));
}

$( window ).resize(function() {
    update();
});

$( document ).ready(function() {
    update();
});
