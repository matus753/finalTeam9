// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 300) {        
        $('#return-to-top').fadeIn(200);    
    } else {
        $('#return-to-top').fadeOut(200);   
    }
});
function scrollToTop(){     
    $('html').animate({
		scrollTop: $('html').offset().top             
    }, 500);
}
