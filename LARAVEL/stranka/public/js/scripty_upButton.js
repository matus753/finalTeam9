/**
 * Created by miluska on 26/11/2017.
 */
/*window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        document.getElementById("upPage").style.display = "block";
    } else {
        document.getElementById("upPage").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}*/

$(window).scroll(function() {
    if ($(this).scrollTop() >= 300) {        
        $('#upPage').fadeIn(200);    
    } else {
        $('#upPage').fadeOut(200);   
    }
});
function scrollToTop(){     
    $('html').animate({
		scrollTop: $('html').offset().top             
    }, 500);
}