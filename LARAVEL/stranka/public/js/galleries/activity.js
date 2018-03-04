function onScrollMove(event, id){
    var elemet = document.getElementById(id);
    var tmp = elemet.scrollLeft;

    elemet.scrollLeft += event.deltaY;


    if(!(elemet.scrollLeft == 0) && !(elemet.scrollLeft == tmp)){
        event.preventDefault();
    }
}

$(document).ready(function() {

    // Gets the video src from the data-src on each button
    var videoSrc;
    $(document).on("click",'.video-btn', function() {
        videoSrc = $(this).data( "src" );
    });
    console.log(videoSrc);

    // when the modal is opened autoplay it
    $('#myModal').on('shown.bs.modal', function (e) {

    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src','https://www.youtube.com/embed/' + videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" );
    })


    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#video").attr('src','https://www.youtube.com/embed/' + videoSrc);
    })
});